<?php

namespace App\Http\Controllers;

use App\Models\ImageProfile;
use App\Models\Profile;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::with('user_type')->where('id', '!=', Auth::id())->get();
        return view('users.index', compact(['users']));
    }

    public function create()
    {
        $userTypes = UserType::where('status', 'Active')->get();
        return view('users.create', compact(['userTypes']));
    }

    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'cell_phone' => 'required_without:email|nullable|digits:11|regex:/(01)[0-9]{9}/|unique:users',
            'email' => 'required_without:cell_phone|nullable|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'user_type' => 'required|exists:user_types,id',
            'gender' => 'required|in:Male,Female,Others',
            'web_access' => 'required|boolean'
        ], [
            'cell_phone.required_without' => 'Either email or mobile number is required',
            'email.required_without' => 'Either email or mobile number is required',
            'cell_phone.unique' => 'This mobile number is already registered',
            'email.unique' => 'This email address is already registered',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Start database transaction
        DB::beginTransaction();

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email ?: null;
            $user->cell_phone = $request->cell_phone ?: null;
            $user->password = bcrypt($request->password);
            $user->user_type_id = $request->user_type;
            $user->web_access = $request->web_access;
            $user->save();

            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->gender = $request->gender;
            $profile->save();

            $image_profile = new ImageProfile();
            $image_profile->user_id = $user->id;
            $image_profile->save();

            // Attach roles if needed (assuming user_type is the role)
            $user->roles()->attach($request->user_type);

            // Commit transaction
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'User created successfully'
            ]);

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            \Log::error('User creation failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to create user. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function show($id)
    {
        $user = User::with(['profile', 'user_type', 'roles.permissions'])->findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function my_profile()
    {
        $user = User::with(['profile', 'user_type', 'roles.permissions'])->findOrFail(Auth::id());
        return view('users.show', compact('user'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userTypes = UserType::with(['user_type_role'])->get();
        return view('user_type.index', compact(['userTypes']));
    }

    public function create()
    {
        $roles = Role::where('status', 'Active')->get();
        return view('user_type.create', compact(['roles']));
    }

    public function store(Request $request)
    {
        $user_type = UserType::create($request->all());
        $user_type->user_type_role()->attach($request->roles);

        // return redirect('user-type');
        $data['success'] = 1;
        $data['message'] = 'successfully Created';
        return $data;
    }

    public function edit($id)
    {
        $userType = UserType::find($id);
        $roles = Role::where('status', 'Active')->get();
        $roleData = DB::table('role_user_type')
            ->where('user_type_id', $id)
            ->pluck('role_id')
            ->toArray();
        return view('user_type.edit', compact(['userType', 'roleData', 'roles']));
    }

    public function update(Request $request)
    {
        $userType = UserType::find($request->id);
        $userType->title = $request->title;
        $userType->status = $request->status;
        $userType->save();

        $userType->user_type_role()->sync($request->roles);

        $data['success'] = 1;
        $data['message'] = 'successfully Updated';
        return $data;
    }

    public function destroy($id)
    {
        $userType = UserType::find($id);
        $userType->delete();

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update_profile(Request $request)
    {

        $profile_data = Profile::find($request->profile_id);
        $profile_data->gender = $request->gender;
        $profile_data->nid = $request->nid;
        $profile_data->contact_no1 = $request->contact_no1;
        $profile_data->contact_no2 = $request->contact_no2;
        $profile_data->address = $request->address;
        $profile_data->joining_date = date('Y-m-d ', strtotime($request->joining_date));
        $profile_data->date_of_birth = ($request->date_of_birth != null) ? date('Y-m-d', strtotime($request->date_of_birth)) : null;
        $profile_data->save();

        $user = User::find($profile_data->user_id);
        $user->name = $request->name;
        $user->cell_phone = $request->cell_phone;
        $user->save();

        \Session::flash('flash_message', 'Successfully Updated');
        return redirect('user/' . $user->id);
    }

    public function profile_image(Request $request)
    {
        $file = $request->file('profile_image');

        // Generate unique filename with timestamp
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '.' . $extension;

        $directory = 'images';

        // Ensure the directory exists
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        // Get the current image filename before updating
        $currentImage = DB::table('image_profiles')
            ->where('user_id', $request->profile_image_id)
            ->value('image');

        // Delete the previous image if it exists
        if ($currentImage && Storage::disk('public')->exists($directory . '/' . $currentImage)) {
            Storage::disk('public')->delete($directory . '/' . $currentImage);
        }

        // Store the new file
        $path = Storage::disk('public')->putFileAs($directory, $file, $filename);

        // Update the database with new filename
        $user = DB::table('image_profiles')
            ->where('user_id', $request->profile_image_id)
            ->update(['image' => $filename]);

        \Session::flash('flash_message', 'Profile Image Successfully Updated');
        return redirect('user/' . $request->profile_image_id);
    }

    public function profile_settings(Request $request)
    {
        $user = User::find($request->user_id);
        // print_r($request->all()); 
        if($request->password != null){
            $password = bcrypt($request->password);
        }else{
            $password = $user->password;
        }
        $user->user_type_id = $request->user_type;
        $user->password = $password;
        $user->web_access = $request->web_access;
        $user->save();

        \Session::flash('flash_message', 'Profile Settings Successfully Updated');
        return redirect('user/' . $request->user_id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

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
        $profile_data->date_of_birth = ($request->date_of_birth!=null) ? date('Y-m-d', strtotime($request->date_of_birth)) : null;
        $profile_data->save ();

        $user = User::find($profile_data->user_id);
        $user->name = $request->name;
        $user->cell_phone = $request->cell_phone;
        $user->save ();

        \Session::flash('flash_message','Successfully Updated');
        return redirect('user/' . $user->id);
    }
}

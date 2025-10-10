<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }

    public function create()
    {
        $roles = Role::where('status', 'Active')->get();
        return view('user_type.create', compact(['roles']));
    }
}

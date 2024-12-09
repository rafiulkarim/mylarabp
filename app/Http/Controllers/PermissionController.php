<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $permissions = Permission::where('status', 'Active')->latest()->get();
        return view('permission.index', compact(['permissions']));
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        $permission = new Permission();
        $permission->title = $request->title;
        $permission->status = $request->status;
        $permission->save();

        $data['success'] = 1;
        $data['message'] = 'successfully Created';
        return $data;

    }
}

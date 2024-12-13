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
        $permissions = Permission::latest()->get();
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

    public function show()
    {

    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('permission.edit', compact(['permission']));
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::find($request->id);
        $permission->title = $request->title;
        $permission->status = $request->status;
        $permission->save();

        $data['success'] = 1;
        $data['message'] = 'Permission successfully Updated';
        return $data;
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

    }
}

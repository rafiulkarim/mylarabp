<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        abort_if(Gate::denies('permission-access'), redirect('error'));
        $permissions = Permission::latest()->get();
        return view('permission.index', compact(['permissions']));
    }

    public function create()
    {
        abort_if(Gate::denies('permission-access'), redirect('error'));
        return view('permission.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('permission-access'), redirect('error'));
        $permission = new Permission();
        $permission->title = $request->title;
        $permission->status = $request->status;
        $permission->save();

        $data['success'] = 1;
        $data['message'] = 'successfully Created';
        return $data;

    }

    // public function show()
    // {

    // }

    public function edit($id)
    {
        abort_if(Gate::denies('permission-access'), redirect('error'));
        $permission = Permission::find($id);
        return view('permission.edit', compact(['permission']));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('permission-access'), redirect('error'));
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
        abort_if(Gate::denies('permission-access'), redirect('error'));
        $permission = Permission::find($id);
        $permission->delete();

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        abort_if(Gate::denies('role-access'), redirect('error'));
        $roles = Role::with('permissions')->get();
        // print_r($roles); die();
        return view('role.index', compact(['roles']));
    }

    public function create()
    {
        $permissions = Permission::where('status', 'Active')->get();
        return view('role.create', compact(['permissions']));
    }

    public function store(Request $request)
    {
        $role = Role::create($request->all());

        // Ensure permissions is an array and convert to integers
        $permissions = $request->input('permissions', []);

        // If permissions is a JSON string, decode it
        if (is_string($permissions)) {
            $permissions = json_decode($permissions, true);
        }

        // Convert all permission IDs to integers
        $permissionIds = array_map('intval', (array) $permissions);

        $role->permissions()->sync($permissionIds);

        $data['success'] = 1;
        $data['message'] = 'successfully Created';
        return $data;
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::where('status', 'Active')->get();
        $permissionData = DB::table('permission_role')
            ->where('role_id', $id)
            ->pluck('permission_id')
            ->toArray();

        return view('role.edit', compact(['permissions', 'role', 'permissionData']));
    }

    public function update(Request $request, $id)
    {
        // print_r($request->all()); die();
        $role = Role::find($request->id);
        $role->title = $request->title;
        $role->status = $request->status;
        $role->save();

        // Ensure permissions is an array and convert to integers
        $permissions = $request->input('permissions', []);

        // If permissions is a JSON string, decode it
        if (is_string($permissions)) {
            $permissions = json_decode($permissions, true);
        }

        // Convert all permission IDs to integers
        $permissionIds = array_map('intval', (array) $permissions);

        $role->permissions()->sync($permissionIds);

        $data['success'] = 1;
        $data['message'] = 'successfully Updated';
        return $data;
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
    }
}

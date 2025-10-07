<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['title' => 'role-access'],
            ['title' => 'user-access'],
            ['title' => 'user-create'],
            ['title' => 'user-edit'],
            ['title' => 'user-show'],
            ['title' => 'user-delete'],
            ['title' => 'role-access'],
            ['title' => 'role-delete'],
        ];
        \App\Models\Permission::insert($permissions);

        $roles = [
            ['title' => 'Admin', 'status' => 'Active'],
            ['title' => 'User', 'status' => 'Active'],
        ];
        \App\Models\Role::insert($roles);

        $user_type = [
            ['title' => 'Admin', 'status' => 'Active'],
            ['title' => 'User', 'status' => 'Active'],
        ];
        \App\Models\UserType::insert($user_type);

        $role_user_type = [
            ['user_type_id' => 1, 'role_id' => 1],
            ['user_type_id' => 2, 'role_id' => 2],
        ];
        \DB::table('role_user_type')->insert($role_user_type);


        //        Permission Roll Table
        $admin_permissions = \App\Models\Permission::all();
        \App\Models\Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        //        \App\Models\Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
//        $user_permissions = $admin_permissions->filter(function ($permission) {
//            return substr($permission->title, 0, 5) != 'user-' && substr($permission->title, 0, 5) != 'role-'
//                && substr($permission->title, 0, 5) != 'permission-';
//        });
//        \App\Models\Role::findOrFail(2)->permissions()->sync($user_permissions);

        //      Roll User Table
        \App\Models\User::findOrFail(1)->roles()->sync(1);
        \App\Models\User::findOrFail(2)->roles()->sync(1);
        \App\Models\User::findOrFail(3)->roles()->sync(2);
    }
}

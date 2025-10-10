<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'id' => '1',
                'name' => 'SuperAdmin',
                'email' => 'superadmin@eidyict.com',
                'password' => bcrypt('123456'),
                'user_type_id' => 1,
                'web_access' => '1',
            ],
            [
                'id' => '2',
                'name' => 'SystemAdmin',
                'email' => 'systemadmin@eidyict.com',
                'password' => bcrypt('123456'),
                'user_type_id' => 1,
                'web_access' => '1',
            ],
            [
                'id' => '3',
                'name' => 'User',
                'email' => 'user@eidyict.com',
                'password' => bcrypt('123456'),
                'user_type_id' => 2,
                'web_access' => '1',
            ]

        ];
        foreach ($user as $key => $value) {
            \App\Models\User::create($value);
        }
        $profile = [
            ['user_id' => '1', 'gender' => 'Male', 'address' => 'Dhaka'],
            ['user_id' => '2', 'gender' => 'Male', 'address' => 'Dhaka'],
            ['user_id' => '3', 'gender' => 'Male', 'address' => 'Dhaka'],
        ];
        \DB::table('profiles')->insert($profile);
        $image_profile = [
            ['user_id' => '1', 'image' => 'default_image.png'],
            ['user_id' => '2', 'image' => 'default_image.png'],
            ['user_id' => '3', 'image' => 'default_image.png'],
        ];
        \DB::table('image_profiles')->insert($image_profile);

        // $this->call(UsersTableSeeder::class);
    }
}

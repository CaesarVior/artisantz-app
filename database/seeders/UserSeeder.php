<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRoleId = DB::table('roles')->insertGetId([
            'name' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $userRoleId = DB::table('roles')->insertGetId([
            'name' => 'User',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            [
                'role_id' => $adminRoleId,
                'name' => 'Admin Artisantz',
                'email' => 'admin@gmail.com',
                'password' => '@Admin_ganteng1',
                'phone_number' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

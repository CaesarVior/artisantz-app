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
                'name' => 'John Doe Admin',
                'email' => 'indrabekti@gmail.com',
                'password' => 'indrabekti',
                'phone_number' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => $userRoleId,
                'name' => 'Jane Doe Member',
                'email' => 'indrabekti@gmail.com',
                'password' => 'indrabekti',
                'phone_number' => '089876543210',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('events')->insert([
            [
                'name' => 'Annual Tech Conference 2026',
                'photo' => 'tech_conf_2026.jpg',
                'theme' => 'Futuristic Innovation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Music and Arts Festival',
                'photo' => 'music_fest.jpg',
                'theme' => 'Retro Revival',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

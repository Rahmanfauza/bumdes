<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Admin',
            'Sekretaris',
            'Bendahara',
            'Direktur'
        ];

        foreach ($roles as $roleName) {
            $role = Role::create(['nama_role' => $roleName]);
            
            // Create a default user for each role
            $username = strtolower($roleName);
            User::create([
                'name' => 'User ' . $roleName,
                'username' => $username,
                'email' => $username . '@bumdes.com',
                'password' => Hash::make('password123'),
                'id_role' => $role->id_role,
                'status' => 'aktif',
            ]);
        }
    }
}

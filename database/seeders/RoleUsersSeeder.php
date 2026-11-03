<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin BI',
                'email' => 'admin@bi.go.id',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Pimpinan BI',
                'email' => 'pimpinan@bi.go.id',
                'password' => Hash::make('password'),
                'role' => 'pimpinan',
            ],
            [
                'name' => 'Peserta Magang',
                'email' => 'magang@bi.go.id',
                'password' => Hash::make('password'),
                'role' => 'peserta_magang',
            ],
        ];

        foreach ($users as $userData) {
            User::query()->updateOrCreate(
                ['email' => $userData['email']],
                $userData,
            );
        }
    }
}

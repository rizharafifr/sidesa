<?php

namespace Database\Seeders;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'status' => 'approved',
            'role_id' => '1', // Admin
        ]);
        User::create([
            'id' => 2,
            'name' => 'Penduduk 1',
            'email' => 'penduduk1@gmail.com',
            'password' => 'password',
            'status' => 'approved',
            'role_id' => '2', // User
        ]);

        Resident::create([
            'user_id' => 2,
            'nik' => '1234567891234567',
            'name' => 'Adam',
            'gender' => 'male',
            'birth_date' => '2005-01-01',
            'birth_place' => 'Cirebon',
            'address' => 'Cirebon',
            'marital_status' => 'single',
        ]);
    }
}

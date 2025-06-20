<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'admin',
        //     'alamat' => 'xxxx',
        //     'telepon' => '12345',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('admin@123'),
        //     'jenis' => 'admin'
        // ]);

        User::create([
            'name' => 'Anggota 2024',
            'alamat' => 'Jl. Tahun Baru',
            'telepon' => '081234567890',
            'email' => 'anggota2024@example.com',
            'password' => Hash::make('password2024'),
            'jenis' => 'member',
            'created_at' => '2024-06-20 10:00:00',
            'updated_at' => '2024-06-20 10:00:00',
        ]);
    }
}

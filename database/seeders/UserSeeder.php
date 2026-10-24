<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // firstOrCreate: tidak error jika seeder dijalankan dua kali
        $admin = User::firstOrCreate(
            ['email' => 'admin@desa.test'],
            ['name' => 'Admin Desa', 'password' => 'password', 'role' => 'admin']
        );

        User::firstOrCreate(
            ['email' => 'editor@desa.test'],
            ['name' => 'Editor Desa', 'password' => 'password', 'role' => 'editor']
        );

        // Tambahan (bukan dari modul): berita lama yang belum punya penulis
        // dihubungkan ke akun admin, karena kita tidak memakai migrate:fresh
        Berita::whereNull('user_id')->update(['user_id' => $admin->id]);
    }
}

<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name' => 'Admin Utama', 'email' => 'admin@example.com', 'password' => Hash::make('password'), 'role' => 'admin',]);
        User::create(['name' => 'SO Perusahaan', 'email' => 'so.perusahaan@example.com', 'password' => Hash::make('password'), 'role' => 'so',]);
        User::create(['name' => 'SO Subkon A', 'email' => 'so.subkon_a@example.com', 'password' => Hash::make('password'), 'role' => 'so', 'subkon_nama' => 'Subkon A',]);
    }
}
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'role' => 'admin',
            ],
            [
                'username' => 'kasir',
                'password' => Hash::make('kasir'),
                'role' => 'kasir',
            ],
            [
                'username' => 'pelanggan',
                'password' => Hash::make('pelanggan'),
                'role' => 'pelanggan',
            ],
        ];

        User::insert($users);
    }
}

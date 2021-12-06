<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Tim',
            'email' => 'vandenbergtp@gmail.com',
            'password' => Hash::make('hangloose1'),
        ]);

        Role::create(['name' => 'admin']);
        $user->assignRole('admin');
    }
}

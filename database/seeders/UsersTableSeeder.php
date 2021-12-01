<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::first();

        $role->users()->create([
            'name' => 'Albert Cruz',
            'email' => 'albertcruz@terra.com.br',
            'password' => bcrypt('123456'),
        ]);
    }
}

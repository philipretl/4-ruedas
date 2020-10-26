<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class InitProyectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@4ruedas.com',
            'password' => Hash::make('12345678'),

        ]);

        DB::table('users')->insert([
            'name' => 'employee',
            'email' => 'employee@4ruedas.com',
            'password' => Hash::make('12345678'),

        ]);

        DB::table('users')->insert([
            'name' => 'customer',
            'email' => 'customer@4ruedas.com',
            'password' => Hash::make('12345678'),

        ]);

        $roles = [
            'admin',
            'customer',
            'employee'
        ];

        $permissions = [
            'admin-permission',
            'customer-permission',
            'employee-permission'
        ];

        foreach ($roles as $rol) {
            Role::create(['guard_name' => 'api', 'name' => $rol]);
        }

        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'api','name' => $permission]);
        }

        $user = User::where('email', 'admin@4ruedas.com')->first();
        $user->assignRole('admin');

        $user = User::where('email', 'employee@4ruedas.com')->first();
        $user->assignRole('employee');

        $user = User::where('email', 'customer@4ruedas.com')->first();
        $user->assignRole('customer');
    }
}

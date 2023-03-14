<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate([
            'name' => 'admin',
        ])->syncPermissions(Permission::all());

        Role::updateOrCreate([
            'name' => 'instructor',
        ])->syncPermissions(Permission::all());

        Role::updateOrCreate([
            'name' => 'student',
        ])->syncPermissions(Permission::all());
    }
}

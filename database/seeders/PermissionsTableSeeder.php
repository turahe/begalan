<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class PermissionsTableSeeder extends Seeder
{
    /**
     * @return array
     */
    private array $defaultPermissions = [
        'user.view', 'user.add', 'user.store', 'user.edit', 'user.update', 'user.delete',
        'permission.view', 'permission.add', 'permission.store', 'permission.edit', 'permission.update', 'permission.delete',
        'role.view', 'role.add', 'role.store', 'role.edit', 'role.update', 'role.delete',
        'post.view', 'post.add', 'post.store', 'post.edit', 'post.update', 'post.delete',
        'blog.view', 'blog.add', 'blog.store', 'blog.edit', 'blog.update', 'blog.delete',
        'page.view', 'page.add', 'page.store', 'page.edit', 'page.update', 'page.delete',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = collect($this->defaultPermissions)->map(function ($permission) {
            return [
                'name' => $permission,
                'guard_name' => 'web',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        });

        Permission::insert($permissions->toArray());
    }
}

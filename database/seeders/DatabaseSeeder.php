<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            CountrySeeder::class,
            OptionSeeder::class,
            MediaTableSeeder::class,
            CategoriesTableSeeder::class,
            CoursesTableSeeder::class,
            PostsTableSeeder::class,
        ]);
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),

            'gender' => $this->faker->randomElement(['male', 'female']),
            'company_name' => $this->faker->company,
            'country_id' => 104,
            'address' => $this->faker->address,
            'address_2' => $this->faker->address,
            'city' => $this->faker->city,
            'zip_code' => $this->faker->postcode,
            'postcode' => $this->faker->postcode,
            'phone' => $this->faker->phoneNumber,
            'about_me' => $this->faker->paragraph(5),
            'date_of_birth' => $this->faker->dateTimeBetween('-30 years', '-13 years'),
            'photo' => 1,
            'job_title' => $this->faker->jobTitle
        ];
    }
}

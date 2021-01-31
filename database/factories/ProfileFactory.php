<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
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
            'job_title' => $this->faker->jobTitle,
        ];
    }
}

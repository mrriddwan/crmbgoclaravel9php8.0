<?php

namespace Database\Factories;

use App\Models\ContactIncharge;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactIncharge>
 */
class ContactInchargeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactIncharge::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'contact_id' => random_int(1,200),
            'name' => fake()->company(),
            'email' => fake()->email(),
            'phone_mobile' => fake()-> phoneNumber(),
            'phone_office' => fake()-> phoneNumber(),
        ];
    }
}

<?php

namespace Modules\Manager\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Manager\Entities\Offer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'discount' => $this->faker->randomDigitNot(0),
            'percentage' => $this->faker->randomDigitNot(0),
            'start_at' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'end_at' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'active' => $this->faker->boolean($chanceOfGettingTrue = 80)

        ];
    }
}

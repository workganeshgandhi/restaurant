<?php
namespace Modules\Manager\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BranchFactory extends Factory
{

    protected $model = \Modules\Manager\Entities\Branch::class;

    public function definition()
    {
        return [
            'number' => $this->faker->randomDigitNot(0),
            'tables' => $this->faker->randomDigitNot(0),
            'address' => $this->faker->address,
            'open_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}


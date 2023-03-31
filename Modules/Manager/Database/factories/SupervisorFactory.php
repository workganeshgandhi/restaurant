<?php
namespace Modules\Manager\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Manager\Entities\Branch;
use Modules\Manager\Entities\Salary;
class SupervisorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Manager\Entities\Supervisor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'mobile' => $this->faker->phoneNumber,
            'national_id' => $this->faker->numerify('##########'),
            'join_date' =>$this->faker->date($format = 'Y-m-d', $max = 'now'),
            'salary_state' => $this->faker->boolean($chanceOfGettingTrue = 80),

            'branch_id' => function () {
                return Branch::factory()->create()->id;

            },
            'salary_id' => function () {
                return Salary::factory()->create()->id;

            },
        ];
    }
}


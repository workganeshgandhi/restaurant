<?php
namespace Modules\Manager\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Manager\Entities\DeliveryBoy;
use Modules\Manager\Entities\Branch;
use App\Models\Cashier;
class DeliveryOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Manager\Entities\DeliveryOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' =>  $this->faker->randomDigitNot(0),
            'state' => $this->faker->boolean($chanceOfGettingTrue = 80),
            'total_price' => $this->faker->numerify('####'),
            'branch_id' => function () {
                return Branch::factory()->create()->id;
                
            },
            'cashier_id' => function () {
                return Cashier::factory()->create()->id;

            },
            'delivery_boy_id' => function () {
                return DeliveryBoy::factory()->create()->id;

            },
        ];
    }
}


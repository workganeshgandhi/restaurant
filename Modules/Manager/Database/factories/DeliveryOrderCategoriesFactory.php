<?php
namespace Modules\Manager\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Manager\Entities\DeliveryOrder;
use Modules\Manager\Entities\Category;
class DeliveryOrderCategoriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Manager\Entities\DeliveryOrderCategories::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['s', 'c']),
            'extra' => $this->faker->text,
            'mount' => $this->faker->randomDigitNot(0),
            'subtotal' => $this->faker->numerify('###'),
            'delivery_order_id' => function () {
                return DeliveryOrder::factory()->create()->id;

            },
            'category_id' => function () {
                return Category::factory()->create()->id;

                
            },
        ];
    }
}


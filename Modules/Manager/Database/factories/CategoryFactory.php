<?php
namespace Modules\Manager\Database\factories;

use Modules\Manager\Entities\Category;
use Modules\Manager\Entities\MainCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Manager\Entities\Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->numberBetween($min = 15, $max = 50),
            'images' => '["'.$this->faker->imageUrl($width = 640, $height = 480).'"]',
            'main_category_id'=> function () {
                return MainCategory::factory()->create()->id;
            },
        ];
    }
}


<?php
namespace Modules\Manager\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MainCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Manager\Entities\MainCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'images' => '["'.$this->faker->imageUrl($width = 640, $height = 480).'"]',
        ];
    }
}


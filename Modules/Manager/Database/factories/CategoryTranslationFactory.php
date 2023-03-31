<?php
namespace Modules\Manager\Database\factories;

use Modules\Manager\Entities\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Manager\Entities\CategoryTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id'=> function () {
                return Category::factory()->create()->id;

            },
            'locale' => $this->faker->randomElement(['ar', 'en']),
            'name' => $this->faker->name,
        ];
    }
}


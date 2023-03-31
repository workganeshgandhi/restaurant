<?php
namespace Modules\Manager\Database\factories;

use Modules\Manager\Entities\MainCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Manager\Entities\MainCategoryTranslation;

class MainCategoryTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MainCategoryTranslation::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'main_category_id'=> function () {
                return MainCategory::factory()->create()->id;

            },
            'locale' => $this->faker->randomElement(['ar', 'en']),
            'name' => $this->faker->name,
        ];
    }
}


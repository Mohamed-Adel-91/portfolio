<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition()
    {
        return [
        'init_title' => $this->faker->realText(30),
        'init_description' => $this->faker->realText(100),
        'init_link' => $this->faker->url(),
        'specifications' => $this->faker->randomHtml() ,
        'benefits' => $this->faker->randomHtml() ,
        'how_to_use' => $this->faker->randomHtml() ,
        'advantages' => $this->faker->randomHtml() ,
        'components' => $this->faker->randomHtml() ,
        'dimensions' => $this->faker->randomHtml() ,
        'focus_points' => $this->faker->randomHtml() ,
        'title_ar' => null,
        'title_en' => null,
        'description_ar' => null,
        'description_en' => null,
        'category_id' => Category::all()->random()->id,
        'status' => 'pending',
        'feedback' => null
       ];
    }
}

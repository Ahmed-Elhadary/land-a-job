<?php

namespace Database\Factories;

use App\Models\IndustryCategory;
use App\Models\JobTitle;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobTitleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobTitle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'industry_category_id'=>IndustryCategory::factory(),
            'title' => $this->faker->jobTitle,
        ];
    }
}

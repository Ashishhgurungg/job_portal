<?php

namespace Database\Factories;
use App\Models\Vacancy;
use App\Models\User;
use App\Models\Category;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacancy>
 */
class VacancyFactory extends Factory
{
    protected $model = Vacancy::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $category= [1,2,3];// give this variable and make it loop for gender , category
        // return [
            
        //     'column_name'=>'value',//use text() function or word() function if you can't find the relevant name
        //     //Arr::random(['active', 'inactive', 'pending', 'banned']), this can be used for random purpose

        // ];

        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => $this->faker->jobTitle(),
            'type' => $this->faker->randomElement(['full-time', 'part-time', 'contract', 'internship']),
            'description' => $this->faker->paragraph(4),
            'salary' => $this->faker->numberBetween(20000, 100000),
            'deadline' => $this->faker->dateTimeBetween('now', '+3 months'),
        ];

    }
}

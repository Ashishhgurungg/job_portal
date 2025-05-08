<?php

namespace Database\Factories;
use App\Models\Vacancy;
use App\Models\User;
use App\Models\Category;
use App\Models\Application;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class ApplicationFactory extends Factory
{
    protected $model = Application::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Creates and uses a new user
            'vacancy_id' => Vacancy::factory(), // Creates and uses a new vacancy
            'resume' => $this->faker->filePath(), // Simulated path to a resume file
            'cover_letter' => $this->faker->paragraph(4), // Sample cover letter content
            'status' => 0,
        ];
    }
}

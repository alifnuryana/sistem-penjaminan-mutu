<?php

namespace Database\Factories;

use App\Actions\Utilities\GenerateUniqueCode;
use App\Enums\AccreditationStatus;
use App\Services\UtilityService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accreditation>
 */
class AccreditationFactory extends Factory
{
    /**
     * Define the model's default state.
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $utilityService = new UtilityService();

        return [
            'code' => GenerateUniqueCode::run('AKRE'),
            'grade' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'status' => $this->faker->randomElement([AccreditationStatus::Active, AccreditationStatus::Inactive]),
            'due_date' => $this->faker->dateTimeBetween('now', '+2 year'),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Actions\Utilities\GenerateUniqueCode;
use App\Enums\AccreditationStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accreditation>
 */
class AccreditationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => GenerateUniqueCode::run('AKRE'),
            'grade' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'status' => $this->faker->randomElement([AccreditationStatus::Active, AccreditationStatus::Inactive]),
        ];
    }
}

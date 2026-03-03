<?php

// Testdaten-generator für Jobs
// die klasse JobFactory definiert welche Tastdaten JOB bekommt. wird vererbt durch HasFactory
// job.php kann durch diese vererbung beispielsweise Job::factory()->create() aufrufen und Test-Jobs erzeugen
// Trait kommt von Laravel, definition folgt durch uns ( nachdem alle Models erstellt sind)


namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
}

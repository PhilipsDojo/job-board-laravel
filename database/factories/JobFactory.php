<?php

// Testdaten-generator für Jobs
// die klasse JobFactory definiert welche Tastdaten JOB bekommt. wird vererbt durch HasFactory
// job.php kann durch diese vererbung beispielsweise Job::factory()->create() aufrufen und Test-Jobs erzeugen
// Trait kommt von Laravel, definition folgt durch uns ( nachdem alle Models erstellt sind)


namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use App\Models\Category;
use App\Models\User;

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
            'title' => fake()->jobTitle(),                          // Zufälliger Job-Titel
            'description' => fake()->paragraphs(3, true),           // 3 Absätze Beschreibung
            'location' => fake()->city(),                           // Zufällige Stadt
            'is_active' => fake()->boolean(80),                     // 80% aktiv == ein Wahrscheinlichkeits parameter 80% der erstellen daten sollen mit true erstellt werden.
            'expires_at' => fake()->optional()->dateTimeBetween('+1 week', '+3 months'),
            'company_id' => Company::factory(),                     // Erstellt neue Firma
            'category_id' => Category::factory(),                   // Erstellt neue Kategorie
            'user_id' => User::factory(),                           // Erstellt neuen User 
        ];
    }
}

<?php
// Testdaten Drucker
//
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;  // ← Wichtig, damit User bekannt ist

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    // Methode wird aufgerufen durch Company::factory()->create()
    // Output muss Array sein
    {
        return [

            // => verbindet in php Datenbankfeld mit testdaten die dem pfeil folgen.
            // fake() Zufallsgenerator->rufe mehtode XYZ() auf
            // -> zugriff auf Objekt der Klasse User 
            // :: zugriff auf die KLasse USER
          'name' => fake()->company(),
          'description' => fake()->paragraphs(2, true), // hier gibt es 1000 methoden FakerPHP. diese kommt von KI
          'website' => fake()->url(),
          'logo' => null,
          'user_id' => User::factory()  // User ist der Klassen Name ::
        
        ];
    }
}

// Merksatz 
// :: = Statischer Aufruf der KLASSE User (groß geschrieben)
// -> = Methodenaufruf eines OBJEKTS (Variable klein)
// User::factory() erstellt automatisch einen neuen User für diese Firma

// Beispiel
// 'user_id' => User::factory()  
// 1. FIRMA (beispielsweise GOOGLE) (Klasse User) wird angerufen
// 2. Sie erstellt einen neuen Mitarbeiter in dieser Firma (z.B. Max)
// 3. Dessen Personalnummer (ID) kommt in 'user_id'
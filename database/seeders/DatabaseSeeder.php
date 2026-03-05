<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * // erstelle 10 beispieldaten für alle Datenbanken Categorien Companys Jobs. User folgt weiter unten
     * ACHTUNG der Company und JOB Seeder werden jeweils ebenfalls 10 user erstellen das soll uns aber nicht stören aktuell.
     * hier fällt mir auf, das man sich über den zwingenden USER beim JOb streiten kann und hier eine Firma eventuell besser wäre. 
     * Gedanke war das user_id ein pflichtfeld beim JOB erstellen ist für die Berechtigung und Nachverfolgung.
     */
    public function run(): void
    {
        $this->call([
        CategorySeeder::class,  // zuerst Kategorien
        CompanySeeder::class,   // dann Firmen  
        JobSeeder::class,       // dann Jobs
    ]);

    // erstelle insgesamt 10 User 
    // 1 Admin 
    // 1 Arbeitgeber
    // 8 bewerber ( sobald eingeloggt sind wird aus Gast automatisch bewerber so der Plan)
    // == Achtung in der realität werden es nach dem DatabaseSeeder run sehr viel mehr USer sein, da in den Factorys definiert ist, das jede COmpany einen USer braucht sowie jeder Job.             

    User::factory()->create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'role' => 'admin',
   ]);
    User::factory()->create([
        'name' => 'Arbeitgeber User',
        'email' => 'arbeitgeber@example.com',
        'role' => 'arbeitgeber',
        ]);
     User::factory()->create([
        'name' => 'Bewerber User',
        'email' => 'bewerber@example.com',
        'role' => 'bewerber',
        ]);
        // hier nochmal 7 zusätzliche Bewerber dann, da Datenbankeinträge existieren und default bewerber werden soll. 
        // die 7 folgenden nochmal separiert, damit fortlaufende indexierung erstellt wird.
    User::factory()->count(7)->create();
    }
}

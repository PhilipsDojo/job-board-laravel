<?php

// Basis für Datenbank-Befüllung
// run() Methode für spätere Testdaten
// Wird mit php artisan db:seed ausgeführt
// Kombiniert mit Factory für Massendaten
// aktuell noch leer kann später mit beispielsweise Job::factory()->count(50)->create() befüllt werden
// Unterschied Seeder <> Factory:  . Seeder führt die Daten aus
// Factory setzt WIE Daten aussehen "Job::factory()->make()"
// Seeder Seeder führt die Daten aus "php artisan db:seed"

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    }
}

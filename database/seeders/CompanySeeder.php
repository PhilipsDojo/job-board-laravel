<?php
// erzeugt Testdaten für die company Datenbank
// Wird ausgeführt mit: php artisan db:seed --class=CompanySeeder

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;  // WICHTIG: Company MODEL importieren!

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Füllt die companies-Tabelle mit Testdaten
     */
    public function run(): void
    {
        // hier werden 10 zufällige Firmen erzeugt
        // Factory kümmert sich automatisch um zufällige Namen,Beschreibung,Websiten
        // erstellt automatisch zugehörige User ( Besitzer)
        // die von uns im Factory definierten inhalte. 
        Company::factory()->count(10)->create();//
    }
}

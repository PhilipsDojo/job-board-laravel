<?php

// füllt die Datenbank mit Testdaten

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; // wichtig einsetzen damit der seeder überhaupt weis was hier genutzt wird.

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Category::factory()->count(10)->create(); // 10 zufällige Datensätze
    }
}

<?php

// Testdaten ersteller
// faker Methoden god bless AI


namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'name' => fake()->unique()->word(),  // Einzigartiger Kategoriename
        ];
    }
}
//  Merksatz
//  Der DocBlock sagt: 'Diese Methode gibt ein Array zurück,
//  dessen Schlüssel Strings sind und dessen Werte alles Mögliche sein können (mixed).
//
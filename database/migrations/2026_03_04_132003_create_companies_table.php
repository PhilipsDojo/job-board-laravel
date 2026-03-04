<?php
// MIGRATION - BAUPLAN FÜR DIE COMPANIES-TABELLE
// Hier wird die Datenbank-Tabelle 'companies' mit allen Feldern angelegt.
// Ausführung: php artisan migrate
// Laravel Doku: "To run all of your outstanding migrations, execute the migrate Artisan command" Ich interpretiere das mal so, als würde Laraval vorher prüfen was noch nicht erstellt wurde und feuert erst dann.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id(); //PK
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable(); // für eventuellen Bild Upload ( String weil wir den PFAD nutzen nicht die Datei selbst)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // FK zu User/ Arbeitgeber/Admin haben hier einen Wert und werden dort dann definiert über "roles"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

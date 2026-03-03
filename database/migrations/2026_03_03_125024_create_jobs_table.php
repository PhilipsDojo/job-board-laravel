<?php

// Hier werden die Datenbankeinträge erstellt. Tabelle "jobs" mit allen definierten feldern.
// Dies ist der BAUPLAN. ausgeführt/umgesetzt wird dieser mit php artisan migrate

//  $table->id(); ERSTELLT IMMER:
// - Spaltenname: 'id'
// - Typ: BIGINT UNSIGNED
// - AUTO_INCREMENT
// - PRIMARY KEY

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * * up() - Tabelle anlegen.
     * Hier muss definiert werden, welche Felder wir brauchen
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id(); // Laravel übernimmt viel arbeit. in SQL wäre der befehl:  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
// =====  Folgend die Job Felder- die Daten der Stellenanzeige =====
            $table->string('title'); // Beispiel: Anwendungsentwickler
            $table->text('description'); // Ausführliche Beschreibung der Stelle ( langer Text)
            $table->string('location'); // Arbeitsort (z.B. "Berlin")
            $table->boolean('is_active')->default(true); // ist job noch aktiv true||false
            $table->date('expires_at')->nullable(); // nullable = darf leer bleiben!
// =====  Folgend die Fremd-schlüssel Verbindungen zu anderen Tabellen =====
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
                // verweis auf companies.id Wenn Firma gelöscht wird, werden auch die jobs gelöscht
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
                // Verweis auf categories.id
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
                // Verweis auf user.id (ersteller)
            $table->timestamps();
            // created_at und updated_at (automatisch von Laravel)
// =====  INDIZES -Inhaltsverzeichnis der Datenbank für schnellere Suchanfragen =====
            $table->index('title');      // nach Titel
            $table->index('location');   // nach Ort
            $table->index('is_active');  // nach Aktiv
        });


    }

    /**
     * Reverse the migrations.
     * down() - Tabelle löschen. Macht up wieder rückgängig 
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};

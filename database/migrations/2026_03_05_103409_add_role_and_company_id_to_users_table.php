<?php

// die neue zusästliche migration. Etwas komplizierter da erst geprüft werden muss, ob die Spalten existieren wen nicht, erstelle.
// down() ist das sicherheitsnetz um migrations rückgängig zu machen.
// durch php artisan migrate:fresh 
// soll nun folgendes ausgeführt werden
// #1 löscht alles + baut neu
// dabei werden alle down() Methoden zuerst ausgeführt.

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
        Schema::table('users', function (Blueprint $table) {
            // Füge role hinzu (falls nicht vorhanden)
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('bewerber')->after('password');
            }
            
            // Füge company_id hinzu (falls nicht vorhanden)
            if (!Schema::hasColumn('users', 'company_id')) {
                $table->foreignId('company_id')->nullable()->after('role')
                      ->constrained()
                      ->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Nur löschen wenn die Spalten existieren
            if (Schema::hasColumn('users', 'company_id')) {
                $table->dropForeign(['company_id']);
                $table->dropColumn('company_id');
            }
            
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};

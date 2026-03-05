<?php

// komplett vom Laravel Framework bereitgestellt.
// Hätte ich diese nicht schon migrated, hätte es gereicht
// Zeile 27 & 28 hinzugefügt User role und Fremdschlüssel verweis zu CompanyID 
// Wichtig hier aber das migration nie geändert werden sollen. Also neue file erstellt mit den zusätzlichen tables
// "2026_03_05_103409_add_role_and_company_id_to_users_table"

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
           //  $table->string('role')->default('bewerber'); // jeder Benutzer ist erstmal default ein bewerber bis etwas anderes definiert wurde 
           //  $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete(); //nullOnDelete wenn Firma gelöscht wird, bleibt USer erstmal ohne Firma besetehn
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

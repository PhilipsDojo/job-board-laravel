<?php

// Benutzer, Rollen und Berechtigungen

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string> // PHPDOC-Type-Hint es folgt eine variable als liste die werte in der Liste sind Strings
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // WICHTIG: Rolle des Users (bewerber/arbeitgeber/admin)
        'company_id', // WICHTIG: Zu welcher Firma gehört der User? (nur für Arbeitgeber)
    ];

    /**
     * The attributes that should be hidden for serialization.
     * sensible nicht anzuzeigende Daten 
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


// ============================================================
//                 Datenbank BEZIEHUNGEN

// ============================================================
//
//      Ein User KANN eine Firma haben (wenn er Arbeitgeber ist)
//     1:1 Beziehung - ein User hat genau eine Firma (oder keine)
     
    public function company()
    {
        return $this->hasOne(Company::class);
    }

    /**
     * Ein User kann viele Jobs erstellen
     * 1:n Beziehung - ein User kann viele Jobs anlegen
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

// ============================================================
// METHODEN zum Rollen prüfen
// ============================================================    

    // Ist der User ein Admin ? 

    public function isAdmin():bool{
        return $this->role === 'admin';
    }

    // Is der USer Arbeitgeber?

    public function isArbeitgeber():bool{
        return $this->role === 'arbeitgeber';
    }

    // is der User ein Bewerber ?
    public function isBewerber():bool{
        return $this->role === "bewerber";
    }
}    

// WAS IST DER USER?
// Der User ist die zentrale Figur der Anwendung – egal ob Bewerber, 
// Arbeitgeber oder Admin. Alles dreht sich um ihn.
//
// DIE ROLLEN:
// - 'bewerber'    : Kann Jobs sehen und sich bewerben (company_id = NULL)
// - 'arbeitgeber' : Besitzt eine Firma (company_id ist gesetzt)
// - 'admin'       : Darf alles (Kategorien, User, etc. verwalten)
//
// WICHTIGSTE METHODEN:
// - isAdmin()       : Prüft ob User Admin ist → true/false
// - isArbeitgeber() : Prüft ob User Arbeitgeber ist → true/false  
// - isBewerber()    : Prüft ob User Bewerber ist → true/false
//
// BEZIEHUNGEN:
// - $user->company  : Holt die Firma (wenn Arbeitgeber)
// - $user->jobs     : Holt alle Jobs, die der User erstellt hat
//
// ZUSAMMENHANG MIT POLICIES:
// In den Policies wird mit diesen Methoden geprüft:
// if ($user->isAdmin()) { "darf alles" }
// if ($user->isArbeitgeber()) { "darf Jobs erstellen" }
//
// VERERBUNG:
// extends Authenticatable → User erbt alle Login-Funktionen
// use HasFactory → Kann Testdaten erzeugen

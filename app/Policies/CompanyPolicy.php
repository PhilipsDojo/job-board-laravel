<?php
// der Türsteher für Firmen 
// welche UserGruppen dürfen was einsehen und bearbeiten
// folgend durch die entsprehcneden functions evaluiert 
// In Laravel sind nicht eingeloggte Besucher (Gäste) = null
// sobald eingeloggt ist, wird der User ein Objekt.
// auth()->user();
// $user->id = $user gibt das aktuelle user Objekt zurück der -> dient in PHP als eine Art ? welche id hat dieser User 

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Company;
use App\Models\User;

class CompanyPolicy
{
    /**
     * Determine whether the user can view any models.
     * Darf User als Gast(null) alle Firmen sehen ?.
     * 
     */
    public function viewAny(User $user): bool
    {
        return true; // true. Jeder darf Firmen sehen (auch Gäste(null))
    }

    /**
     * Determine whether the user can view the model.
     * Prüft, ob der User $user (z.B. Max) die Firma $company (z.B. Google) sehen darf
    *  true = darf er, false = darf er nicht
     */
    public function view(User $user, Company $company): bool
    {
        return true; // eingeloggte user dürfen das.
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role,['arbeitgeber', 'admin']); 
        // liefert die rolle des eingeloggten Users
        // wir geben ein Array an mit den erlaubten Rollen
        // die funtkion in_array() prüft im RAM Arbeitsspeicher das übergeben Array mit unserem definierten.
        // verglichen wird wogl im CPU
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Company $company): bool
    {
        return $user->id === $company->user_id || $user->role=== 'admin';
         // NUR der Besitzer (user_id) oder Admin
         // prüft ob: Login User = user ID der Firma ? z.B. $user ->id =5, $company->user_id = 5 -> true
         // ODER 
         // prüft ob: User ID = admin rolle. z.B. $user->role ='admin' true $user->role ='arbeitgeber' = false

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Company $company): bool
    {
        return $user->id === $company->user_id || $user->role === 'admin';
        // prinzip wie bei update
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Company $company): bool
    {
        return $user->role === 'admin'; // nur admins dürfen gelöschte Firmen wiederherstellen.


    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Company $company): bool
    {
        return $user->role === 'admin'; // nur admins dürfen gelöschte Firmen wiederherstellen.
    }
}


// Merksätze
// Prüft, ob der User (Objekt $user) die Firma (Objekt $company) sehen darf
// User = Typ-Hint (erwartet ein User-Objekt)
// $user = die konkrete Variable (der eingeloggte User)
// Company = Typ-Hint (erwartet ein Company-Objekt)  
// $company = die konkrete Variable (die angefragte Firma)

// 1. PHP nimmt $user->role (z.B. 'arbeitgeber')
// 2. PHP geht das Array durch:
//    Position 0: 'arbeitgeber' → Vergleich: 'arbeitgeber' == 'arbeitgeber'? JA!
// 3. Sobald ein Treffer gefunden wird, stoppt die Suche
// 4. Gibt true zurück

// "Du musst $user nie selbst holen – Laravel macht das automatisch für dich!
// In der Policy ist $user immer der aktuell eingeloggte User."
<?php


// Classe JobPolicy prüft, wer welche Aktion mit Jobs durchführen darf.
// Jede Methode entpricht einer Aktion (sehen, erstellen, bearbeiten).
// Rückgabewert ( boolean): true = erlaubt, false = verboten.
// Aufgerufen wird vom JobController z.b. via $this->authorize('aktion', $job)
// AKTUELL: Alle false (NIEMAND darf) - Sicherheitsmodus
// SPÄTER: Ersetzen mit echter Logik (Rollen: arbeitgeber, admin, bewerber)

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Job;
use App\Models\User;

class JobPolicy
{
    /**
     * Determine whether the user can view any models.
     * Gäste haben den wert "null" somit aus function param angepasst (User $user) -> (?User $user)
     */
    public function viewAny(?User $user): bool
    {
        return true; // auch Gäste dürfen Jobs sehen
    }

    /**
     * Determine whether the user can view the model.
     * Gäste haben den wert "null" somit aus function param angepasst (User $user) -> (?User $user)
     */
    public function view(?User $user, Job $job): bool
    {
        return true; // auch Gäste dürfen Job details einsehen
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'arbeitgeber' || $user->role === 'admin'; // nur arbeitgeber dürfen Job erstellen ODER ADMIN
    }

    /**
     * Determine whether the user can update the model.
     * Darf bearbeitet werden wenn, der eingeloggte User der ersteller ist ODER ADMIN
     * So die theorie
     */
    public function update(User $user, Job $job): bool
    {
        return $user->id === $job->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     * Darf bearbeitet werden wenn, der eingeloggte User der ersteller ist ODER ADMIN
     */
    public function delete(User $user, Job $job): bool
    {
       return $user->id === $job->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Job $job): bool
    {
        return $user ->role === 'admin'; // nur admins
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Job $job): bool
    {
        return $user ->role === 'admin'; // nur admins
    }
}


/**
 * Merksatz PHP:
 * (User $user) ===  $user MUSS ein user Objekt sein - kein Gast. View würde somit nicht aufgerufen werden. 
 * (?User $user) === $user KANN User oder null sein ( Gast erlaubt )
 */
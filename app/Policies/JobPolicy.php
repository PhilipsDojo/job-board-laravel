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
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Job $job): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Job $job): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Job $job): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Job $job): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Job $job): bool
    {
        return false;
    }
}

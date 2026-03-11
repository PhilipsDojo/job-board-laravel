<?php

// CONTROLLER: Nimmt Browser-Anfragen entgegen und ruft Methoden des Models auf.
// Die Methoden hier (index, show, store, etc.) werden durch Routen aktiviert.
// Aktuell: Alle auf true für erste Tests
// Später : mit ecter Logik ersetzen. dann wird die policy aufgerufen z.b. ($this->authorize())

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // trait für Authorize importieren 

class JobController extends Controller
{
    use AuthorizesRequests; // ermöglicht das prüfen / authorisieren. Darf der aktuelle benutzer die Methode auf das Objekt aufrufen.

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Job::class);
        $jobs = Job::with(['company', 'category'])->get();
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $this->authorize('create', Job::class);
      return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        $this->authorize('create', Job::class);
        Job::create($request->validated());
        return redirect()->route('jobs.index')->with('success', 'Job wurde erstellt!'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $this->authorize('view', $job);
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $this->authorize('update', $job);
       return view('jobs.edit', compact('job')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        // debugging Zeigt alle gesendeten Daten wenn Formular abgeschickt wird 
        // dd($request->all()); 

        // Automatische Prüfung: Wenn Ablaufdatum auf die Vergangenheit gesetzt wird, Job inaktiv setzen
        $this->authorize('update', $job);

        $data = $request->validated();
        if (isset($data['expires_at']) && \Carbon\Carbon::parse($data['expires_at'])->isPast()) {
        $data['is_active'] = false;
        }
        $job->update($data);

    return redirect()->route('jobs.index')->with('success', 'Job wurde aktualisiert!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $this->authorize('delete', Job::class);
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job wurde gelöscht!'); 
    }
}


/**
 * Merksatz beispiel:
 * $this->authorize('update', Job::class);
 * 1. Gehe in JobPolicy
 * 2. Rufe Methode update() auf
 * 3. Wenn true → weiter mit nächster Zeile || Wenn false → 403 Fehler
 * 4  true = return view('jobs.edit', compact('job')); 
 * 5. routing zu view jobs.edit 
 
 */
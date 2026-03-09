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

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::with(['company', 'category'])->get();
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        Job::create($request->validated());
        return redirect()->route('jobs.index')->with('success', 'Job wurde erstellt!'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
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
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job wurde gelöscht!'); 
    }
}

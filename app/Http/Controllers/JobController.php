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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}

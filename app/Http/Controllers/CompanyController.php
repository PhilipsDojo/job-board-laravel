<?php

// Controller: das Rückrad für alle Company aktionen
// Validierung X Autorisierung:
// Validierung =  prüft: sind die Daten korrekt? 
// Autorisierung = Policy prüft ob User die Aktion überhaupt durchführen darf

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     * zeige ALLE Firmen an ( listenansicht)
     * route: GET /companies
     */
    public function index()
    {
        $companies = Company::all();
        // $companies speicher die variable 
        // Company die KLASSE/Bauplan 
        // ::all() Klassenaufruf mit methode

        return view('companies.index', compact('companies')); // an View(FE) übergeben
    }

    /**
     * Show the form for creating a new resource.
     * zeigt das Formular zum erstellen einer neune Firma im view ( FE)
     * route: Get /companies/create
     */
    public function create()
    {
        return view('companies.create');//
    }

    /**
     * Store a newly created resource in storage.
     * Speichert eine NEUE Firma (wenn Formular abgeschickt)
     * route: POST/companies
     */
    public function store(StoreCompanyRequest $request)
    {
        Company::create($request->validated());// NUR validierte Daten speichern
        return redirect()->route('companies.index'); // Nach Aktion X wird zurück zur liste geleitet im VIEW
    }

    /**
     * Display the specified resource.
     * Zeigt eine Firma im Detail
     * route GET /companies/{company}
     */
    public function show(Company $company)
    {
     return view('companies.show', compact('company'));  // compact ist eine PHP Funktion die aus einer Variable ein Array macht.
    }

    /**
     * Show the form for editing the specified resource.
     * Zeigt das Bearbeitungs-Formular für eine Firma
     * route: GET /companies/{company}/edit
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));// AUTORISIERUNG: Läuft automatisch durch Policy (update)
    }

    /**
     * Update the specified resource in storage.
     * Aktualisiert eine BESTEHENDE Firma
     * route: PUT /companies/{company}
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        // VALIDIERUNG: Läuft automatisch durch UpdateCompanyRequest
        // AUTORISIERUNG: Läuft automatisch durch Policy (update)  

        //  Nur die Felder, die im Request validiert wurden werden geupdatet
        $company->update($request->validated());
    
        // Nach erfolgreichem Update: Zur Detailseite der Firma
        return redirect()->route('companies.show', $company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        // Firma aus der Datenbank löschen
        // AUTORISIERUNG: Läuft automatisch durch Policy (delete)
    $company->delete();
        // Nach erfolgreichem Löschen: Zurück zur Firmen-Liste
    return redirect()->route('companies.index');
    }
}

// Merktsatz
// Company::all() gibt keine einfache Liste als ARRAY zurück sondern eine Collection. diese kann wie ein ARRAY genutzt werden bietet aber zusätzliche Werkzeuge

// Beispiele UPDATE: 
// 1. User ruft auf: GET /companies/5/edit (zeigt Formular)
// 2. User ändert Daten und klickt "Speichern"
// 3. Formular sendet PUT /companies/5
// 4. HIER: update() wird ausgeführt
// 5. Firma ist aktualisiert → Weiterleitung zu /companies/5

// DELETE:
// 1. User ist auf /companies/5 (Detailseite)
// 2. User klickt "Löschen"-Button
// 3. Formular sendet DELETE /companies/5
// 4. HIER: destroy() wird ausgeführt
// 5. Firma ist gelöscht → Weiterleitung zu /companies
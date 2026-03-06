<?php

// Controller: das Rückrad für alle Company aktionen
// Validierung X Autorisierung:
// Validierung =  prüft: sind die Daten korrekt? 
// Autorisierung = Policy prüft ob User die Aktion überhaupt durchführen darf

// 2 Methoden erweitert für den BildUpload create und update nähe Infos in den Methoden selbst

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Support\Facades\Storage; // ←Für Image Upload

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
       //   Company::create($request->validated());// NUR validierte Daten speichern
       //   return redirect()->route('companies.index'); // Nach Aktion X wird zurück zur liste geleitet im VIEW

       // inklusive Bild upload neu:
       // was passiert hier 
       //  $request->validated() gibt NUR die Felder zurück, die in StoreCompanyRequest::$rules definiert sind
       // if prüft: Existiert im Request eine Datei mit dem Feldnamen "logo"?
       // Gibt true zurück, wenn eine Datei hochgeladen wurde 
       // $request->file holt die Datei aus dem request herraus und speichert die Infos 
       // in einem Objekt gespeichert diese erbt von der Klasse Laravel Klasse UploadedFile 
       // $path generiert eindeutigen Dateinnamen Speichert datei ab gibt den Pfad zurück und via param 'public' wurd der öffentliche Storage-Disk verwendet 
       // Pfad zum Daten-Array einfügen 
       // werden keine daten gefunden false dann wird die schleife übersprungen
       $data = $request->validated();  
        
       if($request->hasFile('logo')){  
        $path = $request->file('logo')->store('logos', 'public'); 
        $data['logo'] =$path; 
       }

        // create() nimmt das komplette $data-Array
        // gibt es einen 'logo'-Eintrag? ja dann wird in DB gespeichert
        // enthält es keinen? dann  DB bekommt NULL für logo-Spalte
       Company::create($data); // Speichert mit Bildpfad 
       return redirect()->route('companies.index'); 

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

    // ähnlich wie in der create function neue logik für BildUpload:
    // 1. Validierte Daten holen (Textfelder)
    // 2. Wurde ein neues Logo hochgeladen?
    // 3. ALTES Logo löschen (falls vorhanden)
    // 4. NEUES Logo speichern
    // 5. Pfad in Daten-Array einfügen
    $data = $request->validated();
    if ($request->hasFile('logo')) {           
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }       
        $path = $request->file('logo')->store('logos', 'public');               
        $data['logo'] = $path;
    }

    // 6. Firma mit allen Daten aktualisieren
    $company->update($data);

    // 7. Zur Detailseite weiterleiten
    return redirect()->route('companies.show', $company)->with('success', 'Firma wurde aktualisiert');
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
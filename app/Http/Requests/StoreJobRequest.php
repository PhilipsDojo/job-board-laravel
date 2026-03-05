<?php

// Türsteher und Qualitätskontrolle
// beim Aufruf via (NEU ANLEGEN): z.B. POST /jobs
// Bevor ein NEUER Job gespeichert wird, prüft diese Klasse:
// 1. Darf der User überhaupt? (authorize)
// 2. Sind ALLE neuen Daten korrekt? (rules)
// 3. alle Felder werden später mit 'required' geprüft

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * - true  = Ja, der User darf.
     * - false = Nein, der User hat keine Berechtigung
     */
    public function authorize(): bool
    {
        return true ; // damit policy prüfung übernehmen kann
    }

    /**
     * Get the validation rules that apply to the request.
     * QUALITÄTSKONTROLLE: Sind die übergebenen Daten korrekt?
     * Hier wird geprüft: Pflichtfelder, Format, Länge, etc.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

    // hier etwas mehr Validierung:
    //
        return [
            'title' => 'required|string|max:255',                    // Pflichtfeld|Text|max255 Zeichen
            'description' => 'required|string',                      // Pflichtfeld|Text
            'location' => 'required|string|max:255',                 // Pflichtfeld|Text|max255 Zeichen
            'is_active' => 'boolean',                                // optional|true/false
            'expires_at' => 'nullable|date|after:today',             // optional|Datum|muss nach heute liegen
            'company_id' => 'required|exists:companies,id',          // Pflichtfeld|muss in companies-Tabelle existieren
            'category_id' => 'required|exists:categories,id',        // Pflichtfeld|muss in categories-Tabelle existieren
            'user_id' => 'required|exists:users,id',                 // Pflichtfeld|muss in users-Tabelle existieren    //
        ];
    }
}

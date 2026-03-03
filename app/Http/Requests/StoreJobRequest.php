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
        return false;
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
        return [
            //
        ];
    }
}

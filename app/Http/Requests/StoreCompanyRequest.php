<?php

// hier werden neue Companys erstellt 
// prüft beim Anlegen einer neuen Firma:
// 1. Autorisierung: Darf der USer das ? ( wird von Policies geprüft)
// 2. Validierung: sind alle neuen Daten korrekt

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // durch true : Die Policy übernimmt die prüfung. CompanyPolicy.php 
                     // durch false, niemand darf ( Sicherheitsmodus)
    }

    /**
     * Get the validation rules that apply to the request.
     * VALIDIERUNG: Sind die Daten korrekt?
     * Wird bei POST /companies ausgeführt
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
            // 'nur prüfen wenn geändert wurde'
            // Laravel prüft JEDE Regel der reihe nach
            // desshalb sometimes als 1. ignoriere mich falls nicht angegeben. Falls angegeben gelten folgende regeln
        return [
            'name' => 'required|string|max:255',      // Pflichtfeld |erwartet String|max255 Zeichen
            'description' => 'nullable|string',       // Feld darf leer sein |wenn inhalt dann String
            'website' => 'nullable|url|max:255',      // Feld darf leer sein |wenn inhalt dann url| max 255
            'logo' => 'nullable|image|max:2048',      // Feld darf leer sein |wenn inhalt dann (jpg,png,etc| MAX: 2048 Kilobyte = 2 Megabyte
            'user_id' => 'required|exists:users,id',  // Pflichtfeld|| Wer muss in users-Tabelle als id existieren
        ];
    }
}

// Merksatz wie prüft Policy für Store
// 1. User sendet Formular ab Post/companies
// 2. Laravel ruft StoreCompany Request auf
// function authorize entscheidet ob aktion durchgeführt werden darf. 

// 3. Laravel sieht entscheidung = true
// 4. Laravel prüft Gibt es eine policy
// 5. findet Companypolicy.php
// 6. ruft dort function beispielsweise create auf

// return true; bedeutet nicht "immer erlaubt", sondern "überlasse die Entscheidung der Policy"! 

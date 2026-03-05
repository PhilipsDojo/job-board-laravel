<?php

// Türsteher und Qualitätskontrolle 
// beim Aufruf via (BEARBEITEN): z.B. PUT /jobs/{id} (/jobs/5)
// Bevor ein Job aktualisiert wird, prüft diese Klasse:
// 1. Darf der User überhaupt? (authorize)
// 2. Sind die geänderten Daten korrekt? (rules)
// 3. alle Felder werden später mit 'sometimes' geprüft.

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Darf der aktuelle User änderung vornehmen ?
     * 
     */
    public function authorize(): bool
    {
        return true; // policy übernimmt prüfung 
    }

    /**
     * Get the validation rules that apply to the request.
     * Validierung: Sind die geänderten Daten korrekt 
     * prüft nur Felder die im request vorkommen
     * 'sometimes' = Nur prüfen, wenn geändert
     * 'nullable' = darf leer sein
     * 'exists:<ModuleName> muss in entsprechender Tabelle existieren (.id = als id)
     * 'after:today' muss nach heute liegen
     *  
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',           
            'description' => 'sometimes|string',              
            'location' => 'sometimes|string|max:255',         
            'is_active' => 'sometimes|boolean',                
            'expires_at' => 'sometimes|nullable|date|after:today', 
            'company_id' => 'sometimes|exists:companies,id',   
            'category_id' => 'sometimes|exists:categories,id', 
            'user_id' => 'sometimes|exists:users,id',         
        ];
    }
}

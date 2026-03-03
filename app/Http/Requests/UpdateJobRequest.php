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
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     * prüft nur Felder die im request vorkommen
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

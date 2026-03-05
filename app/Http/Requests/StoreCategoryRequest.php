<?php

// Für Aufruf neu anlegen z.B. POST/categories
// Bevor gespeichert wird, prüft die Klasse:
// 1. Darf der User das
// 2. Sind die Daten Korrekt
// 3. alle required felder prüfen

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // damit die policy die prüfung übernimmt policies/categoriePolicy.php
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array

        // Validierung: folgende Daten müssen vorhanden und korrekt sein
    {
        return [
           'name' => 'required|string|max:255|unique:categories', //
        ];
    }
}

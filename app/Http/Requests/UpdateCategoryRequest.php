<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // policy übernimmt auch hier die Prüfung
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {       

        // - Der Name muss in der Tabelle 'categories' einzigartig sein
        // - Aber ignoriere die Kategorie mit der aktuellen ID
        // - So kann eine Kategorie ihren eigenen Namen behalten
        //  Einfach für den Fall der Fälle, eine Kategorie(name) muss mal geändert werden.
        return [
            'name' => 'sometimes|string|max:255|unique:categories,name,' . $this->category->id, //
        ];
    }
}

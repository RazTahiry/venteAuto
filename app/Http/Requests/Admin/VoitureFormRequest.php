<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VoitureFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Design' => ['required'],
            'prix' => ['required', 'integer', 'min:1000000'],
            'nombre' => ['required', 'integer', 'min:1']
        ];
    }

    public function messages()
    {
        return [
            'Design.required' => 'Désignation requise',
            'prix.min' => 'Prix minimum: 1.000.000',
            'prix.required' => 'Prix requis',
            'prix.integer' => 'Prix invalide',
            'nombre.min' => "Nombre non valide",
            'nombre.required' => 'Nombre requis',
            'nombre.integer' => 'Nombre invalide',
        ];
    }
}

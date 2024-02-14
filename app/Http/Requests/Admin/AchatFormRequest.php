<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AchatFormRequest extends FormRequest
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
            'numAchat' => ['required', 'min:4'],
            'idCli' => ['required', 'min:4'],
            'idVoit' => ['required', 'min:4'],
            'date' => ['required', 'date'],
            'qte' => ['required', 'integer']
        ];
    }
}

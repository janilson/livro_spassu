<?php

namespace Livro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nome' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Nome é obrigatório.',
        ];
    }
}

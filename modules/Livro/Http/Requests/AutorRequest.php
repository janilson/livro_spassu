<?php

namespace Livro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nome' => 'required|min:3|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Nome é obrigatório.',
            'nome.min' => 'Nome tem que ter min 3 char.',
            'nome.max' => 'Nome máx. de 20 char',
        ];
    }
}

<?php

namespace Livro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssuntoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'descricao' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'descricao.required' => 'Descrição é obrigatório.',
        ];
    }
}

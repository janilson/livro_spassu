<?php

namespace Livro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivroRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'titulo' => 'required',
            'editora' => 'required',
            'edicao' => 'required',
            'valor' => 'required',
            'ano_publicacao' => 'required',
            'assuntos' => 'required',
            'autores' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'Título é obrigatório.',
            'editora.required' => 'Editora é obrigatória.',
            'edicao.required' => 'Edição é obrigatória.',
            'valor.required' => 'Valor é obrigatório.',
            'ano_publicacao.required' => 'Ano de Publicação é obrigatório.',
            'assuntos.required' => 'Pelo menos um Assunto é obrigatório.',
            'autores.required' => 'Pelo menos um Autor é obrigatório.',
        ];
    }
}

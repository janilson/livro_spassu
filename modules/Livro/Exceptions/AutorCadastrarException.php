<?php

namespace Livro\Exceptions;

use App\Exceptions\AbstractException;

class AutorCadastrarException extends AbstractException
{
    public function __construct(string $message = "Erro ao cadastrar um Autor.", int $code = 302)
    {
        parent::__construct($message, $code);
    }
}

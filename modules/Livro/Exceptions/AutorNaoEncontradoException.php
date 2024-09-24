<?php

namespace Livro\Exceptions;

use App\Exceptions\AbstractException;

class AutorNaoEncontradoException extends AbstractException
{
    public function __construct(string $message = "Autor não encontrado.", int $code = 302)
    {
        parent::__construct($message, $code);
    }
}

<?php

namespace Livro\Exceptions;

use App\Exceptions\AbstractException;

class AssuntoNaoEncontradoException extends AbstractException
{
    public function __construct(string $message = "Assunto não encontrado.", int $code = 302)
    {
        parent::__construct($message, $code);
    }
}

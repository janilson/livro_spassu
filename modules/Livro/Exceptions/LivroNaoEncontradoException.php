<?php

namespace Livro\Exceptions;

use App\Exceptions\AbstractException;

class LivroNaoEncontradoException extends AbstractException
{
    public function __construct(string $message = "Livro não encontrado.", int $code = 302)
    {
        parent::__construct($message, $code);
    }
}

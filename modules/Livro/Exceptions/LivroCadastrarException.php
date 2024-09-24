<?php

namespace Livro\Exceptions;

use App\Exceptions\AbstractException;

class LivroCadastrarException extends AbstractException
{
    public function __construct(string $message = "Erro ao cadastrar um Livro.", int $code = 302)
    {
        parent::__construct($message, $code);
    }
}

<?php

namespace Livro\Exceptions;

use App\Exceptions\AbstractException;

class AssuntoCadastrarException extends AbstractException
{
    public function __construct(string $message = "Erro ao cadastrar um Assunto.", int $code = 302)
    {
        parent::__construct($message, $code);
    }
}

<?php

namespace Livro\Exceptions;

use App\Exceptions\AbstractException;

class AssuntoEditarException extends AbstractException
{
    public function __construct(string $message = "Erro ao editar o Assunto.", int $code = 302)
    {
        parent::__construct($message, $code);
    }
}

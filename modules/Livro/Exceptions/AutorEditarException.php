<?php

namespace Livro\Exceptions;

use App\Exceptions\AbstractException;

class AutorEditarException extends AbstractException
{
    public function __construct(string $message = "Erro ao editar o Autor.", int $code = 302)
    {
        parent::__construct($message, $code);
    }
}

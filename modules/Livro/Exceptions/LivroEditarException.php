<?php

namespace Livro\Exceptions;

use App\Exceptions\AbstractException;

class LivroEditarException extends AbstractException
{
    public function __construct(string $message = "Erro ao editar o Livro.", int $code = 302)
    {
        parent::__construct($message, $code);
    }
}

<?php

namespace Livro\Exceptions;

use App\Exceptions\AbstractException;

class AutorDeletarException extends AbstractException
{
    public function __construct(string $message = "Autor não pode ser deletado.", int $code = 302)
    {
        parent::__construct($message, $code);
    }
}

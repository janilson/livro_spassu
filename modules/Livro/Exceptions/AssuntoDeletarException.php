<?php

namespace Livro\Exceptions;

use App\Exceptions\AbstractException;

class AssuntoDeletarException extends AbstractException
{
    public function __construct(string $message = "Assunto não pode ser deletado.", int $code = 302)
    {
        parent::__construct($message, $code);
    }
}

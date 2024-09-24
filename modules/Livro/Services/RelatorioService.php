<?php

namespace Livro\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livro\Exceptions\AssuntoCadastrarException;
use Livro\Exceptions\AssuntoEditarException;
use Livro\Exceptions\AssuntoNaoEncontradoException;
use Livro\Models\Assunto;
use Livro\Repositories\Interfaces\IAssuntoRepository;
use Livro\Services\Interfaces\IAssuntoService;
use PHPJasper\PHPJasper;

class RelatorioService
{

    public function __construct(
        protected readonly PHPJasper $phpJasper
//        protected readonly IAssuntoRepository $assuntoRepository
    )
    {
    }

    public function compileJRXML(string $input)
    {
        return $this->phpJasper->compile($input);
    }
}

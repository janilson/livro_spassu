<?php

namespace Livro\Services\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livro\Models\Assunto;

interface IAssuntoService
{
    public function cadastrar(array $params): Assunto;

    public function editar(int $id, array $params): Assunto;

    public function deletar(int $assuntoId): bool;

    public function assunto(int $assunto): Assunto;

    public function assuntos(?array $params = null): Collection|LengthAwarePaginator|array;
}

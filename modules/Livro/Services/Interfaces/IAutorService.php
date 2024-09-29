<?php

namespace Livro\Services\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livro\Models\Autor;

interface IAutorService
{
    /**
     * @params array $params
     *
     *
     */
    public function cadastrar(array $params): Autor;

    public function editar(int $id, array $params): Autor;

    public function deletar(int $autorId): bool;

    public function autor(int $autorId): Autor;

    public function autores(?array $params = null): Collection|LengthAwarePaginator|array;
}

<?php

namespace Livro\Services\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livro\Models\Livro;

interface ILivroService
{
    public function cadastrar(array $params): Livro;

    public function editar(int $livroId, array $params): Livro;

    public function livro(int $livroId): Livro;

    public function livros(?array $params = null): Collection|LengthAwarePaginator|array;
}

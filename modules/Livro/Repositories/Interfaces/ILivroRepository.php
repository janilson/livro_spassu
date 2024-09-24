<?php

namespace Livro\Repositories\Interfaces;

use Livro\Models\Livro;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ILivroRepository
{
    /**
     * @params int $livroId
     *
     * @return Livro|null
     */
    public function getLivro(int $livroId): Livro|null;

    /**
     * @params ?array $params
     * @params ?int $perPage
     * @params ?bool $all
     *
     * @return Livro|null
     */
    public function allLivros(?array $params = null, ?int $perPage = 10, ?bool $all = false): Collection|LengthAwarePaginator|array;

    /**
     * @params array $data
     *
     * @return Livro|bool
     */
    public function insert(array $data): Livro|bool;

    /**
     * @params Livro $livro
     * @params array $data
     *
     * @return Livro|bool
     */
    public function update(Livro $livro, array $data): Livro|bool;
}

<?php

namespace Livro\Repositories\Interfaces;

use Livro\Models\Autor;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IAutorRepository
{
    /**
     * @params int $autorId
     *
     * @return Autor|null
     */
    public function getAutor(int $autorId): Autor|null;

    /**
     * @params ?array $params
     * @params ?int $perPage
     * @params ?bool $all
     *
     * @return Autor|null
     */
    public function allAutores(?array $params = null, ?int $perPage = 10, ?bool $all = false): Collection|LengthAwarePaginator|array;

    /**
     * @params array $data
     *
     * @return Autor|bool
     */
    public function insert(array $data): Autor|bool;

    /**
     * @params Autor $autor
     * @params array $data
     *
     * @return Autor|bool
     */
    public function update(Autor $autor, array $data): Autor|bool;

    /**
     * @params Autor $autor
     *
     * @return bool
     */
    public function delete(Autor $autor): bool;
}

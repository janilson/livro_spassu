<?php

namespace Livro\Repositories\Interfaces;

use Livro\Models\Assunto;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IAssuntoRepository
{
    /**
     * @params int $assuntoId
     *
     * @return Assunto|null
     */
    public function getAssunto(int $assuntoId): Assunto|null;

    /**
     * @params ?array $params
     * @params ?int $perPage
     * @params ?bool $all
     *
     * @return Assunto|null
     */
    public function allAssuntos(?array $params = null, ?int $perPage = 10, ?bool $all = false): Collection|LengthAwarePaginator|array;

    /**
     * @params array $data
     *
     * @return Assunto|bool
     */
    public function insert(array $data): Assunto|bool;

    /**
     * @params Assunto $assunto
     * @params array $data
     *
     * @return Assunto|bool
     */
    public function update(Assunto $assunto, array $data): Assunto|bool;

    /**
     * @params Assunto $assunto
     *
     * @return bool
     */
    public function delete(Assunto $assunto): bool;
}

<?php

namespace Livro\Repositories\Interfaces;

use Livro\Models\LivroAutor;

interface ILivroAutorRepository
{
    /**
     * @params int $livroId
     * @params int $autorId
     *
     * @return LivroAutor|null
     */
    public function getLivroAutor(int $livroId, int $autorId): LivroAutor|null;

    /**
     * @params int $autorId
     *
     * @return bool
     */
    public function existsAutorInLivroAutor(int $autorId): bool;

    /**
     * @params array $data
     *
     * @return LivroAutor|bool
     */
    public function insert(array $data): LivroAutor|bool;

    /**
     * @params int $livroId
     *
     * @return bool
     */
    public function deleteAll(int $livroId): bool;
}

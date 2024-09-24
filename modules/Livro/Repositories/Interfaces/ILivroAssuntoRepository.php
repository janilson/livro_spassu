<?php

namespace Livro\Repositories\Interfaces;

use Livro\Models\LivroAssunto;

interface ILivroAssuntoRepository
{
    /**
     * @params int $livroId
     * @params int $assuntoId
     *
     * @return LivroAssunto|null
     */
    public function getLivroAssunto(int $livroId, int $assuntoId): LivroAssunto|null;

    /**
     * @params array $data
     *
     * @return LivroAssunto|bool
     */
    public function insert(array $data): LivroAssunto|bool;

    /**
     * @params int $livroId
     *
     * @return bool
     */
    public function deleteAll(int $livroId): bool;
}

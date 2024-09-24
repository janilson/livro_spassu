<?php

namespace Livro\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livro\Models\Livro;
use Livro\Models\LivroAssunto;
use Livro\Repositories\Interfaces\ILivroAssuntoRepository;
use Livro\Repositories\Interfaces\ILivroRepository;
use Livro\Repositories\Traits\LivroTrait;

class LivroAssuntoRepository implements ILivroAssuntoRepository
{
    public function getLivroAssunto(int $livroId, int $assuntoId): LivroAssunto|null
    {
        $query = LivroAssunto::select()
            ->where('livro_id', $livroId)
            ->where('assunto_id', $assuntoId);

        return $query->first();
    }

    public function insert(array $data): LivroAssunto|bool
    {
        if ($livro = LivroAssunto::create($data)) {
            return $livro;
        }

        return false;
    }

    public function deleteAll(int $livroId): bool
    {
        return LivroAssunto::select()->where('livro_id', $livroId)->delete();
    }
}

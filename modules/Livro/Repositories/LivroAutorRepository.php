<?php

namespace Livro\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livro\Models\Livro;
use Livro\Models\LivroAutor;
use Livro\Repositories\Interfaces\ILivroAutorRepository;
use Livro\Repositories\Interfaces\ILivroRepository;
use Livro\Repositories\Traits\LivroTrait;

class LivroAutorRepository implements ILivroAutorRepository
{
    public function getLivroAutor(int $livroId, int $autorId): LivroAutor|null
    {
        $query = LivroAutor::select()
            ->where('livro_id', $livroId)
            ->where('autor_id', $autorId);

        return $query->first();
    }

    public function insert(array $data): LivroAutor|bool
    {
        if ($livro = LivroAutor::create($data)) {
            return $livro;
        }

        return false;
    }

    public function deleteAll(int $livroId): bool
    {
        return LivroAutor::select()->where('livro_id', $livroId)->delete();
    }
}

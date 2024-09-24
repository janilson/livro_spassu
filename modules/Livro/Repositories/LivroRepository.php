<?php

namespace Livro\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livro\Models\Livro;
use Livro\Repositories\Interfaces\ILivroRepository;
use Livro\Repositories\Traits\LivroTrait;

class LivroRepository implements ILivroRepository
{
    use LivroTrait;

    public function getLivro(int $livroId): Livro|null
    {
        $query = Livro::select();

        return $query->find($livroId);
    }

    public function allLivros(?array $params = null, ?int $perPage = 10, ?bool $all = false): Collection|LengthAwarePaginator|array
    {
        $query = Livro::select();

        $this->filtersAll($query, $params);

        return $all ? $query->get() : $query->paginate($perPage);
    }

    public function insert(array $data): Livro|bool
    {
        if ($livro = Livro::create($data)) {
            return $livro;
        }

        return false;
    }

    public function update(Livro $livro, array $data): Livro|bool
    {
        if (!$livro->update($data)) {
            return false;
        }

        return $livro;
    }
}

<?php

namespace Livro\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livro\Models\Autor;
use Livro\Repositories\Interfaces\IAutorRepository;
use Livro\Repositories\Traits\AutorTrait;

class AutorRepository implements IAutorRepository
{
    use AutorTrait;

    public function getAutor(int $autorId): Autor|null
    {
        $query = Autor::select();

        return $query->find($autorId);
    }

    public function allAutores(?array $params = null, ?int $perPage = 10, ?bool $all = false): Collection|LengthAwarePaginator|array
    {
        $query = Autor::select();

        $this->filtersAll($query, $params);

        return $all ? $query->get() : $query->paginate($perPage);
    }

    public function insert(array $data): Autor|bool
    {
        if ($autor = Autor::create($data)) {
            return $autor;
        }

        return false;
    }

    public function update(Autor $autor, array $data): Autor|bool
    {
        if (!$autor->update($data)) {
            return false;
        }

        return $autor;
    }
}

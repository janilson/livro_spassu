<?php

namespace Livro\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livro\Models\Assunto;
use Livro\Repositories\Interfaces\IAssuntoRepository;
use Livro\Repositories\Traits\AssuntoTrait;

class AssuntoRepository implements IAssuntoRepository
{
    use AssuntoTrait;

    public function getAssunto(int $assuntoId): Assunto|null
    {
        $query = Assunto::select();

        return $query->find($assuntoId);
    }

    public function allAssuntos(?array $params = null, ?int $perPage = 10, ?bool $all = false): Collection|LengthAwarePaginator|array
    {
        $query = Assunto::select();

        $this->filtersAll($query, $params);

        return $all ? $query->get() : $query->paginate($perPage);
    }

    public function insert(array $data): Assunto|bool
    {
        if ($assunto = Assunto::create($data)) {
            return $assunto;
        }

        return false;
    }

    public function update(Assunto $assunto, array $data): Assunto|bool
    {
        if (!$assunto->update($data)) {
            return false;
        }

        return $assunto;
    }

    public function delete(Assunto $assunto): bool
    {
        return $assunto->delete();
    }
}

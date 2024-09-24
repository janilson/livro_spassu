<?php

namespace Livro\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livro\Exceptions\AutorCadastrarException;
use Livro\Exceptions\AutorEditarException;
use Livro\Exceptions\AutorNaoEncontradoException;
use Livro\Models\Autor;
use Livro\Repositories\Interfaces\IAutorRepository;
use Livro\Services\Interfaces\IAutorService;

class AutorService implements IAutorService
{
    public function __construct(
        protected readonly IAutorRepository $autorRepository
    )
    {
    }

    public function cadastrar(array $params): Autor
    {
        $autor = $this->autorRepository->insert($params);

        if (false === $autor) {
            throw new AutorCadastrarException();
        }

        return $autor;
    }

    public function editar(int $id, array $params): Autor
    {
        $autor = $this->autor($id);

        $autor = $this->autorRepository->update($autor, $params);

        if (false === $autor) {
            throw new AutorEditarException();
        }

        return $autor;
    }

    public function autor(int $autorId): Autor
    {
        $autor = $this->autorRepository->getAutor($autorId);

        if (null === $autor) {
            throw new AutorNaoEncontradoException();
        }

        return $autor;
    }

    public function autores(?array $params = null): Collection|LengthAwarePaginator|array
    {
        $perPage = (int)($params['per_page'] ?? 10);
        $all = $params['all'] ?? false;

        return $this->autorRepository->allAutores($params, $perPage, $all);
    }
}

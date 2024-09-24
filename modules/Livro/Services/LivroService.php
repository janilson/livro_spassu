<?php

namespace Livro\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livro\Exceptions\LivroCadastrarException;
use Livro\Exceptions\LivroEditarException;
use Livro\Exceptions\LivroNaoEncontradoException;
use Livro\Models\Livro;
use Livro\Repositories\Interfaces\ILivroAssuntoRepository;
use Livro\Repositories\Interfaces\ILivroAutorRepository;
use Livro\Repositories\Interfaces\ILivroRepository;
use Livro\Services\Interfaces\ILivroService;

class LivroService implements ILivroService
{
    public function __construct(
        protected readonly ILivroAssuntoRepository $livroAssuntoRepository,
        protected readonly ILivroAutorRepository $livroAutorRepository,
        protected readonly ILivroRepository $livroRepository
    ) {
    }

    public function cadastrar(array $params): Livro
    {
        try {
            DB::beginTransaction();

            $assuntos = $params['assuntos'];
            $autores = $params['autores'];

            unset($params['assuntos']);
            unset($params['autores']);

            $livro = $this->livroRepository->insert($params);

            if (false === $livro) {
                throw new LivroCadastrarException();
            }

            $this->cadastrarLivroAssuntos($livro->id, $assuntos);
            $this->cadastrarLivroAutores($livro->id, $autores);

            $livro = $this->livro($livro->id);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new LivroCadastrarException();
        }

        return $livro;
    }

    public function editar(int $livroId, array $params): Livro
    {
        $livro = $this->livro($livroId);

        try {
            DB::beginTransaction();

            $assuntos = $params['assuntos'];
            $autores = $params['autores'];

            unset($params['assuntos']);
            unset($params['autores']);

            $livro = $this->livroRepository->update($livro, $params);

            if (false === $livro) {
                throw new LivroEditarException();
            }

            $this->cadastrarLivroAssuntos($livroId, $assuntos);
            $this->cadastrarLivroAutores($livroId, $autores);

            $livro = $this->livro($livroId);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new LivroEditarException();
        }

        return $livro;
    }

    public function livro(int $livroId): Livro
    {
        $livro = $this->livroRepository->getLivro($livroId);

        if (null === $livro) {
            throw new LivroNaoEncontradoException();
        }

        return $livro;
    }

    public function livros(?array $params = null): Collection|LengthAwarePaginator|array
    {
        $perPage = (int)($params['per_page'] ?? 10);
        $all = $params['all'] ?? false;

        return $this->livroRepository->allLivros($params, $perPage, $all);
    }

    protected function cadastrarLivroAssuntos(int $livroId, array $assuntos)
    {
        if (count($assuntos) > 0) {
            $this->livroAssuntoRepository->deleteAll($livroId);
        }

        foreach ($assuntos as $assuntoId) {
            $params = ['livro_id' => $livroId, 'assunto_id' => $assuntoId];

            $this->livroAssuntoRepository->insert($params);
        }
    }

    protected function cadastrarLivroAutores(int $livroId, array $autores)
    {
        if (count($autores) > 0) {
            $this->livroAutorRepository->deleteAll($livroId);
        }

        foreach ($autores as $autorId) {
            $params = ['livro_id' => $livroId, 'autor_id' => $autorId];

            $this->livroAutorRepository->insert($params);
        }
    }
}

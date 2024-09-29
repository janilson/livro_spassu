<?php

namespace Livro\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livro\Exceptions\AssuntoCadastrarException;
use Livro\Exceptions\AssuntoDeletarException;
use Livro\Exceptions\AssuntoEditarException;
use Livro\Exceptions\AssuntoNaoEncontradoException;
use Livro\Models\Assunto;
use Livro\Repositories\Interfaces\IAssuntoRepository;
use Livro\Repositories\Interfaces\ILivroAssuntoRepository;
use Livro\Services\Interfaces\IAssuntoService;

class AssuntoService implements IAssuntoService
{
    public function __construct(
        protected readonly IAssuntoRepository $assuntoRepository,
        protected readonly ILivroAssuntoRepository $livroAssuntoRepository
    )
    {
    }

    public function cadastrar(array $params): Assunto
    {
        $assunto = $this->assuntoRepository->insert($params);

        if (false === $assunto) {
            throw new AssuntoCadastrarException();
        }

        return $assunto;
    }

    public function editar(int $assuntoId, array $params): Assunto
    {
        $assunto = $this->assunto($assuntoId);

        $assunto = $this->assuntoRepository->update($assunto, $params);

        if (false === $assunto) {
            throw new AssuntoEditarException();
        }

        return $assunto;
    }

    public function deletar(int $assuntoId): bool
    {
        $assunto = $this->assunto($assuntoId);

        if ($this->livroAssuntoRepository->existsAssuntoInLivroAssunto($assuntoId)) {
            throw new AssuntoDeletarException('Assunto está em um ou mais livros. Não pode ser deletado');

        }

        try {
            $this->assuntoRepository->delete($assunto);
        } catch (\Exception $exception) {
            throw new AssuntoDeletarException();
        }

        return true;
    }

    public function assunto(int $assuntoId): Assunto
    {
        $assunto = $this->assuntoRepository->getAssunto($assuntoId);

        if (null === $assunto) {
            throw new AssuntoNaoEncontradoException();
        }

        return $assunto;
    }

    public function assuntos(?array $params = null): Collection|LengthAwarePaginator|array
    {
        $perPage = (int)($params['per_page'] ?? 10);
        $all = $params['all'] ?? false;

        return $this->assuntoRepository->allAssuntos($params, $perPage, $all);
    }
}

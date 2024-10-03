<?php

namespace Livro\Repositories\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

trait AutorTrait
{
    protected function filtersAll(Builder|QueryBuilder &$query, ?array $params = null): void
    {
        if (isset($params['id'])) {
            $query->where('autor.id', $params['id']);
        }

        if (isset($params['nome'])) {
            $query->where('autor.nome', 'like', '%' . $params['nome'] . '%');
        }
    }
}

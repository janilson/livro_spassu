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
    }
}

<?php

namespace Livro\Repositories\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

trait LivroTrait
{
    protected function filtersAll(Builder|QueryBuilder &$query, ?array $params = null): void
    {
        if (isset($params['id'])) {
            $query->where('livro.id', $params['id']);
        }
    }
}

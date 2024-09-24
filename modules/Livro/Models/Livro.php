<?php

namespace Livro\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $table = "livro";
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'editora',
        'edicao',
        'ano_publicacao',
    ];

    public function assuntos()
    {
        return $this->hasMany(LivroAssunto::class, 'livro_id', 'id');
    }

    public function autores()
    {
        return $this->hasMany(LivroAutor::class, 'livro_id', 'id');
    }
}

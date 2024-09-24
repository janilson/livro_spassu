<?php

namespace Livro\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = "autor";
    public $timestamps = false;

    protected $fillable = [
        'nome',
    ];

    public function livros()
    {
        return $this->hasMany(LivroAutor::class, 'autor_id', 'id');
    }
}

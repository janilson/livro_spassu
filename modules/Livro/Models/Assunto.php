<?php

namespace Livro\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    use HasFactory;

    protected $table = "assunto";
    public $timestamps = false;

    protected $fillable = [
        'descricao',
    ];

    public function livros()
    {
        return $this->hasMany(LivroAssunto::class, 'assunto_id', 'id');
    }
}

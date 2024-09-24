<?php

namespace Livro\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivroAssunto extends Model
{
    use HasFactory;

    protected $table = "livro_assunto";
    public $timestamps = false;

    protected $fillable = [
        'livro_id',
        'assunto_id'
    ];

    public function livro()
    {
        return $this->belongsTo(Livro::class, 'livro_id', 'id');
    }

    public function assunto()
    {
        return $this->belongsTo(Autor::class, 'assunto_id', 'id');
    }
}

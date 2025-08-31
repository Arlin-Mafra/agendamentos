<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $table = 'servicos';

    protected $fillable = [
        'nome',
        'preco',
        'duracao'
    ];

    protected $casts = [
        'preco' => 'float',
        'duracao' => 'integer'
    ];

    public function agendamentos()
    {
        return $this->belongsToMany(Agendamento::class, 'agendamento_servicos');
    }
}
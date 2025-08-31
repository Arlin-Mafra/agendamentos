<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendamentoServico extends Model
{
    protected $table = 'agendamento_servicos';

    protected $fillable = [
        'agendamento_id',
        'servico_id'
    ];

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
}
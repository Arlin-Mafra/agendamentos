<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $table = 'agendamentos';

    protected $fillable = [
        'cliente_id',
        'profissional_id',
        'data_hora',
        'status',
        'observacoes'
    ];

    protected $casts = [
        'data_hora' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function profissional()
    {
        return $this->belongsTo(Profissional::class);
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'agendamento_servicos');
    }
}
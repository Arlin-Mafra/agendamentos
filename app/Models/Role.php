<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'nome', // ex: admin, profissional, cliente
        'descricao'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

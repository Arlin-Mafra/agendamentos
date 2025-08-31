<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'tenants';

    protected $fillable = [
        'nome_empresa',
        'plano',
        'status'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

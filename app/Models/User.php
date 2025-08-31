<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'nome',
        'email',
        'senha_hash',
        'role_id',
        'tenant_id',
        'status',
        'ultimo_login'
    ];

    protected $hidden = [
        'senha_hash',
        'remember_token',
    ];

    protected $casts = [
        'ultimo_login' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    // Relacionamentos
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    // ✅ Métodos para Laravel usar 'senha_hash' como password
    
    /**
     * Quando Laravel precisar do password para autenticação,
     * retorna o valor de 'senha_hash'
     */
    public function getAuthPassword()
    {
        return $this->senha_hash;
    }

    /**
     * Quando alguém setar $user->password = 'algo',
     * automaticamente salva em 'senha_hash' com hash
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['senha_hash'] = Hash::make($value);
    }

    /**
     * Getter para acessar como $user->password
     * (retorna o hash da senha)
     */
    public function getPasswordAttribute()
    {
        return $this->senha_hash;
    }
}
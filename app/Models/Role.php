<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'name', 
        'description', 
        'level'
    ];

    public const ADMINISTRADOR = 'Administrador'; 
    public const ADMINISTRADOR_LEVEL = 1;   
    public const GERENTE = 'Gerente';
    public const GERENTE_LEVEL = 3;
    public const USUARIO = 'Usuario';
    public const USUARIO_LEVEL = 5;
    public const VISUALIZADOR = 'Visualizador';
    public const VISUALIZADOR_LEVEL = 99;
}

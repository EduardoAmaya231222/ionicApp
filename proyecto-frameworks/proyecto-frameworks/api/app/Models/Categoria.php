<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'categoria';
    // Campos de la tabla
    protected $fillable = [
        'id',
        'categoria'
    ];
    // Configuracion de las llaves foraneas
    public function gastos()
    {
        return $this->hasMany(Gasto::class);
    }
    public function ingresos()
    {
        return $this->hasMany(Ingreso::class);
    }
}

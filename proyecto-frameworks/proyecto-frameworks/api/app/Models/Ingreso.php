<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'ingreso';
    // Campos de la tabla
    protected $fillable = [
        'categoria',
        'cantidad',
        'tipo',
        'fecha'
    ];
    // Comfiguracion de la llave foranea
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}

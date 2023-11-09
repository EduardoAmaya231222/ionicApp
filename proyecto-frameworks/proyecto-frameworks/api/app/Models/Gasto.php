<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    // Nombre de la tabla
    protected $table = 'gasto';
    // Campos de la tabla
    protected $fillable = [
        'categoria_id', 'cantidad', 'tipo', 'fecha'
    ];
    // Configuracion de la llave foranea
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}

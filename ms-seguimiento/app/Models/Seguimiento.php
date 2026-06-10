<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table = 'seguimientos';

    protected $fillable = [
        'incapacidad_id',
        'fecha_seguimiento',
        'observacion',
        'estado'
    ];
}
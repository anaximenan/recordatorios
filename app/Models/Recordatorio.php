<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    use HasFactory;
    protected $primaryKey = 'recordatorio_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fecha',
        'descripcion',
        'recordatorio',
        'receptores',
        'fecha_recordar',
        'estatus',
        'recordatorio_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // Si tienes algún campo que necesita ser convertido automáticamente a un tipo específico, lo puedes definir aquí
    ];
}

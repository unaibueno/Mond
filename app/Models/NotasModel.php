<?php

namespace App\Models;

use CodeIgniter\Model;

class NotasModel extends Model
{
    protected $table = 'notas';
    protected $primaryKey = 'id_nota';
    protected $allowedFields = [
        'id_usuario',
        'titulo_nota',
        'descripción_nota',
        'contenido_nota',
        'estado',
        'contraseña',
        'carpeta',
        'imagen_nota',
        'id_acceso_notas',
        'fecha_creacion',
        'fecha_actualizacion'
    ];
}

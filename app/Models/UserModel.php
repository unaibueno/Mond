<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = [
        'nombre',
        'apellidos',
        'email',
        'contraseña',
        'fecha_creacion',
        'fecha_actualizacion'
    ];

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {
        $data = $this->hashPassword($data);
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $data = $this->hashPassword($data);
        return $data;
    }

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['contraseña'])) {
            $data['data']['contraseña'] = password_hash($data['data']['contraseña'], PASSWORD_BCRYPT);
        }
        return $data;
    }
}

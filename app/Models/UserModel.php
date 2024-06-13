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
        'fecha_actualizacion',
        'rol'
    ];

    /**
     * Get user data by ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getUserById(int $id)
    {
        return $this->find($id);
    }

    /**
     * Update user data by ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateUserById(int $id, array $data)
    {
        // Set the updated_at timestamp
        if (isset($data['fecha_actualizacion'])) {
            $data['fecha_actualizacion'] = date('Y-m-d H:i:s');
        }

        return $this->update($id, $data);
    }
}

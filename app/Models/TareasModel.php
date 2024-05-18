<?php

namespace App\Models;

use CodeIgniter\Model;

class TareasModel extends Model
{
    protected $table = 'tareas'; // Especifica la tabla que este modelo utiliza
    protected $primaryKey = 'id_tarea'; // Especifica la clave primaria de la tabla, si es necesario

    public function getTareaById($id_tarea)
    {
        $builder = $this->table($this->table); // Utiliza el método table() de CI4
        $builder->select('*'); // Selecciona todas las columnas
        $builder->where('id_tarea', $id_tarea); // Añade la condición where
        $query = $builder->get();
        $result = $query->getResultArray();

        return !empty($result) ? $result : "Sin determinar";
    }
}

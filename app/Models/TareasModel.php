<?php

namespace App\Models;

use CodeIgniter\Model;

class TareasModel extends Model
{
    public function getTareaById($id_tarea)
    {
        $builder = $this->db->table('tareas');
        $builder->select('*'); // Select all columns
        $builder->where('id_tarea', $id_tarea); // Add the where condition
        $query = $builder->get();
        $result = $query->getResultArray();

        return !empty($result) ? $result : "Sin determinar";
    }


}
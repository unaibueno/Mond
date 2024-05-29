<?php

namespace App\Models;

use CodeIgniter\Model;

class TareasModel extends Model
{
    protected $table = 'tareas';
    protected $primaryKey = 'id_tarea';
    protected $allowedFields = [
        'nombre_tarea',
        'descripcion_tarea',
        'estado',
        'fecha_creacion',
        'fecha_actualización',
        'notas_tarea'
    ];
    protected $useTimestamps = true;
    public function getAllTasks()
    {
        return $this->findAll();
    }
    public function saveTask($data)
    {
        log_message('info', 'Datos recibidos para guardar tarea: ' . json_encode($data));

        try {
            if ($this->insert($data)) {
                return ['success' => true];
            } else {
                $errors = $this->errors();
                log_message('error', 'Error al guardar la tarea: ' . json_encode($errors));
                return ['success' => false, 'error' => $errors];
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción al guardar la tarea: ' . $e->getMessage());
            return ['success' => false, 'error' => 'Failed to save task'];
        }
    }

    public function updateTask($id, $data)
    {
        log_message('info', 'Datos recibidos para actualizar tarea: ' . json_encode($data));

        try {
            if ($this->update($id, $data)) {
                return ['success' => true];
            } else {
                $errors = $this->errors();
                log_message('error', 'Error al actualizar la tarea: ' . json_encode($errors));
                return ['success' => false, 'error' => $errors];
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción al actualizar la tarea: ' . $e->getMessage());
            return ['success' => false, 'error' => 'Failed to update task'];
        }
    }

    public function deleteTask($id)
    {
        log_message('info', 'ID de la tarea recibido para eliminar: ' . $id);

        try {
            if ($this->delete($id)) {
                log_message('info', 'Tarea eliminada correctamente');
                return ['success' => true];
            } else {
                $errors = $this->errors();
                log_message('error', 'Error al eliminar la tarea: ' . json_encode($errors));
                return ['success' => false, 'error' => $errors];
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción al eliminar la tarea: ' . $e->getMessage());
            return ['success' => false, 'error' => 'Failed to delete task'];
        }
    }
}

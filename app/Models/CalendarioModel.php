<?php
namespace App\Models;

use CodeIgniter\Model;

class CalendarioModel extends Model
{
    protected $table = 'calendario';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_usuario', 'titulo', 'descripcion', 'fecha_inicio', 'fecha_fin', 'color'];
    protected $useTimestamps = true;

    public function saveEvent($data)
    {
        log_message('info', 'Datos recibidos para guardar evento: ' . json_encode($data));

        try {
            if ($this->insert($data)) {
                log_message('info', 'Evento guardado correctamente: ' . json_encode($data));
                return ['success' => true];
            } else {
                $errors = $this->errors();
                log_message('error', 'Error al guardar el evento: ' . json_encode($errors));
                return ['success' => false, 'error' => $errors];
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción al guardar el evento: ' . $e->getMessage());
            return ['success' => false, 'error' => 'Failed to save event'];
        }
    }
    // En CalendarioModel.php

    public function updateEvent($id, $id_usuario, $data)
    {
        log_message('info', 'Datos recibidos para actualizar evento: ' . json_encode($data));

        try {
            // Llama al método update() con los datos correctos
            if ($this->update($id, $data)) {
                log_message('info', 'Evento actualizado correctamente: ' . json_encode($data));
                return ['success' => true];
            } else {
                $errors = $this->errors();
                log_message('error', 'Error al actualizar el evento: ' . json_encode($errors));
                return ['success' => false, 'error' => $errors];
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción al actualizar el evento: ' . $e->getMessage());
            return ['success' => false, 'error' => 'Failed to update event'];
        }
    }

    public function findEventsByUser($userId)
    {
        return $this->where('id_usuario', $userId)->findAll();
    }

    public function deleteEvent($id)
    {
        log_message('info', 'ID del evento recibido para eliminar: ' . $id);

        try {
            if ($this->delete($id)) {
                log_message('info', 'Evento eliminado correctamente');
                return ['success' => true];
            } else {
                $errors = $this->errors();
                log_message('error', 'Error al eliminar el evento: ' . json_encode($errors));
                return ['success' => false, 'error' => $errors];
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción al eliminar el evento: ' . $e->getMessage());
            return ['success' => false, 'error' => 'Failed to delete event'];
        }
    }
}

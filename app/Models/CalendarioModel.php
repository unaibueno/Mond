<?php
namespace App\Models;

use CodeIgniter\Model;

class CalendarioModel extends Model
{
    protected $table = 'calendario';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titulo', 'descripcion', 'fecha_inicio', 'fecha_fin'];
    protected $useTimestamps = true;

    public function saveEvent($data)
    {
        log_message('info', 'Datos recibidos para guardar evento: ' . json_encode($data));

        try {
            if ($this->insert($data)) {
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

    public function updateEvent($id, $data)
    {
        log_message('info', 'Datos recibidos para actualizar evento: ' . json_encode($data));

        try {
            if ($this->update($id, $data)) {
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

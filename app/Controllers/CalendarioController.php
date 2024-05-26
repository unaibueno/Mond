<?php
namespace App\Controllers;

use App\Models\CalendarioModel;
use CodeIgniter\HTTP\ResponseInterface;

class CalendarioController extends BaseController
{
    protected $calendarioModel;

    public function __construct()
    {
        $this->calendarioModel = new CalendarioModel();
    }

    public function index()
    {
        $data['title'] = "HAZ RTVE | Calendario";
        $data['page_title'] = "Calendario";

        return view('calendario/index', $data);
    }

    public function saveEvent()
    {
        $data = [
            'titulo' => $this->request->getPost('title'),
            'descripcion' => $this->request->getPost('description'),
            'fecha_inicio' => $this->request->getPost('start'),
            'fecha_fin' => $this->request->getPost('end'),
            'color' => $this->request->getPost('color')
        ];

        // Verificar los datos recibidos
        log_message('info', 'Datos recibidos para guardar evento: ' . json_encode($data));

        try {
            if ($this->calendarioModel->save($data)) {
                return $this->response->setJSON(['success' => true]);
            } else {
                $errors = $this->calendarioModel->errors();
                log_message('error', 'Error al guardar el evento: ' . json_encode($errors));
                return $this->response->setJSON(['success' => false, 'error' => $errors]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción al guardar el evento: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'error' => 'Failed to save event']);
        }
    }

    public function updateEvent()
    {
        $id = $this->request->getPost('id');
        $data = [
            'titulo' => $this->request->getPost('title'),
            'descripcion' => $this->request->getPost('description'),
            'fecha_inicio' => $this->request->getPost('start'),
            'fecha_fin' => $this->request->getPost('end'),
            'color' => $this->request->getPost('color')
        ];

        // Verificar los datos recibidos
        log_message('info', 'Datos recibidos para actualizar evento: ' . json_encode($data));

        try {
            if ($this->calendarioModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true]);
            } else {
                $errors = $this->calendarioModel->errors();
                log_message('error', 'Error al actualizar el evento: ' . json_encode($errors));
                return $this->response->setJSON(['success' => false, 'error' => $errors]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción al actualizar el evento: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'error' => 'Failed to update event']);
        }
    }

    public function getEvents()
    {
        $events = $this->calendarioModel->findAll();
        $formattedEvents = array();

        foreach ($events as $event) {
            $formattedEvents[] = [
                'id' => $event['id'], // Asegúrate de incluir el ID del evento
                'title' => $event['titulo'],
                'start' => $event['fecha_inicio'],
                'end' => $event['fecha_fin'],
                'color' => $event['color'] // Añadir el color
            ];
        }

        return $this->response->setJSON($formattedEvents);
    }

    public function deleteEvent()
    {
        $id = $this->request->getJSON()->id;

        // Verificar los datos recibidos
        log_message('info', 'ID del evento recibido para eliminar: ' . $id);

        try {
            if ($this->calendarioModel->delete($id)) {
                return $this->response->setJSON(['success' => true]);
            } else {
                $errors = $this->calendarioModel->errors();
                log_message('error', 'Error al eliminar el evento: ' . json_encode($errors));
                return $this->response->setJSON(['success' => false, 'error' => $errors]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción al eliminar el evento: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'error' => 'Failed to delete event']);
        }
    }
}

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
        $session = session();
        if (!$session->has('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Por favor, inicia sesión primero.');
        }
    }

    public function index()
    {
        $data['title'] = "HAZ RTVE | Calendario";
        $data['page_title'] = "Calendario";

        return view('calendario/index', $data);
    }

    public function saveEvent()
    {
        $session = session();
        $id_usuario = $session->get('id_usuario');

        log_message('info', $id_usuario);
        $data = [
            'id_usuario' => $id_usuario,
            'titulo' => $this->request->getPost('title'),
            'descripcion' => $this->request->getPost('description'),
            'fecha_inicio' => $this->request->getPost('startDate') . ' ' . $this->request->getPost('startTime'),
            'fecha_fin' => $this->request->getPost('endDate') . ' ' . $this->request->getPost('endTime'),
            'color' => $this->request->getPost('color')
        ];

        log_message('info', 'Datos recibidos para guardar evento: ' . json_encode($data));

        try {
            $result = $this->calendarioModel->saveEvent($data);

            if ($result['success']) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'error' => $result['error']]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción al guardar el evento: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'error' => 'Failed to save event']);
        }
    }

    public function updateEvent()
    {
        $id = $this->request->getPost('id');
        $session = session();
        $id_usuario = $session->get('id_usuario');

        // ...
        $data = [
            'titulo' => $this->request->getPost('title'),
            'descripcion' => $this->request->getPost('description'),
            'fecha_inicio' => $this->request->getPost('start'),
            'fecha_fin' => $this->request->getPost('end'),
            'color' => $this->request->getPost('color')
        ];

        log_message('info', 'Datos recibidos para actualizar evento: ' . json_encode($data));

        try {
            if ($this->calendarioModel->updateEvent($id, $id_usuario, $data)) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'error' => 'Unauthorized or event not found']);
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción al actualizar el evento: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'error' => 'Failed to update event']);
        }
    }

    public function getEvents()
    {
        $session = session();
        $id_usuario = $session->get('id_usuario');
        $events = $this->calendarioModel->findEventsByUser($id_usuario);
        $formattedEvents = array();
        foreach ($events as $event) {
            $formattedEvents[] = [
                'id' => $event['id'],
                'title' => $event['titulo'],
                'start' => $event['fecha_inicio'],
                'end' => $event['fecha_fin'],
                'color' => $event['color']
            ];
        }
        return $this->response->setJSON($formattedEvents);
    }

    public function deleteEvent()
    {
        $session = session();
        $id_usuario = $session->get('id_usuario');
        $id = $this->request->getJSON()->id;

        log_message('info', 'ID del evento recibido para eliminar: ' . $id);

        try {
            if ($this->calendarioModel->deleteEvent($id, $id_usuario)) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'error' => 'Unauthorized or event not found']);
            }
        } catch (\Exception $e) {
            log_message('error', 'Excepción al eliminar el evento: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'error' => 'Failed to delete event']);
        }
    }
}

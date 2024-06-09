<?php

namespace App\Controllers;

use App\Models\TareasModel;
use CodeIgniter\Controller;

class TareasController extends BaseController
{
    protected $TareasModel;

    public function __construct()
    {
        $this->TareasModel = new TareasModel();
        $session = session();
        if (!$session->has('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Por favor, inicia sesión primero.');
        }
    }

    public function index()
    {
        $session = session();
        if (!$session->has('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Por favor, inicia sesión primero.');
        }
        $data['title'] = "HAZ RTVE | Tareas";
        $data['page_title'] = "Tareas";
        $data['tasks'] = $this->TareasModel->findAll();

        return view('tareas/index', $data);
    }

    public function save()
    {
        $data = [
            'nombre_tarea' => $this->request->getPost('nombre_tarea'),
            'descripcion_tarea' => $this->request->getPost('descripcion_tarea'),
            'estado' => $this->request->getPost('estado'),
        ];

        log_message('info', 'Datos recibidos para guardar tarea: ' . json_encode($data));

        $result = $this->TareasModel->saveTask($data);
        if ($result['success']) {
            return $this->response->setJSON(['success' => true, 'message' => 'Tarea guardada exitosamente', 'id_tarea' => $result['id']]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Error al guardar la tarea', 'errors' => $result['error']]);
        }
    }

    public function update()
    {
        $id = $this->request->getPost('id_tarea');
        $data = [
            'nombre_tarea' => $this->request->getPost('nombre_tarea'),
            'descripcion_tarea' => $this->request->getPost('descripcion_tarea'),
            'estado' => $this->request->getPost('estado'),
        ];

        log_message('info', 'Datos recibidos para actualizar tarea: ' . json_encode($data));

        $result = $this->TareasModel->updateTask($id, $data);
        if ($result['success']) {
            return $this->response->setJSON(['success' => true, 'message' => 'Tarea actualizada exitosamente']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Error al actualizar la tarea', 'errors' => $result['error']]);
        }
    }

    public function delete()
    {
        $id = $this->request->getJSON()->id_tarea;

        log_message('info', 'ID de la tarea recibido para eliminar: ' . $id);

        $result = $this->TareasModel->deleteTask($id);
        if ($result['success']) {
            return $this->response->setJSON(['success' => true, 'message' => 'Tarea eliminada exitosamente']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Error al eliminar la tarea', 'errors' => $result['error']]);
        }
    }

    public function updateState()
    {
        $id = $this->request->getPost('id_tarea');
        $data = ['estado' => $this->request->getPost('estado')];

        log_message('info', 'Datos recibidos para actualizar estado de la tarea: ' . json_encode($data));

        $result = $this->TareasModel->updateTask($id, $data);
        if ($result['success']) {
            return $this->response->setJSON(['success' => true, 'message' => 'Estado actualizado exitosamente']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Error al actualizar el estado', 'errors' => $result['error']]);
        }
    }

    public function getTaskProgress()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT estado, COUNT(id_tarea) as count FROM tareas GROUP BY estado');
        $results = $query->getResult();

        $data = [
            'en_progreso' => 0,
            'revisadas' => 0,
            'completadas' => 0,
            'en_revision' => 0
        ];

        foreach ($results as $row) {
            switch ($row->estado) {
                case 0:
                    $data['en_progreso'] = $row->count;
                    break;
                case 1:
                    $data['revisadas'] = $row->count;
                    break;
                case 2:
                    $data['completadas'] = $row->count;
                    break;
                case 3:
                    $data['en_revision'] = $row->count;
                    break;
            }
        }

        return $this->response->setJSON($data);
    }

}

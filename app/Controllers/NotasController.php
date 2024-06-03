<?php
namespace App\Controllers;

use App\Models\NotasModel;

class NotasController extends BaseController
{
    public $NotasModel = null;

    public function __construct()
    {
        $this->NotasModel = new NotasModel();
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
        $defaultUserId = 1;

        $data['title'] = "HAZ RTVE | Notas";
        $data['page_title'] = "Notas";
        $data['notes'] = $this->NotasModel->where('id_usuario', $defaultUserId)->findAll();

        return view('notas/index', $data);
    }

    public function saveTitle()
    {
        $defaultUserId = 1; // Cambia este valor según sea necesario

        $data = [
            'id_usuario' => $defaultUserId,
            'titulo_nota' => $this->request->getPost('title'),
            'fecha_actualizacion' => date('Y-m-d H:i:s'),
        ];

        if ($this->request->getPost('id')) {
            $this->NotasModel->update($this->request->getPost('id'), $data);
            $noteId = $this->request->getPost('id');
        } else {
            $data['fecha_creacion'] = date('Y-m-d H:i:s');
            $noteId = $this->NotasModel->insert($data);
        }

        return $this->response->setJSON(['success' => true, 'id' => $noteId]);
    }

    public function saveContent()
    {
        $data = [
            'contenido_nota' => $this->request->getPost('content'),
            'fecha_actualizacion' => date('Y-m-d H:i:s'),
        ];

        if ($this->request->getPost('id')) {
            $this->NotasModel->update($this->request->getPost('id'), $data);
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'ID de nota no proporcionado']);
        }
    }

    public function delete($id)
    {
        $this->NotasModel->delete($id);
        return redirect()->to('/notas');
    }

    public function getNote($id)
    {
        $note = $this->NotasModel->find($id);
        return $this->response->setJSON(['success' => true, 'note' => $note]);
    }
}

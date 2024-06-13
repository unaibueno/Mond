<?php
namespace App\Controllers;

use App\Models\NotasModel;

class NotasController extends BaseController
{
    private $NotasModel = null;

    public function __construct()
    {
        $this->NotasModel = new NotasModel();
        $session = session();

        // Verificar si el usuario está autenticado
        if (!$session->has('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Por favor, inicia sesión primero.');
        }
    }

    public function index()
    {
        $session = session();

        // Obtener el ID de usuario de la sesión
        $userId = $session->get('id_usuario'); // Asegúrate de tener esta clave en tu sesión

        $data['title'] = "HAZ RTVE | Notas";
        $data['page_title'] = "Notas";

        // Obtener todas las notas del usuario actual
        $data['notes'] = $this->NotasModel->where('id_usuario', $userId)->findAll();

        return view('notas/index', $data);
    }

    public function saveTitle()
    {
        $session = session();
        $id_usuario = $session->get('id_usuario'); // Obtener el ID de usuario de la sesión

        $data = [
            'id_usuario' => $id_usuario,
            'titulo_nota' => $this->request->getPost('title'),
            'fecha_actualizacion' => date('Y-m-d H:i:s'),
        ];

        if ($this->request->getPost('id')) {
            // Actualizar la nota existente
            $this->NotasModel->update($this->request->getPost('id'), $data);
            $noteId = $this->request->getPost('id');
        } else {
            // Insertar nueva nota
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
            // Actualizar el contenido de la nota
            $this->NotasModel->update($this->request->getPost('id'), $data);
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'ID de nota no proporcionado']);
        }
    }

    public function delete($id)
    {
        // Eliminar una nota específica
        $this->NotasModel->delete($id);
        return redirect()->to('/notas');
    }

    public function getNote($id)
    {
        // Obtener detalles de una nota específica
        $note = $this->NotasModel->find($id);
        return $this->response->setJSON(['success' => true, 'note' => $note]);
    }
}

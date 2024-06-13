<?php

namespace App\Controllers;

use App\Models\NotasModel;
use App\Models\TareasModel;

class Dashboard extends BaseController
{

    public $TareasModel = null;
    protected $notasModel;
    protected $tareasModel;

    public function __construct()
    {
        $this->notasModel = new NotasModel();
        $this->tareasModel = new TareasModel();
        $this->TareasModel = model('TareasModel');
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
        $data['title'] = "Mond | Inicio";
        $data['page_title'] = "Inicio";


        return view('dashboard/index', $data);
    }

    public function getTasks()
    {
        $session = session();
        $userId = $session->get('id_usuario'); // Obtener el id_usuario de la sesión

        // Filtrar las tareas por el id_usuario
        $tasks = $this->tareasModel->where('id_usuario', $userId)->findAll();

        return $this->response->setJSON(['tasks' => $tasks]);
    }


    public function getNotes()
    {
        $session = session();
        $userId = $session->get('id_usuario'); // Obtener el id_usuario de la sesión

        // Filtrar las notas por el id_usuario
        $notes = $this->notasModel->where('id_usuario', $userId)->findAll();

        return $this->response->setJSON(['notes' => $notes]);
    }

}




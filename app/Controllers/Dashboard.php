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
        $tasks = $this->tareasModel->findAll();
        return $this->response->setJSON(['tasks' => $tasks]);
    }

    public function getNotes()
    {
        $notes = $this->notasModel->findAll();
        return $this->response->setJSON(['notes' => $notes]);
    }
}




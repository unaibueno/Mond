<?php

namespace App\Controllers;

class Dashboard extends BaseController
{

    public $TareasModel = null;
    public function __construct()
    {
        $this->TareasModel = model('TareasModel');
    }

    public function index()
    {
        // $session = session();
        // if (!$session->has('usuario_id')) {
        //     return redirect()->to('/');
        // }

        $data['title'] = "Mond | Inicio";
        $data['page_title'] = "Inicio";

        $data['tareas'] = $this->TareasModel->getTareas();

        return view('dashboard/index', $data);
    }

}

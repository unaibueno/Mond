<?php

namespace App\Controllers;

class Dashboard extends BaseController
{

    public $TareasModel = null;
    public function __construct()
    {
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

}

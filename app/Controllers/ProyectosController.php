<?php

namespace App\Controllers;

class ProyectosController extends BaseController
{
    public $ProyectosModel = null;
    public function __construct()
    {
        $this->ProyectosModel = model('ProyectosModel');
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
        // $session = session();
        // if (!$session->has('usuario_id')) {
        //     return redirect()->to('/');
        // }

        $data['title'] = "HAZ RTVE | Proyectos";
        $data['page_title'] = "Proyectos";

        return view('proyectos/index', $data);
    }



}

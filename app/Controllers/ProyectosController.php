<?php

namespace App\Controllers;

class ProyectosController extends BaseController
{
    public $ProyectosModel = null;
    public function __construct()
    {
        $this->ProyectosModel = model('ProyectosModel');
    }


    public function index()
    {
        // $session = session();
        // if (!$session->has('usuario_id')) {
        //     return redirect()->to('/');
        // }

        $data['title'] = "HAZ RTVE | Proyectos";
        $data['page_title'] = "Proyectos";

        return view('proyectos/index', $data);
    }



}

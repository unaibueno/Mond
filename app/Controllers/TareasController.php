<?php

namespace App\Controllers;

class TareasController extends BaseController
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

        $data['title'] = "HAZ RTVE | Tareas";
        $data['page_title'] = "Tareas";

        $data['tareas'] = $this->TareasModel->getTareas();

        return view('tareas/index', $data);
    }



}

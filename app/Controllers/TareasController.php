<?php

namespace App\Controllers;

class TareasController extends BaseController
{
    public $TareasModel = null;
    public function __construct()
    {
        $this->modelConvocatorias = model('TareasModel');
    }

    public function index()
    {
        // $session = session();
        // if (!$session->has('usuario_id')) {
        //     return redirect()->to('/');
        // }

        $data['temporizador'] = $this->TareasModel->getTemporizador();

        $data['title'] = "HAZ RTVE | Tareas";
        $data['page_title'] = "Tareas";


        return view('tareas/index', $data);
    }



}

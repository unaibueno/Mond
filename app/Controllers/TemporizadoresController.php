<?php

namespace App\Controllers;

class TemporizadoresController extends BaseController
{
    public $TemporizadoresModel = null;
    public function __construct()
    {
        $this->TemporizadoresModel = model('TemporizadoresModel');
    }


    public function index()
    {
        // $session = session();
        // if (!$session->has('usuario_id')) {
        //     return redirect()->to('/');
        // }

        $data['title'] = "HAZ RTVE | Temporizadores";
        $data['page_title'] = "Temporizadores";

        return view('temporizador/index', $data);
    }



}

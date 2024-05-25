<?php

namespace App\Controllers;

class NotasController extends BaseController
{
    public $NotasModel = null;
    public function __construct()
    {
        $this->NotasModel = model('NotasModel');
    }


    public function index()
    {
        // $session = session();
        // if (!$session->has('usuario_id')) {
        //     return redirect()->to('/');
        // }

        $data['title'] = "HAZ RTVE | Notas";
        $data['page_title'] = "Notas";

        return view('notas/index', $data);
    }



}

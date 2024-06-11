<?php

namespace App\Controllers;

class PomodoroController extends BaseController
{
    public $TemporizadoresModel = null;
    public function __construct()
    {
        $this->TemporizadoresModel = model('TemporizadoresModel');
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

        $data['title'] = "HAZ RTVE | Pomodoro";
        $data['page_title'] = "Pomodoro";

        return view('pomodoro/index', $data);
    }



}

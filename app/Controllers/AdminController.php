<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AdminController extends Controller
{
    protected $session;

    public function __construct()
    {
        $this->session = session();

        // Verificar si el usuario está autenticado
        if (!$this->session->has('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Por favor, inicia sesión primero.');
        }

        // Verificar el rol del usuario
        $rol = $this->session->get('rol');
        if ($rol != 1) {
            return redirect()->to('/unauthorized');
        }
    }


    public function index()
    {
        if (!$this->session->has('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Por favor, inicia sesión primero.');
        }

        // Verificar el rol del usuario
        $rol = $this->session->get('rol');
        if ($rol != 1) {
            return redirect()->to('/unauthorized');
        } else if ($rol = 1) {
        }

        return view('admin/index');
    }
}

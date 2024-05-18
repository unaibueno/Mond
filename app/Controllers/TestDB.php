<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Exceptions\DatabaseException;

class TestDB extends Controller
{
    public function index()
    {
        // Conectar a la base de datos usando la configuración por defecto
        $db = \Config\Database::connect();

    }
}

<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Obtener la instancia de la sesión
        $session = session();

        // Verificar si el usuario ha iniciado sesión
        if (!$session->has('isLoggedIn')) {
            // Redirigir al usuario a la página de inicio de sesión
            return redirect()->to('/auth/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se necesita implementar nada aquí por ahora
    }
}

<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function login()
    {
        // Mostrar la vista de login
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function do_register()
    {
        $model = new UserModel();

        // Validar el formulario
        $rules = [
            'nombre' => 'required|min_length[3]|max_length[255]',
            'apellidos' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|is_unique[usuarios.email]',
            'contraseña' => [
                'label' => 'Contraseña',
                'rules' => 'required|min_length[8]|max_length[255]|regex_match[/^(?=.*[A-Z])(?=.*\d).+$/]',
                'errors' => [
                    'regex_match' => 'La {field} debe tener al menos una letra mayúscula y un número.'
                ]
            ],
            'confirmar_contraseña' => 'matches[contraseña]'
        ];

        if ($this->validate($rules)) {
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'apellidos' => $this->request->getPost('apellidos'),
                'email' => $this->request->getPost('email'),
                'contraseña' => $this->request->getPost('contraseña')
            ];

            $model->save($data);

            return redirect()->to('/auth/login')->with('success', 'Registro exitoso. Por favor inicia sesión.');
        } else {
            return view('auth/register', [
                'validation' => $this->validator
            ]);
        }
    }

    public function do_login()
    {
        $session = session();
        $model = new UserModel();

        // Validar el formulario
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]|max_length[255]'
        ];

        if ($this->validate($rules)) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Verificar usuario
            $user = $model->where('email', $email)->first();

            if ($user && password_verify($password, $user['contraseña'])) {
                // Usuario autenticado, establecer sesión
                $session->set([
                    'id_usuario' => $user['id_usuario'],
                    'nombre' => $user['nombre'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to('/dashboard');
            } else {
                // Credenciales inválidas
                $session->setFlashdata('error', 'Correo electrónico o contraseña inválidos.');
                return redirect()->to('/auth/login');
            }
        } else {
            return view('auth/login', [
                'validation' => $this->validator
            ]);
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/auth/login');
    }
}

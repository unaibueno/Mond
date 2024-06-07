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
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function do_register()
    {
        $model = new UserModel();

        $rules = [
            'nombre' => [
                'label' => 'Nombre',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'min_length' => 'El {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'El {field} no puede tener más de {param} caracteres.',
                ],
            ],
            'apellidos' => [
                'label' => 'apellido',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Los {field} son obligatorios.',
                    'min_length' => 'Los {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'Los {field} no puede tener más de {param} caracteres.',
                ],
            ],
            'email' => [
                'label' => 'Correo electrónico',
                'rules' => 'required|valid_email|is_unique[usuarios.email]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'valid_email' => 'El {field} debe ser una dirección de correo electrónico válida.',
                    'is_unique' => 'El {field} ya está registrado.',
                ],
            ],
            'contraseña' => [
                'label' => 'contraseña',
                'rules' => 'required|min_length[8]|max_length[255]|regex_match[/^(?=.*[A-Z])(?=.*\d).+$/]',
                'errors' => [
                    'required' => 'La {field} es obligatoria.',
                    'min_length' => 'La {field} debe tener al menos {param} caracteres.',
                    'max_length' => 'La {field} no puede tener más de {param} caracteres.',
                    'regex_match' => 'La {field} debe tener al menos una letra mayúscula y un número.',
                ],
            ],
            'confirmar_contraseña' => [
                'label' => 'Confirmar contraseña',
                'rules' => 'matches[contraseña]',
                'errors' => [
                    'matches' => 'Las contraseñas no coinciden.',
                ],
            ],
        ];

        if ($this->validate($rules)) {
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'apellidos' => $this->request->getPost('apellidos'),
                'email' => $this->request->getPost('email'),
                'contraseña' => password_hash($this->request->getPost('contraseña'), PASSWORD_DEFAULT)
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

        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]|max_length[255]'
        ];

        if ($this->validate($rules)) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = $model->where('email', $email)->first();

            if ($user && password_verify($password, $user['contraseña'])) {
                $session->set([
                    'id_usuario' => $user['id_usuario'],
                    'nombre' => $user['nombre'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to('/dashboard');
            } else {
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

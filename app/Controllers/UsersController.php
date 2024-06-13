<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UsersController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $session = session();
        if (!$session->has('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Por favor, inicia sesión primero.');
        }
    }

    /**
     * Get user data from session ID.
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function getUser()
    {
        $session = session();
        if (!$session->has('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Por favor, inicia sesión primero.');
        }

        $id_usuario = $session->get('id_usuario');
        $user = $this->userModel->find($id_usuario);

        if ($user) {
            return $this->response->setJSON($user);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'User not found']);
        }
    }

    /**
     * Update user data from session ID.
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function updateUser()
    {
        $session = session();
        if (!$session->has('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Por favor, inicia sesión primero.');
        }

        $id_usuario = $session->get('id_usuario');
        $data = $this->request->getPost();

        // Validate input data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre' => 'required|min_length[3]|max_length[255]',
            'apellidos' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email',
            // Add more validation rules as needed
        ]);

        if (!$validation->run($data)) {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Invalid data', 'errors' => $validation->getErrors()]);
        }

        if ($this->userModel->update($id_usuario, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'User updated successfully']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Failed to update user']);
        }
    }
}

<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SessionModel;
use CodeIgniter\Controller;

class Users extends Controller
{

    public function log_out()
    {
        $session = session();
        $session->destroy();
        return redirect()->to("http://codeigniter-recipe-blog.bmartin97.com/login");
    }

    public function login()
    {
        helper(['form', 'cookie']);

        $data['title'] = ucfirst('login');

        $ci_session = get_cookie("ci_session");

        if (isset($ci_session)) {
            $session_model = new SessionModel();

            if ($session_model->sessionExist($ci_session)) {
                return redirect()->to("http://codeigniter-recipe-blog.bmartin97.com/dashboard");
            }
        }

        if ($this->request->getMethod() == 'post') {
            $model = new UserModel();

            $rules = [
                'username' => 'required|min_length[3]|max_length[20]',
                'password' => 'required|min_length[3]|max_length[20]|validateUser[username,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => 'Wrong username or password'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                // https://codeigniter.com/user_guide/libraries/sessions.html
                $session = session();
                $session_data = [
                    'username' => $this->request->getVar('username'),
                    'logged_in' => date('Y-m-d H:i:s')
                ];
                $session->set($session_data);
                return redirect()->to("http://codeigniter-recipe-blog.bmartin97.com/dashboard");
            }
        }

        echo view('templates/header', $data);
        echo view('pages/login', $data);
        echo view('templates/footer', $data);
    }
    public function register()
    {
        helper(['form']);

        $data['title'] = ucfirst('register');

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => 'required|min_length[3]|max_length[20]|is_unique[user.username]',
                'password' => 'required|min_length[3]|max_length[20]',
                'conf_password' => 'matches[password]'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();

                $user_data = [
                    'username' => $this->request->getVar('username'),
                    'password' => $this->request->getVar('password')
                ];

                $model->save($user_data);

                return redirect()->to("http://codeigniter-recipe-blog.bmartin97.com/login");
            }
        }

        echo view('templates/header', $data);
        echo view('pages/register', $data);
        echo view('templates/footer', $data);
    }

    public function view($page = 'home')
    {
        if (!is_file(APPPATH . '/Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        echo view('templates/header', $data);
        echo view('pages/' . $page, $data);
        echo view('templates/footer', $data);
    }
}

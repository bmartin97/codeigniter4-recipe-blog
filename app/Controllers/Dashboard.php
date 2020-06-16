<?php

namespace App\Controllers;

use App\Models\RecipesModel;
use App\Models\SessionModel;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index($page = false)
    {
        helper('cookie');
        $ci_session = get_cookie("ci_session");
        if (isset($ci_session)) {
            $session_model = new SessionModel();

            if (!$session_model->sessionExist($ci_session)) {
                return redirect()->to("http://codeigniter-recipe-blog.bmartin97.com/login");
            }
        } else {
            return redirect()->to("http://codeigniter-recipe-blog.bmartin97.com/login");
        }
        $session = session();
        $data['username'] = $session->get('username');

        $data['title'] = ucfirst('Dashboard');



        $recipe_model = new RecipesModel();

        $data['recipes'] = $recipe_model->findAll();

        echo view('templates/header', $data);
        echo view('pages/dashboard', $data);
        echo view('templates/footer', $data);
    }
}

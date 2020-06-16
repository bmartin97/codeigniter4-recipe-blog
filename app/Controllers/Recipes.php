<?php

namespace App\Controllers;

use App\Models\RecipesModel;
use App\Models\SessionModel;
use CodeIgniter\Controller;

class Recipes extends Controller
{
    public function overview()
    {
        helper('cookie');

        $ci_session = get_cookie("ci_session");

        if (isset($ci_session)) {
            $session_model = new SessionModel();

            if ($session_model->sessionExist($ci_session)) {
                $session = session();
                $data['username'] = $session->get('username');
            }
        }

        $model = new RecipesModel();

        $data['recipes'] = $model->getRecipes();
        $data['title'] = 'Recipes overview';

        echo view('templates/header', $data);
        echo view('recipes/overview', $data);
        echo view('templates/footer', $data);
    }

    public function recipe($slug = null)
    {
        $model = new RecipesModel();

        $data = $model->getRecipes($slug);

        if (empty($data)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the recipe: ' . $slug);
        }

        helper('cookie');

        $ci_session = get_cookie("ci_session");

        if (isset($ci_session)) {
            $session_model = new SessionModel();

            if ($session_model->sessionExist($ci_session)) {
                $session = session();
                $data['username'] = $session->get('username');
            }
        }

        echo view('templates/header', $data);
        echo view('recipes/view', $data);
        echo view('templates/footer', $data);
    }
}

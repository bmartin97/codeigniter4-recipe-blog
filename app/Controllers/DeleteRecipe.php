<?php

namespace App\Controllers;

use App\Models\RecipesModel;
use App\Models\SessionModel;
use CodeIgniter\Controller;

class DeleteRecipe extends Controller
{
    public function index($slug)
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
        if ($this->request->getMethod() == 'get') {
            $recipe_model = new RecipesModel();

            $recipe_model->where('slug', $slug)->delete();

            $data['message'] = "Recipe deleted";
            return redirect()->to("http://codeigniter-recipe-blog.bmartin97.com/login");
        }
    }
}

<?php

namespace App\Controllers;

use App\Models\RecipesModel;
use App\Models\SessionModel;
use CodeIgniter\Controller;

class EditRecipe extends Controller
{
    public function index($slug = false)
    {
        if (!$slug) {
            return redirect()->to("http://codeigniter-recipe-blog.bmartin97.com/login");
        }

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

        $data['title'] = ucfirst('edit recipe');
        $recipe_model = new RecipesModel();
        $data['recipe'] = $recipe_model->getRecipes($slug);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'title' => 'required|alpha_space',
                'slug' => 'required|alpha_dash|is_unique[recipe.slug]',
                'body' => 'required',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {

                $file = $this->request->getFile('recipe_image');
                if ($file->getSize() > 0) {
                    $file->move('./public/upload', $file->getName());
                };

                $newData = [
                    'title' => $this->request->getVar('title'),
                    'slug' => $this->request->getVar('slug'),
                    'body' => $this->request->getVar('body'),
                    'image' => $file->getName()
                ];

                $recipe_model->where('slug', $slug)->set($newData)->update();

                $data['message'] = "Recipe updated";
            }
        }
        echo view('templates/header', $data);
        echo view('pages/editrecipe', $data);
        echo view('templates/footer', $data);
    }
}

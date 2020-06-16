<?php

namespace App\Controllers;

use App\Models\RecipesModel;
use App\Models\SessionModel;
use CodeIgniter\Controller;

class AddRecipe extends Controller
{
    public function index()
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

        $data['title'] = ucfirst('add recipe');

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'title' => 'required|alpha_space',
                'slug' => 'required|alpha_dash|is_unique[recipe.slug]',
                'body' => 'required',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $recipe_model = new RecipesModel();

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

                $recipe_model->save($newData);

                $data['message'] = "Recipe added";
            }
        }
        echo view('templates/header', $data);
        echo view('pages/addrecipe', $data);
        echo view('templates/footer', $data);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipesModel extends Model
{
    protected $table = 'recipe';

    protected $allowedFields = ['title', 'slug', 'body', 'image'];


    public function getRecipes($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['slug' => $slug])
            ->first();
    }
}

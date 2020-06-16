<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model
{
    protected $table = 'ci_sessions';

    protected $allowedFields = ['id'];

    public function sessionExist($id)
    {
        $result = $this->where('id', $id)
            ->first();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}

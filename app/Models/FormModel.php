<?php

namespace App\Models;

use CodeIgniter\Model;

class FormModel extends Model
{
    protected $table = 'test';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];

    protected $validationRules = [
        'name' => 'required|max_length[100]',
    ];
}
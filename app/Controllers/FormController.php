<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class FormController extends Controller
{
    public function index()
    {
        $model = new UserModel();
        
        // Set the number of records per page
        $perPage = 10;

        // Get the current page number from the query parameter, default to 1
        $currentPage = $this->request->getVar('page') ?? 1;

        // Fetch employee data with pagination
        $employees = $model->paginate($perPage, 'default', $currentPage);

        // Prepare the response data
        $data = [
            'employees' => $employees,
            'pager' => $model->pager,  // Using the built-in pager from the model
        ];

        // Prepare the response in JSON format
        return $this->response->setJSON($data);
    }

    public function store()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $department = $this->request->getPost('department');
        $age = $this->request->getPost('age');
        $contact_number = $this->request->getPost('contact_number');
        $gender = $this->request->getPost('gender');
        $email = $this->request->getPost('email');
        $address = $this->request->getPost('address');

        $data = [
            'username' => $username,
            'password' => password_hash($password ?? '', PASSWORD_DEFAULT), // Hash the password before saving
            'department' => $department,
            'age' => $age,
            'contact_number' => $contact_number,
            'gender' => $gender,
            'email' => $email,
            'address' => $address,
        ];
    
        log_message('info', 'Received form data: ' . json_encode($this->request->getPost()));
    
        log_message('info', 'Prepared data for insertion: ' . json_encode($data));
    
        $model = new UserModel();
    
        if ($model->save($data)) {
            return $this->response->setStatusCode(200)->setBody(json_encode(['message' => 'Data inserted successfully.']));
        } else {
            log_message('error', 'Failed to save data: ' . json_encode($model->errors()));
            return $this->response->setStatusCode(400)->setBody(json_encode($model->errors()));
        }
    }

    public function show($id)
    {
        $model = new UserModel();

        $buyer = $model->findById($id);
        if (!$buyer) {
            return $this->response->setStatusCode(404, 'Buyer not found');
        }
        return $this->response->setJSON($buyer);
    } 
}


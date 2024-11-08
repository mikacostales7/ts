<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BuyersModel;
use CodeIgniter\HTTP\ResponseInterface;

class BuyersController extends BaseController
{
    public function index()
    {
        $model = new BuyersModel();
        $perPage = 10;

        $currentPage = $this->request->getVar('page') ?? 1;
        $buyers = $model->paginate($perPage, 'default', $currentPage);

        $data = [
            'buyers' => $buyers,
            'pager' => $model->pager,  
        ];

        return $this->response->setJSON($data);
    }

    public function store()
    {
        $model = new BuyersModel();
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $this->request->getPost('phone_number'),
            'address' => $this->request->getPost('address'),
            'city' => $this->request->getPost('city'),
            'state' => $this->request->getPost('state'),
            'postal_code' => $this->request->getPost('postal_code'),
            'country' => $this->request->getPost('country'),
        ];

        if ($model->save($data)) {
            return redirect()->to('/users')->with('success', 'User created successfully.');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    public function show($id)
    {
        $model = new BuyersModel();
        
        $buyer = $model->findById($id);
        if (!$buyer) {
            return $this->response->setStatusCode(404, 'Buyer not found');
        }

        return $this->response->setJSON($buyer);
    }

    public function put($id)
    {
        $model = new BuyersModel();
        
        $input = $this->request->getJSON();
        $buyer = $model->find($id);
        if (!$buyer) {
            return $this->response->setStatusCode(404)->setBody(json_encode(['message' => 'Buyer not found']));
        }

        $data = [
            'first_name' => $input->first_name ?? $buyer['first_name'], 
            'last_name'  => $input->last_name ?? $buyer['last_name'],
            'email'      => $input->email ?? $buyer['email'],
            'phone_number'=> $input->phone_number ?? $buyer['phone_number'],
            'address'    => $input->address ?? $buyer['address'],
            'city'       => $input->city ?? $buyer['city'],
            'state'      => $input->state ?? $buyer['state'],
            'postal_code' => $input->postal_code ?? $buyer['postal_code'],
            'country'    => $input->country ?? $buyer['country'],
        ];

        if ($model->update($id, $data)) {
            return $this->response->setJSON(['message' => 'Buyer updated successfully']);
        } else {
            return $this->response->setStatusCode(400)->setBody(json_encode(['message' => 'Failed to update buyer']));
        }
    }

    public function delete($id)
    {
        $model = new BuyersModel();

        $buyer = $model->find($id);
        if (!$buyer) {
            return $this->response->setStatusCode(404)->setBody(json_encode(['message' => 'Buyer not found']));
        }

        if ($model->delete($id)) {
            return $this->response->setJSON(['message' => 'Buyer deleted successfully']);
        } else {
            return $this->response->setStatusCode(400)->setBody(json_encode(['message' => 'Failed to delete buyer']));
        }
    }
}

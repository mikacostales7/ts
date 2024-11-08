<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemsModel;
use CodeIgniter\HTTP\ResponseInterface;

class ItemsController extends BaseController
{
    public function index()
    {
        try {
            $model = new ItemsModel();
            $items = $model->findAll();

            $data = [
                'items' => $items,
            ];

            return view('items/index', $data);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'An error occurred: ' . $e->getMessage();
        }
    }

    public function store()
    {
        $model = new ItemsModel();
    
        $items_name = $this->request->getPost('items_name');
        $description = $this->request->getPost('description');
        $category = $this->request->getPost('category');
        $size = $this->request->getPost('size');
        $color = $this->request->getPost('color');
        $price = $this->request->getPost('price');
        $stock = $this->request->getPost('stock');
        $image_url = $this->request->getPost('image_url');

        $data = [
            'items_name' => $items_name, 
            'description' => $description,
            'category' => $category,
            'size' => $size,
            'color' => $color,
            'price' => $price,
            'stock' => $stock,
            'image_url' => $image_url
        ];

        $model->save($data);
    
        return redirect()->to('/items');
    }

    public function show($id)
    {
        $model = new ItemsModel();

        $buyer = $model->findById($id);

        if (!$buyer) {
            return $this->response->setStatusCode(404, 'Buyer not found');
        }

        return $this->response->setJSON($buyer);
    }

    public function update($id)
    {
        $model = new ItemsModel();

        $item = $model->find($id);
        if (!$item) {
            return $this->response->setStatusCode(404)
                ->setJSON(['message' => 'Item not found']);
        }

        $input = $this->request->getPost();

        $data = [
            'items_name'  => $input['items_name'] ?? $item['items_name'],
            'description' => $input['description'] ?? $item['description'],
            'category'    => $input['category'] ?? $item['category'],
            'size'        => $input['size'] ?? $item['size'],
            'color'       => $input['color'] ?? $item['color'],
            'price'       => $input['price'] ?? $item['price'],
            'stock'       => $input['stock'] ?? $item['stock'],
            'image_url'   => $input['image_url'] ?? $item['image_url'],
        ];

        if ($model->update($id, $data)) {
            return redirect()->to('/items')->with('success', 'Item updated successfully');
        } else {
            return $this->response->setStatusCode(400)
                ->setJSON(['message' => 'Failed to update item']);
        }
    }

    
    public function delete($id)
    {
        $model = new ItemsModel();
    
        $items = $model->find($id);
        if (!$items) {
            return $this->response->setStatusCode(404)->setBody(json_encode(['message' => 'Employee not found']));
        }

        $model->delete($id);
        return redirect()->to('/items');
    }

}

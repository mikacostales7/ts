<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('index');
    }

    public function employees(): string
    {
        return view('employees');
    }

    public function items(): string
    {
        return view('items/items');
    }

    public function buyers(): string
    {
        return view('buyers-view');
    }

    public function grantAccess(): string
    {
        return view('authentication/index');
    }

    public function products(): string
    {
        return view('products');
    }

    public function about(): string
    {
        return view('about-us');
    }
}

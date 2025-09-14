<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        return view('user/home_view');
    }

    public function about()
    {
        return view('user/about_view');
    }

    public function products()
    {
        return view('user/product/list_view');
    }

    public function contact()
    {
        return view('user/contact_view');
    }
}

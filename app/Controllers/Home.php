<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\ProductModel;


class Home extends Controller
{
    public function index()
    {
        $productModel = new ProductModel();

        // ambil 3 produk terbaru + gambar pertama
        $latestProducts = $productModel->getLatestProducts(3);

        return view('user/home_view', [
            'latestProducts' => $latestProducts
        ]);
    }

    public function about()
    {
        return view('user/about_view');
    }

    public function products()
    {
        return view('user/product/list_view');
    }

    public function faq()
    {
        return view('user/faq_view');
    }

    public function contact()
    {
        return view('user/contact_view');
    }
}

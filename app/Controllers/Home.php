<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\ProductModel;

use App\Models\BlogModel;


class Home extends Controller
{
    public function index()
    {
        helper('text');

        $productModel = new ProductModel();
        $blogModel = new BlogModel(); // pastikan sudah buat model BlogModel

        // ambil 3 produk terbaru
        $latestProducts = $productModel->getLatestProducts(3);

        // ambil 3 artikel terbaru
        $latestBlogs = $blogModel->orderBy('created_at', 'DESC')->limit(3)->findAll();

        return view('user/home_view', [
            'latestProducts' => $latestProducts,
            'latestBlogs'   => $latestBlogs
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

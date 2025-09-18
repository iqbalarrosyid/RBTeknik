<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductImageModel;

class UserProduct extends BaseController
{
    public function index()
    {
        $productModel = new \App\Models\ProductModel();

        // Ambil input pencarian & sorting dari query string (?search=...&sort=...)
        $search = $this->request->getGet('search');
        $sort   = $this->request->getGet('sort');

        // Query dasar ambil produk + gambar
        $builder = $productModel->select('products.*, MIN(product_images.image_url) as product_image')
            ->join('product_images', 'product_images.product_id = products.id', 'left')
            ->groupBy('products.id');


        // Filter pencarian
        if (!empty($search)) {
            $builder->groupStart()
                ->like('products.product_name', $search)
                ->orLike('products.category', $search)
                ->groupEnd();
        }

        // Sorting
        switch ($sort) {
            case 'az':
                $builder->orderBy('products.product_name', 'ASC');
                break;
            case 'za':
                $builder->orderBy('products.product_name', 'DESC');
                break;
            case 'low_high':
                $builder->orderBy('products.price', 'ASC');
                break;
            case 'high_low':
                $builder->orderBy('products.price', 'DESC');
                break;
            default:
                $builder->orderBy('products.id', 'DESC'); // default terbaru
        }

        // Gunakan paginate() agar $pager tersedia
        $perPage = 6; // jumlah produk per halaman
        $products = $builder->paginate($perPage, 'products');
        $pager    = $builder->pager; // ambil pager

        return view('user/product/list_view', [
            'products' => $products,
            'pager'    => $pager,
            'search'   => $search,
            'sort'     => $sort
        ]);
    }



    /**
     * Halaman untuk menampilkan detail satu produk.
     */
    public function detail($id = null)
    {
        $productModel = new ProductModel();
        $productImageModel = new ProductImageModel();

        $product = $productModel->find($id);

        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk tidak ditemukan dengan ID: ' . $id);
        }

        // Ambil kategori produk saat ini
        $category = $product['category'];

        // Ambil produk terkait beserta 1 gambar utama (pakai LEFT JOIN)
        $related_products = $productModel
            ->select('products.*, MIN(product_images.image_url) as image_url')
            ->join('product_images', 'product_images.product_id = products.id', 'left')
            ->where('products.category', $category)
            ->where('products.id !=', $id)
            ->groupBy('products.id')
            ->limit(3)
            ->findAll();

        $data = [
            'title'            => $product['product_name'],
            'product'          => $product,
            'images'           => $productImageModel->where('product_id', $id)->findAll(),
            'related_products' => $related_products
        ];

        return view('user/product/detail_view', $data);
    }
}

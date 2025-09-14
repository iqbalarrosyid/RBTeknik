<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductImageModel;

class UserProduct extends BaseController
{
    /**
     * Halaman untuk menampilkan semua produk (Katalog).
     */
    public function index()
    {
        $productModel = new \App\Models\ProductModel();
        $products = $productModel->getProductsWithImage();

        return view('user/product/list_view', [
            'products' => $products
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

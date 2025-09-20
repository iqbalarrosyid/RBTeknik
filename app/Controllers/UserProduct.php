<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductImageModel;
use App\Models\ProductVariantModel;
use App\Models\ProductVariantImageModel;

class UserProduct extends BaseController
{
    public function index()
    {
        $productModel = new \App\Models\ProductModel();

        // Ambil input pencarian, sorting & kategori dari query string
        $search   = $this->request->getGet('search');
        $sort     = $this->request->getGet('sort');
        $category = $this->request->getGet('category'); // <- kategori

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

        // Filter kategori
        if (!empty($category)) {
            $builder->where('products.category', $category);
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

        // Paginate
        $perPage  = 6;
        $products = $builder->paginate($perPage, 'products');
        $pager    = $builder->pager;

        // Ambil daftar kategori unik dari produk
        $categories = $productModel->select('category')->distinct()->orderBy('category')->findAll();

        return view('user/product/list_view', [
            'products'   => $products,
            'pager'      => $pager,
            'search'     => $search,
            'sort'       => $sort,
            'category'   => $category,
            'categories' => $categories
        ]);
    }




    /**
     * Halaman untuk menampilkan detail satu produk.
     */
    public function detail($id = null)
    {
        $productModel       = new ProductModel();
        $productImageModel  = new ProductImageModel();
        $variantModel       = new ProductVariantModel();
        $variantImageModel  = new ProductVariantImageModel();

        // Ambil data produk
        $product = $productModel->find($id);

        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk tidak ditemukan dengan ID: ' . $id);
        }

        // Ambil gambar utama produk
        $images = $productImageModel->where('product_id', $id)->findAll();

        // Ambil varian produk beserta gambar masing-masing
        $variants = $variantModel->where('product_id', $id)->findAll();
        foreach ($variants as &$variant) {
            $variant['images'] = $variantImageModel->where('variant_id', $variant['id'])->findAll();
        }

        // Ambil produk terkait (dari kategori yang sama) beserta 1 gambar utama
        $related_products = $productModel
            ->select('products.*, MIN(product_images.image_url) as image_url')
            ->join('product_images', 'product_images.product_id = products.id', 'left')
            ->where('products.category', $product['category'])
            ->where('products.id !=', $id)
            ->groupBy('products.id')
            ->limit(3)
            ->findAll();

        // Tentukan harga min & max, sertakan harga default produk
        $variantPrices = array_column($variants, 'price'); // harga varian
        $variantPrices[] = $product['price']; // tambahkan harga produk default

        $min_price = min($variantPrices);
        $max_price = max($variantPrices);


        $data = [
            'title'            => $product['product_name'],
            'product'          => $product,
            'images'           => $images,
            'variants'         => $variants,
            'related_products' => $related_products,
            'min_price'        => $min_price,
            'max_price'        => $max_price
        ];

        return view('user/product/detail_view', $data);
    }
}

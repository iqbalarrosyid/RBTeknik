<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'product_name',
        'description',
        'price',
        'category'
    ];

    // ambil produk + gambar pertama
    public function getProductsWithImage()
    {
        return $this->db->table('products p')
            ->select('p.*, MIN(pi.image_url) as image_url')
            ->join('product_images pi', 'pi.product_id = p.id', 'left')
            ->groupBy('p.id')
            ->get()
            ->getResultArray();
    }


    // ambil detail produk + semua gambar
    public function getProductWithImages($id)
    {
        $product = $this->find($id);

        if ($product) {
            $imageModel = new \App\Models\ProductImageModel();
            $product['images'] = $imageModel->where('product_id', $id)->findAll();
        }

        return $product;
    }
}

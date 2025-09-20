<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductVariantModel extends Model
{
    protected $table = 'product_variants';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'variant_name', 'price', 'stock'];

    public function getVariantWithImages($variant_id)
    {
        return $this->db->table('product_variant_images')
            ->where('variant_id', $variant_id)
            ->get()
            ->getResultArray();
    }
}

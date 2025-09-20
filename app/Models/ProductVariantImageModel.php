<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductVariantImageModel extends Model
{
    protected $table = 'product_variant_images';
    protected $primaryKey = 'id';
    protected $allowedFields = ['variant_id', 'image_url'];
}

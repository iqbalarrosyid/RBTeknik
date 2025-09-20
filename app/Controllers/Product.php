<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductImageModel;
use App\Models\ProductVariantModel;
use App\Models\ProductVariantImageModel;
use CodeIgniter\Controller;

class Product extends Controller
{
    public function index()
    {
        $productModel = new ProductModel();
        $imageModel   = new ProductImageModel();
        $variantModel = new ProductVariantModel();

        // Ambil input pencarian & sorting dari query string
        $search = $this->request->getGet('search');
        $sort   = $this->request->getGet('sort');

        // Query builder dasar
        $builder = $productModel->select('products.*')->groupBy('products.id');

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
                $builder->orderBy('products.id', 'DESC'); // default: terbaru
        }

        // Pagination
        $perPage = 10;
        $products = $builder->paginate($perPage, 'products');
        $pager    = $builder->pager;

        // Tambah relasi gambar & varian
        foreach ($products as &$product) {
            // Gambar utama produk
            $product['images'] = $imageModel->where('product_id', $product['id'])->findAll();

            // Ambil varian produk
            $variants = $variantModel->where('product_id', $product['id'])->findAll();
            $product['variants'] = $variants; // setiap varian punya harga & nama
        }

        return view('admin/product/index', [
            'products' => $products,
            'pager'    => $pager,
            'search'   => $search,
            'sort'     => $sort
        ]);
    }


    public function create()
    {
        return view('admin/product/create');
    }

    public function store()
    {
        $productModel = new ProductModel();
        $imageModel   = new ProductImageModel();
        $variantModel = new ProductVariantModel();
        $variantImageModel = new ProductVariantImageModel();

        // 1. Validasi Produk Utama
        $rules = [
            'product_name' => 'required',
            'price'        => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Simpan Produk Utama
        $productId = $productModel->insert([
            'product_name' => $this->request->getPost('product_name'),
            'description'  => $this->request->getPost('description'),
            'price'        => $this->request->getPost('price'),
            'category'     => $this->request->getPost('category'),
            'bahan'        => $this->request->getPost('bahan'),
            'warna'        => $this->request->getPost('warna'),
            'panjang'      => $this->request->getPost('panjang'),
            'lebar'        => $this->request->getPost('lebar'),
            'tinggi'       => $this->request->getPost('tinggi'),
        ]);

        // 3. Simpan Foto Produk Utama
        $images = $this->request->getFiles();
        if ($images && isset($images['images'])) {
            foreach ($images['images'] as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $img->move(FCPATH . 'uploads/products', $newName);

                    $imageModel->insert([
                        'product_id' => $productId,
                        'image_url'  => $newName
                    ]);
                }
            }
        }

        // 4. Simpan Varian Produk
        $variants = $this->request->getPost('variants');
        if ($variants) {
            foreach ($variants as $key => $var) {
                $variantId = $variantModel->insert([
                    'product_id'   => $productId,
                    'variant_name' => $var['variant_name'],
                    'price'        => $var['price'] ?? 0,
                ]);

                // 5. Simpan Foto Varian (jika ada)
                if (isset($_FILES['variant_images']['name'][$key])) {
                    $variantFiles = $_FILES['variant_images']['name'][$key];
                    $filesCount = count($variantFiles);

                    for ($i = 0; $i < $filesCount; $i++) {
                        if ($_FILES['variant_images']['error'][$key][$i] === 0) {
                            $tmpName = $_FILES['variant_images']['tmp_name'][$key][$i];
                            $originalName = $_FILES['variant_images']['name'][$key][$i];
                            $ext = pathinfo($originalName, PATHINFO_EXTENSION);
                            $newName = uniqid('variant_') . '.' . $ext;
                            move_uploaded_file($tmpName, FCPATH . 'uploads/products/' . $newName);

                            $variantImageModel->insert([
                                'variant_id' => $variantId,
                                'image_url'  => $newName
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()->to('admin/')->with('success', 'Produk berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $productModel = new ProductModel();
        $imageModel = new ProductImageModel();
        $variantModel = new ProductVariantModel();
        $variantImageModel = new ProductVariantImageModel();

        $product = $productModel->find($id);
        $images  = $imageModel->where('product_id', $id)->findAll();
        $variants = $variantModel->where('product_id', $id)->findAll();

        foreach ($variants as &$v) {
            $v['images'] = $variantImageModel->where('variant_id', $v['id'])->findAll();
        }

        return view('admin/product/edit', [
            'product' => $product,
            'images' => $images,
            'variants' => $variants
        ]);
    }

    public function update($id)
    {
        $productModel      = new ProductModel();
        $imageModel        = new ProductImageModel();
        $variantModel      = new ProductVariantModel();
        $variantImageModel = new ProductVariantImageModel();

        // --- Update data produk ---
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'description'  => $this->request->getPost('description'),
            'price'        => $this->request->getPost('price'),
            'category'     => $this->request->getPost('category'),
            'bahan'        => $this->request->getPost('bahan'),
            'warna'        => $this->request->getPost('warna'),
            'panjang'      => $this->request->getPost('panjang'),
            'lebar'        => $this->request->getPost('lebar'),
            'tinggi'       => $this->request->getPost('tinggi'),
        ];
        $productModel->update($id, $data);

        // --- Hapus gambar utama lama jika dicentang ---
        $deleteImages = $this->request->getPost('delete_images');
        if ($deleteImages && is_array($deleteImages)) {
            foreach ($deleteImages as $imgId) {
                $imgData = $imageModel->find($imgId);
                if ($imgData) {
                    if (file_exists(FCPATH . 'uploads/products/' . $imgData['image_url'])) {
                        unlink(FCPATH . 'uploads/products/' . $imgData['image_url']);
                    }
                    $imageModel->delete($imgId);
                }
            }
        }

        // --- Upload gambar utama baru ---
        $newFiles = $this->request->getFileMultiple('new_images'); // pastikan input name="new_images[]" dan multiple
        if ($newFiles) {
            foreach ($newFiles as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newFileName = $file->getRandomName();
                    $file->move(FCPATH . 'uploads/products/', $newFileName);

                    $imageModel->insert([
                        'product_id' => $id,
                        'image_url'  => $newFileName
                    ]);
                } else {
                    log_message('error', 'Gagal upload gambar utama: ' . $file->getErrorString());
                }
            }
        }

        // --- Update / tambah varian ---
        $variants = $this->request->getPost('variants'); // array dari form
        $variants = is_array($variants) ? $variants : [];

        // Ambil semua varian lama dari DB
        $oldVariants = $variantModel->where('product_id', $id)->findAll();
        $oldVariantIds = array_column($oldVariants, 'id');

        // ID varian yang ada di form
        $formVariantIds = [];
        foreach ($variants as $v) {
            if (isset($v['id'])) {
                $formVariantIds[] = $v['id'];
            }
        }

        // --- Hapus varian yang dihapus di form ---
        $variantsToDelete = array_diff($oldVariantIds, $formVariantIds);
        foreach ($variantsToDelete as $delId) {
            // Hapus gambar varian dulu
            $variantImages = $variantImageModel->where('variant_id', $delId)->findAll();
            foreach ($variantImages as $img) {
                if (file_exists(FCPATH . 'uploads/products/' . $img['image_url'])) {
                    unlink(FCPATH . 'uploads/products/' . $img['image_url']);
                }
                $variantImageModel->delete($img['id']);
            }
            // Hapus varian
            $variantModel->delete($delId);
        }

        // --- Update atau tambah varian ---
        foreach ($variants as $index => $v) {
            $vId    = $v['id'] ?? null;
            $vName  = $v['variant_name'] ?? '';
            $vPrice = $v['price'] ?? 0;
            $vStock = $v['stock'] ?? 0;

            if ($vId) {
                $variantModel->update($vId, [
                    'variant_name' => $vName,
                    'price'        => $vPrice,
                    'stock'        => $vStock
                ]);
            } else {
                $vId = $variantModel->insert([
                    'product_id'   => $id,
                    'variant_name' => $vName,
                    'price'        => $vPrice,
                    'stock'        => $vStock
                ]);
            }

            // --- Hapus gambar varian lama jika dicentang ---
            $deleteVariantImages = $this->request->getPost('delete_variant_images')[$vId] ?? [];
            if ($deleteVariantImages && is_array($deleteVariantImages)) {
                foreach ($deleteVariantImages as $imgId) {
                    $imgData = $variantImageModel->find($imgId);
                    if ($imgData) {
                        if (file_exists(FCPATH . 'uploads/products/' . $imgData['image_url'])) {
                            unlink(FCPATH . 'uploads/products/' . $imgData['image_url']);
                        }
                        $variantImageModel->delete($imgId);
                    }
                }
            }

            // --- Upload gambar baru varian ---
            if (isset($_FILES['variant_images']['name'][$index])) {
                $files = $_FILES['variant_images'];
                foreach ($files['name'][$index] as $key => $name) {
                    if ($files['error'][$index][$key] === 0) {
                        $ext = pathinfo($name, PATHINFO_EXTENSION);
                        $newFileName = uniqid() . '.' . $ext;
                        move_uploaded_file($files['tmp_name'][$index][$key], FCPATH . 'uploads/products/' . $newFileName);

                        $variantImageModel->insert([
                            'variant_id' => $vId,
                            'image_url'  => $newFileName
                        ]);
                    }
                }
            }
        }

        return redirect()->to('admin/')->with('success', 'Produk berhasil diperbarui!');
    }




    public function delete($id)
    {
        $productModel = new ProductModel();
        $imageModel   = new ProductImageModel();

        $product = $productModel->find($id);

        if ($product) {
            // Hapus semua gambar produk
            $images = $imageModel->where('product_id', $id)->findAll();
            foreach ($images as $img) {
                $filePath = FCPATH . 'uploads/products/' . $img['image_url'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $imageModel->delete($img['id']);
            }

            // Hapus produk
            $productModel->delete($id);
        }

        return redirect()->to('admin/')->with('success', 'Produk berhasil dihapus!');
    }
}

<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductImageModel;
use CodeIgniter\Controller;

class Product extends Controller
{
    public function index()
    {
        $productModel = new ProductModel();
        $imageModel   = new ProductImageModel();

        // Ambil input pencarian & sorting dari query string
        $search = $this->request->getGet('search');
        $sort   = $this->request->getGet('sort');

        // Query builder
        $builder = $productModel->select('products.*')
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
                $builder->orderBy('products.id', 'DESC'); // default: terbaru
        }

        $products = $builder->findAll();

        // Tambah relasi gambar
        foreach ($products as &$product) {
            $product['images'] = $imageModel->where('product_id', $product['id'])->findAll();
        }

        return view('admin/product/index', [
            'products' => $products,
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

        // validasi produk
        $rules = [
            'product_name' => 'required',
            'price'        => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan produk
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

        // Ambil semua file foto
        $images = $this->request->getFiles();

        if ($images && isset($images['images'])) {
            foreach ($images['images'] as $image) {
                if ($image->isValid() && !$image->hasMoved()) {
                    $newName = $image->getRandomName();
                    $image->move(FCPATH . 'uploads/products', $newName);

                    $imageModel->insert([
                        'product_id' => $productId,
                        'image_url'  => $newName
                    ]);
                }
            }
        }

        return redirect()->to('admin/')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $productModel      = new ProductModel();
        $productImageModel = new ProductImageModel();

        $product = $productModel->find($id);
        $images  = $productImageModel->where('product_id', $id)->findAll();

        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Produk tidak ditemukan");
        }

        return view('admin/product/edit', [
            'product' => $product,
            'images'  => $images
        ]);
    }

    public function update($id)
    {
        $productModel = new ProductModel();
        $imageModel   = new ProductImageModel();

        // 1. Update data produk
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

        // 2. Hapus foto yang dicentang
        $deleteImages = $this->request->getPost('delete_images');
        if ($deleteImages) {
            foreach ($deleteImages as $imgId) {
                $img = $imageModel->find($imgId);
                if ($img) {
                    $filePath = FCPATH . 'uploads/products/' . $img['image_url'];
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                    $imageModel->delete($imgId);
                }
            }
        }

        // 3. Upload foto baru
        $images = $this->request->getFiles();
        if ($images && isset($images['images'])) {
            foreach ($images['images'] as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $img->move(FCPATH . 'uploads/products', $newName);

                    $imageModel->insert([
                        'product_id' => $id,
                        'image_url'  => $newName,
                    ]);
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

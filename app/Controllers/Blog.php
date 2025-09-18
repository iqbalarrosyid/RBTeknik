<?php

namespace App\Controllers;

use App\Models\BlogModel;
use CodeIgniter\HTTP\Request;

class Blog extends BaseController
{
    protected $blogModel;

    public function __construct()
    {
        $this->blogModel = new BlogModel();
    }

    // List blog (untuk halaman publik / dashboard)
    public function index()
    {
        $search = $this->request->getGet('search');
        $sort   = $this->request->getGet('sort');

        $query = $this->blogModel;

        // filter pencarian
        if (!empty($search)) {
            $query = $query->like('title', $search)
                ->orLike('content', $search);
        }

        // urutkan
        switch ($sort) {
            case 'az':
                $query = $query->orderBy('title', 'ASC');
                break;
            case 'za':
                $query = $query->orderBy('title', 'DESC');
                break;
            case 'newest':
                $query = $query->orderBy('created_at', 'DESC');
                break;
            case 'oldest':
                $query = $query->orderBy('created_at', 'ASC');
                break;
            default:
                $query = $query->orderBy('id', 'DESC'); // default paling baru
        }

        $data = [
            'blogs'  => $query->paginate(10, 'blogs'),
            'pager'  => $query->pager,
            'search' => $search,
            'sort'   => $sort,
        ];

        return view('admin/blog/index', $data);
    }


    // Form tambah blog
    public function create()
    {
        return view('admin/blog/create', [
            'errors' => session()->getFlashdata('errors') ?? []
        ]);
    }

    // Simpan blog
    public function store()
    {
        $file = $this->request->getFile('thumbnail');
        $thumbnailName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $thumbnailName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/blog', $thumbnailName); // simpan ke public/uploads/blog
        }

        $slug = url_title($this->request->getPost('title'), '-', true);

        $this->blogModel->save([
            'title'     => $this->request->getPost('title'),
            'slug'      => $slug,
            'content'   => $this->request->getPost('content'),
            'thumbnail' => $thumbnailName,
        ]);

        return redirect()->to('admin/blog')->with('success', 'Blog berhasil ditambahkan');
    }


    // Detail blog (public)
    public function show($slug)
    {
        $data['blog'] = $this->blogModel->where('slug', $slug)->first();
        return view('admin/blog/show', $data);
    }

    public function edit($id)
    {
        $blogModel = new BlogModel();
        $blog = $blogModel->find($id);

        if (!$blog) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Artikel tidak ditemukan");
        }

        return view('admin/blog/edit', ['blog' => $blog]);
    }

    public function update($id)
    {
        $blogModel = new BlogModel();
        $blog = $blogModel->find($id);

        if (!$blog) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Artikel tidak ditemukan");
        }

        $validation = \Config\Services::validation();
        $rules = [
            'title' => 'required|min_length[3]',
            'content' => 'required|min_length[10]',
            'thumbnail' => 'is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
        ];

        $thumbnail = $this->request->getFile('thumbnail');
        if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
            $newName = $thumbnail->getRandomName();
            $thumbnail->move('uploads/blog', $newName);

            // hapus file lama
            if (!empty($blog['thumbnail']) && file_exists('uploads/blog/' . $blog['thumbnail'])) {
                unlink('uploads/blog/' . $blog['thumbnail']);
            }

            $data['thumbnail'] = $newName;
        }

        $blogModel->update($id, $data);

        return redirect()->to('admin/blog')->with('success', 'Artikel berhasil diperbarui.');
    }


    // Hapus blog
    public function delete($id)
    {
        $blog = $this->blogModel->find($id);

        if (!$blog) {
            return redirect()->to('admin/blog')->with('error', 'Artikel tidak ditemukan');
        }

        // hapus file thumbnail kalau ada
        if (!empty($blog['thumbnail']) && file_exists('uploads/blog/' . $blog['thumbnail'])) {
            unlink('uploads/blog/' . $blog['thumbnail']);
        }

        // hapus data dari database
        $this->blogModel->delete($id);

        return redirect()->to('admin/blog')->with('success', 'Artikel berhasil dihapus.');
    }
}

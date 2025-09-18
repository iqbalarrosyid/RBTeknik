<?php

namespace App\Controllers;

use App\Models\BlogModel;

class UserBlog extends BaseController
{
    protected $blogModel;

    public function __construct()
    {
        $this->blogModel = new BlogModel();
    }

    // Halaman list blog
    public function index()
    {
        helper('text'); // supaya word_limiter jalan

        $search = $this->request->getGet('search');
        $sort   = $this->request->getGet('sort');

        $builder = $this->blogModel;

        if ($search) {
            $builder = $builder->like('title', $search)->orLike('content', $search);
        }

        if ($sort == 'oldest') {
            $builder = $builder->orderBy('created_at', 'ASC');
        } elseif ($sort == 'az') {
            $builder = $builder->orderBy('title', 'ASC');
        } elseif ($sort == 'za') {
            $builder = $builder->orderBy('title', 'DESC');
        } else {
            $builder = $builder->orderBy('created_at', 'DESC'); // default paling baru
        }

        // Pagination
        $blogs = $builder->paginate(6, 'blogs'); // 6 artikel per halaman
        $pager = $this->blogModel->pager;

        return view('user/blog/list_view', [
            'blogs'  => $blogs,
            'pager'  => $pager,
            'search' => $search,
            'sort'   => $sort,
        ]);
    }



    // Halaman detail blog
    public function detail($id)
    {
        $blog = $this->blogModel->find($id);

        if (!$blog) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Blog dengan ID $id tidak ditemukan");
        }

        $data = [
            'title' => $blog['title'],
            'blog'  => $blog
        ];

        return view('user/blog/detail_view', $data);
    }
}

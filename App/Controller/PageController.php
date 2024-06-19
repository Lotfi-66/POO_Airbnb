<?php 

namespace App\Controller;

use App\Controller\Controller;


class PageController extends Controller
{
    public function index()
    {
        return $this->view('blog.index');
    }

    public function show(int $id)
    {
        return $this->view('blog.show', compact('id'));
    }

}
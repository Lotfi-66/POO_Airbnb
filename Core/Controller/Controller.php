<?php 

namespace App\Controller;
use MiladRahimi\PhpRouter\View\View;


class Controller
{
    public function view(string $view, array $params = null)
    {
        $view = new View($view, $params);
    }
}
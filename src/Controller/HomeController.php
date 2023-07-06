<?php

namespace App\Controller;

use Core\Controller\Controller;

final class HomeController extends Controller
{
    public function showHome()
    {
        $this->render('home.twig');
    }
}

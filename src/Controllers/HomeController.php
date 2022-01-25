<?php
namespace App\Controllers;

use App\View\View;

class HomeController
{
    public function index()
    {
        return new View('homepage', ['title' => 'Index Page']);
    }
}

<?php
namespace App\Controllers;

use App\View\View;

class StaticPageController
{
    public function about()
    {
        return new View('about', ['title' => 'about']);
    }

    public function test($param1, $param2)
    {
        return "Test Page With param1=$param1 param2=$param2";
    }
}

<?php
namespace App\Controllers;

use App\Model\Post;
use App\View\View;

class PostController
{
    public function index()
    {
        $posts = Post::get();
        return new View('posts', ['title' => 'POSTS', 'posts' => $posts]);
    }
}

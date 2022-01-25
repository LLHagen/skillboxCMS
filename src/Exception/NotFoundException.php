<?php
namespace App\Exception;

use App\View\Renderable;
use App\View\View;

class NotFoundException extends HttpException implements Renderable
{
    public function render()
    {
        header("HTTP/1.1 404 Not Found", 404);
        $view = new View('errors/errors', ['error' => 'Ошибка 404. Страница не найдена']);
        $view->render();
    }
}

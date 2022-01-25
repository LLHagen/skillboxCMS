<?php
namespace App\View;

use App\Exception\ApplicationException;

class View implements Renderable
{
    private string $view;
    private array $data;

    public function __construct($view, $data)
    {
        $this->view = $view;
        $this->data = $data;
    }

    public function render()
    {
        extract($this->data);
        if (file_exists($this->getIncludeTemplate())) {
            include $this->getIncludeTemplate();
        } else {
            throw new ApplicationException($this->getIncludeTemplate() . ' шаблон не найден');
        }
    }

    private function getIncludeTemplate()
    {
        return $_SERVER['DOCUMENT_ROOT'] . VIEW_DIR . str_replace('.', DIRECTORY_SEPARATOR, $this->view) . '.php';
    }
}

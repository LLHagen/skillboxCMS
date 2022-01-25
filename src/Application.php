<?php
namespace App;

use App\Exception\ApplicationException;
use App\Exception\HttpException;
use App\View\View;
use App\View\Renderable;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

class Application
{
    private Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->initialize();
    }

    public function run(string $url, string $method)
    {
        $resultRouterDispatch = $this->router->dispatch($url, $method);

        if ($resultRouterDispatch instanceof Renderable) {
            return $resultRouterDispatch->render();
        } else {
            echo $resultRouterDispatch;
        }

        try {
            $resultRouterDispatch = $this->router->dispatch($url, $method);
            if ($resultRouterDispatch instanceof Renderable) {
                return $resultRouterDispatch->render();
            }
        } catch (ApplicationException $e) {
            echo $url;
            $this->renderException($e);
        }
    }

    private function renderException(ApplicationException $e)
    {
        try {
            if ($e instanceof Renderable) {
                $e->render();
            }
            if ($e instanceof HttpException) {
                if ($e->getCode() != 0) {
                    $code = $e->getCode();
                } else {
                    $code = 500;
                }
                http_response_code($code);

                $view = new View('errors/errors', ['error' => $e->getMessage()]);
                $view->render();
            }
        } catch (ApplicationException $e) {
            echo $e->getMessage();
            die;
        }
        echo $e->getMessage();
    }

    private function initialize()
    {
        $capsule = new Capsule;

        $config = Config::getInstance();

        $host = $config->get('db.mysql.host');
        $db = $config->get('db.mysql.db');
        $user = $config->get('db.mysql.user');
        $password = $config->get('db.mysql.password');

        $capsule->addConnection([
            'driver'        => 'mysql',
            'host'          => $host,
            'database'      => $db,
            'username'      => $user,
            'password'      => $password,
            'charset'       => 'utf8',
            'collation'     => 'utf8_unicode_ci',
            'prefix'        => '',
        ]);

        $capsule->setEventDispatcher(new Dispatcher(new Container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}

<?php
namespace App;

use Closure;

class Route
{
    private string $method;
    private string $path;
    private array $callback;

    public function __construct(string $method, string $path, array $callback)
    {
        $this->method   = $method;
        $this->path     = $path;
        $this->callback = $callback;
    }

    private function prepareCallback(array $callback): Closure
    {
        return function (...$params) use ($callback) {
            list($class, $method,) = $callback;
            return (new $class)->{$method}(...$params);
        };
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
    public function match(string $uri, string $method): bool
    {
        return preg_match('/^' . str_replace(['*', '/'], ['\w+', '\/'], $this->getPath()) . '$/', $uri) && $this->getMethod() === $method;
    }

    public function run(string $uri)
    {
        $param = explode("/", $uri);
        if (count($param) > 1) {
            foreach (range(0, count($param), 2) as $key) {
                unset($param[$key]);
            }
        } else {
            $param = [];
        }

        return call_user_func_array($this->prepareCallback($this->callback), $param);
    }
}

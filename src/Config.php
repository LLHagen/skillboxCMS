<?php
namespace App;

final class Config
{
    private static $instance;
    private array $configurations = [];

    private function __construct()
    {
        $this->load();
    }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): Config
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    private function load()
    {
        $dirConfig = $_SERVER['DOCUMENT_ROOT'] . '/configs';
        $dirs = scandir($dirConfig);
        $dirs = array_diff($dirs, array('.', '..'));

        foreach ($dirs as $dir) {
            $match = [];
            if (preg_match('/(.*?).php|si$/', $dir, $match)) {
                $this->configurations[$match[1]] = require $dirConfig . '/' . $match[1] . '.php';
            }
        }
    }

    public function get(string $config, $default = null)
    {
        return array_get($this->configurations, $config, $default);
    }

}

<?php

function dd(...$params)
{
    echo '<pre>';
    var_dump($params);
    echo '</pre>';
    die;
}

function dump(...$params)
{
    echo '<pre>';
    var_dump($params);
    echo '</pre>';
}

function array_get(array $array, string $key, $default = null)
{
    $keys = explode(".", $key);
    $result = $array;
    foreach ($keys as $key) {
        if (isset($result[$key])) {
            $result = $result[$key];
        } else {
            return $default;
        }
    }
    return $result;
}

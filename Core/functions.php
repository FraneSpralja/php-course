<?php

use Core\Response;
function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function abortUri($code = 404)
{
    http_response_code($code);

    require view_path("{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abortUri($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view_path($path, $attributes = [])
{
    extract($attributes);
    return base_path('views/' . $path);
}
<?php

if (!function_exists('formDelete')) {

    function formDelete(array $data, string $action = '', $tittle = 'Remove'): string {
        $id = uniqid("form_");
        return form_open($action, ['class' => 'd-flex flex-row-reverse', 'id' => $id], $data) .
                btnDelete($tittle, 'btn btn-outline-danger btn-sm', 'data-toggle="modal" data-form-id="' . $id . '" data-target="#modal-confirmation"') .
                form_close();
    }

}

if (!function_exists('btnDelete')) {

    function btnDelete($tittle = 'Remove', $class = 'btn btn-outline-danger btn-sm', string $attributes = ''): string {
        return "<button type=\"button\" class=\"{$class}\" {$attributes}>{$tittle}</button>";
    }

}


if (!function_exists('hasPermission')) {

    function hasPermission(string $controller = '', string $method = 'all'): bool {
        $router = \Config\Services::router();
        $controller = $controller ?: $router->controllerName();
        $method = $method ?: $router->methodName();
        $controller = strpos($controller, '\\') === 0 ? substr($controller, 1) : $controller;

        if (isset(Authorization\Config\Auth::$permission[$controller . '::' . $method])) {
            return (int) Authorization\Config\Auth::$permission[$controller . '::' . $method] == 1;
        }
        if (isset(Authorization\Config\Auth::$permission[$controller . '::'])) {
            return (int) Authorization\Config\Auth::$permission[$controller . '::'] == 1;
        }
        return false;
    }

}

if (!function_exists('linkWithCheckPermission')) {

    function linkWithCheckPermission(string $link, string $content): string {
        return hasPermission() ? '<a href="' . $link . '">' . $content . '</a>' : $content;
    }

}
<?php

if (!function_exists('hasPermission')) {

    /**
     * @param string $controller
     * @param string $method
     * @return bool
     */
    function hasPermission(string $controller, string $method = 'index'): bool {
        $controller = strpos($controller, '\\') === 0 ? substr($controller, 1) : $controller;

        if (isset(Authorization\Config\Auth::$permission[$controller . '::' . $method])) {
            return true;
        } elseif (isset(Authorization\Config\Auth::$permission[$controller])) {
            return true;
        }
        return false;
    }

}

if (!function_exists('crudPermission')) {

    /**
     * @param string $controller
     * @return array ['insert' => true|false, 'update' => true|false, 'delete' => true|false, 'index' => true|false]
     */
    function crudPermission(string $controller, string $create = 'create', $read = 'index', string $update = 'update', string $delete = 'delete'): array {
        return [
            'create' => hasPermission($controller, $create),
            'read' => hasPermission($controller, $read),
            'update' => hasPermission($controller, $update),
            'delete' => hasPermission($controller, $delete)
        ];
    }

}
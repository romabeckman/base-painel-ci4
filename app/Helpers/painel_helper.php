<?php

if (!function_exists('formDelete')) {

    function formDelete(array $data, string $action = '', $tittle = 'Remove'): string {
        $id = uniqid("form_");
        return form_open($action, ['class' => 'd-flex flex-row-reverse', 'id' => $id], $data) .
                "<button type=\"button\" class=\"btn btn-outline-danger btn-sm\" data-toggle=\"modal\" data-form-id=\"{$id}\" data-target=\"#modal-confirmation\"><i class=\"fas fa-trash\"></i></button>" .
                form_close();
    }

}

if (!function_exists('hasPermission')) {

    function hasPermission(string $controller = '', string $method = ''): bool {
        $router = \Config\Services::router();
        $controller = $controller ?: $router->controllerName();
        $method = $method ?: $router->methodName();
        $controller = strpos($controller, '\\') === 0 ? substr($controller, 1) : $controller;

        if ($method && isset(Authorization\Config\Auth::$permission[$controller . '::' . $method])) {
            return true;
        } elseif (isset(Authorization\Config\Auth::$permission[$controller])) {
            return true;
        }
        return false;
    }

}

if (!function_exists('linkWithCheckPermission')) {

    function linkWithCheckPermission(string $link, string $content): string {
        return hasPermission() ? '<a href="' . $link . '">' . $content . '</a>' : $content;
    }

}

if (!function_exists('menuDropdown')) {

    function menuDropdown(string $title, ...$links) {
        $links = implode('', $links);
        return <<<EOF
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="admin-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{$title}</a>
<div class="dropdown-menu" aria-labelledby="admin-dropdown">{$links}</div>
</li>
EOF;
    }

}

if (!function_exists('menuAdministrator')) {

    function menuAdministrator(): string {
        $user = hasPermission('App\Controllers\Administrator\User') ? '<a data-group="/administrator" class="dropdown-item" href="/administrator/user">Usuários</a>' : '';
        $group = hasPermission('App\Controllers\Administrator\Group') ? '<a data-group="/administrator" class="dropdown-item" href="/administrator/group">Grupos</a>' : '';
        $config = hasPermission('App\Controllers\Administrator\Configuration') ? '<a data-group="/administrator" class="dropdown-item" href="/administrator/configuration">Configurações</a>' : '';
        $log = hasPermission('App\Controllers\Administrator\Log') ? '<a data-group="/administrator" class="dropdown-item" href="/administrator/log">Log</a>' : '';

        if ($user || $group || $config || $log) {
            return menuDropdown('Administrar', $user, $group, $config, $log);
        }

        return '';
    }

}
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
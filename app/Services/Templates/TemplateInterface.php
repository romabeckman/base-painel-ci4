<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPInterface.php to edit this template
 */

namespace App\Services\Templates;

/**
 *
 * @author Romário Beckman <romabeckman@yahoo.com.br>
 */
interface TemplateInterface {

    /**
     *
     * @param array $data
     * @param string|null $view
     * @return string
     */
    public function view(array $data = [], string $view = ''): string;
}

<?php

namespace App\Libraries;

/**
 * Description of Script
 *
 * @author Romário Beckman
 */
class Package {

    private $script = [
        'jquery' => 'node_modules/jquery/dist/jquery.min.js',
        'popperjs' => 'node_modules/@popperjs/core/dist/umd/popper.min.js',
        'bootstrap' => 'node_modules/bootstrap/dist/js/bootstrap.min.js',
        'jquery-mask' => 'node_modules/jquery-mask-plugin/dist/jquery.mask.js',
        'painel_main' => 'resources/painel/js/main.js',
    ];
    private $style = [
        'bootstrap' => 'node_modules/bootstrap/dist/css/bootstrap.min.css',
        'fontawesome' => 'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
        'painel_main' => 'resources/painel/css/painel.css',
    ];

    /**
     * @param string|array $name
     * @return string
     */
    public function getScript($name): string {
        if (is_array($name)) {
            return array_reduce($name, function ($c, $key) {
                $c .= $this->load($key, 'js');
                return $c;
            }, '');
        }

        return $this->load($name, 'js');
    }

    /**
     * @param string|array $name
     * @return string
     */
    public function getStyle($name): string {
        if (is_array($name)) {
            return array_reduce($name, function ($c, $key) {
                $c .= $this->load($key, 'css');
                return $c;
            }, '');
        }

        return $this->load($name, 'css');
    }

    private function load(string $name, $type): string {
        if (strpos($name, '.' . $type) !== false) {
            return $type == 'js' ? script_tag($name) : link_tag($name);
        }

        if ($type == 'js') {
            return isset($this->script[$name]) ? script_tag($this->script[$name]) : '';
        } else {
            return isset($this->style[$name]) ? link_tag($this->style[$name]) : '';
        }
    }

}

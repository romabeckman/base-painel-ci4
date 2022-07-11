<?php

namespace Config;

use function \link_tag;
use function \script_tag;

/**
 * Description of Script
 *
 * @author Romário Beckman
 */
class Resource {

    const JS = 'js';
    const CSS = 'css';

    protected $map = [
        'js' => [
            'jquery' => 'node_modules/jquery/dist/jquery.min.js',
            'popperjs' => 'node_modules/@popperjs/core/dist/umd/popper.min.js',
            'bootstrap' => 'node_modules/bootstrap/dist/js/bootstrap.min.js',
            'jquery-mask' => 'node_modules/jquery-mask-plugin/dist/jquery.mask.js',
            'painel_main' => 'resources/painel/js/main.js',
        ],
        'css' => [
            'bootstrap' => 'node_modules/bootstrap/dist/css/bootstrap.min.css',
            'fontawesome' => 'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
            'painel_main' => 'resources/painel/css/painel.css',
            'painel_signin' => 'resources/painel/css/signin.css',
        ]
    ];

    public function __construct(
            protected array $js = [],
            protected array $css = [],
    ) {

    }

    /**
     *
     * @param string $name
     * @return void
     */
    public function addJs(string $name): self {
        $this->js[] = $name;
        return $this;
    }

    /**
     *
     * @param string $name
     */
    public function addCss(string $name): self {
        $this->css[] = $name;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function loadJs(): string {
        return empty($this->js) ? '' : $this->getScript($this->js);
    }

    /**
     *
     * @return string
     */
    public function loadCss(): string {
        return empty($this->css) ? '' : $this->getCss($this->css);
    }

    /**
     * @param string|array $name
     * @return string
     */
    public function getScript($name): string {
        return $this->getResource($name, static::JS);
    }

    /**
     * @param string|array $name
     * @return string
     */
    public function getCss($name): string {
        return $this->getResource($name, static::CSS);
    }

    /**
     *
     * @param type $name
     * @param string $type
     * @return string
     */
    protected function getResource($name, string $type): string {
        if (is_array($name)) {
            return array_reduce($name, function ($c, $key) use ($type) {
                $c .= $this->load($key, $type);
                return $c;
            }, '');
        }

        return $this->load($name, $type);
    }

    /**
     *
     * @param string $name
     * @param string $type
     * @return string
     */
    protected function load(string $name, string $type): string {
        if (strpos($name, '.' . $type) !== false) {
            return $type == static::JS ? script_tag($name) : link_tag($name);
        } elseif (isset($this->map[$type][$name])) {
            return $type == static::JS ? script_tag($this->map[$type][$name]) : link_tag($this->map[$type][$name]);
        }
    }

}

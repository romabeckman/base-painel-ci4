<?php
if (!function_exists('customCheckbox')) {

    /**
     *
     * @param string $name
     * @param string $label
     * @param type $value
     * @param bool $checked
     * @param array $extra
     * @link https://getbootstrap.com/docs/4.1/components/forms/#checkboxes-and-radios-1
     * @return string
     */
    function customCheckbox(string $name, string $label, $value, bool $checked, array $extra = []): string {
        $extra['id'] = $extra['id'] ?? uniqid();
        $extra['class'] = ($extra['class'] ?? '') . ' custom-control-input';
        $checkbox = form_checkbox($name, $value, $checked, $extra);
        return <<<EOF
<div class="custom-control custom-checkbox">
    {$checkbox}
<label class="custom-control-label" for="{$extra['id']}">{$label}</label>
</div>
EOF;
    }

}

if (!function_exists('customRadio')) {

    /**
     *
     * @param string $name
     * @param string $label
     * @param type $value
     * @param bool $checked
     * @param array $extra
     * @link https://getbootstrap.com/docs/4.1/components/forms/#checkboxes-and-radios-1
     * @return string
     */
    function customRadio(string $name, string $label, $value, bool $checked, array $extra = []): string {
        $extra['id'] = $extra['id'] ?? uniqid();
        $extra['class'] = ($extra['class'] ?? '') . ' custom-control-input';
        $checkbox = form_radio($name, $value, $checked, $extra);
        return <<<EOF
<div class="custom-control custom-checkbox">
    {$checkbox}
<label class="custom-control-label" for="{$extra['id']}">{$label}</label>
</div>
EOF;
    }

}
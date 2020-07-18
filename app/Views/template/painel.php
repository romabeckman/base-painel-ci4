<!doctype html>
<html lang="pt-br">
    <head>
        <?php echo $this->include('template/layout/header') ?>
        <?php echo link_tag('resources/painel/css/painel.css'); ?>
        <title>Painel</title>
    </head>

    <body class="bg-light">
        <?php echo $this->include('template/layout/topo') ?>

        <main role="main" class="container">
            <div class="my-2">
                <?php echo $this->include('template/layout/breadcrumb') ?>
                <h4 class="border-bottom border-gray pb-2 mb-0"><?php echo $title ?? ''; ?></h4>
            </div>

            <?php echo $this->include('template/include/error/list') ?>

            <div class="my-3 p-3 bg-white rounded box-shadow">
                <?php echo $this->renderSection('content') ?>
            </div>

        </main>
    </body>

    <?php echo $this->include('template/layout/footer') ?>

    <?php echo $this->include('template/include/modal/confirmation') ?>

    <?php echo $this->include('template/layout/javascript') ?>
    <?php
    if (isset($script_js)) {
        echo is_array($script_js) ? array_reduce($script_js, function ($carry, $js) { return $carry . $js;}, '') : $script_js;
    }
    if (isset($script_css)) {
        echo is_array($script_css) ? array_reduce($script_css, function ($carry, $css) { return $carry . $css;}, '') : $script_css;
    }
    ?>
    <script type="text/javascript" src="/resources/painel/js/main.js"></script>
</html>

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

            <?php echo $this->include('template/include/erros_list') ?>

            <div class="my-3 p-3 bg-white rounded box-shadow">
                <?php echo $this->renderSection('content') ?>
            </div>

        </main>
    </body>

    <footer class="footer">
        <div class="container">
            <span class="text-muted">Footer.</span>
        </div>
    </footer>

    <?php echo $this->include('template/include/modals') ?>
    <?php echo $this->include('template/layout/javascript') ?>
    <script type="text/javascript" src="/resources/painel/js/main.js"></script>
</html>

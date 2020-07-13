<!doctype html>
<html lang="pt-br">
    <head>
        <?php echo $this->include('template/include/header') ?>
        <link rel="stylesheet" href="resources/painel/css/painel.css">

        <title>Painel</title>
    </head>

    <body class="bg-light">

        <?php echo $this->include('template/include/topo') ?>

        <main role="main" class="container">
            <div class="my-4">
                <h5 class="border-bottom border-gray pb-2 mb-0"><?php echo $title ?? ''; ?></h5>
            </div>

            <?php echo $this->include('template/layout/erros_list') ?>

            <?php echo $this->renderSection('content') ?>

            <!--            <div class="my-3 p-3 bg-white rounded box-shadow">
                        </div>-->
        </main>

        <?php echo $this->include('template/include/javascript') ?>
        <script type="text/javascript" src="/resources/painel/js/main.js"></script>
    </body>
    <footer class="footer">
        <div class="container">
            <span class="text-muted">Place sticky footer content here.</span>
        </div>
    </footer>
</html>

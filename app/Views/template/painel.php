<!doctype html>
<html lang="pt-br">
    <head>
        <?php echo $this->include('template/layout/header') ?>
        <title>Painel</title>
    </head>

    <body>
        <?php echo $this->include('template/layout/top') ?>

        <main class="container">

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
    <?php echo $this->include('template/include/modal/alert') ?>
    <?php echo $this->include('template/include/modal/error') ?>

    <?php echo $this->include('template/layout/javascript') ?>
</html>

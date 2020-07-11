<!doctype html>
<html lang="pt-br">
    <head>
        <?php echo $this->include('template/include/header') ?>

        <link rel="stylesheet" href="resources/authentication/css/login.css">
        <title><?php echo $title ?? '' ?></title>
    </head>

    <body class="text-center">
        <?php echo $this->renderSection('content') ?>
        <?php echo $this->include('template/include/javascript') ?>
    </body>
</html>

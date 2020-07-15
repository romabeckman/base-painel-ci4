<!doctype html>
<html lang="pt-br">
    <head>
        <?php echo $this->include('template/layout/header') ?>
        <link rel="stylesheet" href="resources/authentication/css/login.css">
        <?php
        if (isset($captcha_api)) {
            echo '<meta name="grecaptcha-key" content="' . $captcha_api . '">';
            echo '<script src="https://www.google.com/recaptcha/api.js?render=' . $captcha_api . '"></script>';
        }
        ?>
        <title><?php echo $title ?? '' ?></title>
    </head>

    <body class="text-center">
        <?php echo $this->renderSection('content') ?>
        <?php echo $this->include('template/layout/javascript') ?>
        <?php echo isset($captcha_api) ? '<script src="resources/authentication/js/login.js"></script>' : '' ?>
    </body>
</html>

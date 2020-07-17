<!doctype html>
<html lang="pt-br">
    <head>
        <?php echo $this->include('template/layout/header') ?>
        <link rel="stylesheet" href="resources/authentication/css/login.css">
        <?php
        if (isset($reCaptchaV3Api)) {
            echo '<meta name="grecaptcha-key" content="' . $reCaptchaV3Api . '">';
            echo '<script src="https://www.google.com/recaptcha/api.js?render=' . $reCaptchaV3Api . '"></script>';
        }
        ?>
        <title><?php echo $title ?? '' ?></title>
    </head>

    <body class="text-center">
        <?php echo $this->renderSection('content') ?>
        <?php echo $this->include('template/layout/javascript') ?>
        <?php echo isset($reCaptchaV3Api) ? '<script src="/resources/authentication/js/login.js"></script>' : '' ?>
        <?php echo isset($reCaptchaV2Api) ? '<script src="https://www.google.com/recaptcha/api.js" async defer></script>' : '' ?>
    </body>
</html>

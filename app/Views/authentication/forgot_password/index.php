<?php $this->extend('template/login') ?>

<?php $this->section('content') ?>

<main class="form-signin">
    <?php echo form_open('authentication/forgot-password/recovery', ['class' => 'form-signin', 'data-grecaptcha-action' => 'authentication/login/auth']); ?>

    <img class="mb-3" src="<?php echo PROJECT_LOGO; ?>" alt="<?php echo PROJECT_NAME; ?>" width="160">
    <h1 class="h3 mb-3 font-weight-normal">Recuperar senha</h1>

    <?php echo $this->include('template/include/error/login') ?>

    <div class="mb-3">
        <label for="inputLogin" class="sr-only"><?php echo lang('Auth.authentication_login_index_email'); ?></label>
        <?php echo form_input('email', '', 'id="inputLogin" class="form-control" placeholder="' . lang('Auth.authentication_login_index_email') . '" required autofocus', 'email'); ?>
    </div>

    <?php
    if (isset($reCaptchaV2Api)) {
        ?>
        <div class="g-recaptcha mb-3" data-sitekey="<?php echo $reCaptchaV2Api; ?>"></div>
        <?php
    }
    ?>

    <!--<div class="checkbox my-3">
        <label>
            <input type="checkbox" name="remember_me" value="1"> <?php echo lang('Auth.authentication_login_index_remember_me'); ?>
        </label>
    </div>-->
    <button class="btn btn-lg btn-primary btn-block me-3" type="submit"><?php echo lang('Auth.authentication_login_index_loggin'); ?></button>
    <a href="/authentication/login">Voltar</a>
</main>
<?php echo form_close(); ?>
<?php $this->endSection() ?>
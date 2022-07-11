<?php $this->extend('template/login') ?>

<?php $this->section('content') ?>

<main class="form-signin">
    <?php echo form_open('authentication/login/auth', ['class' => 'form-signin', 'data-grecaptcha-action' => 'authentication/login/auth']); ?>

    <img class="mb-1" src="<?php echo PROJECT_LOGO; ?>" alt="<?php echo PROJECT_NAME; ?>" width="114" height="114">
    <h1 class="h3 mb-3 font-weight-normal"><?php echo lang('Auth.authentication_login_index_welcome'); ?></h1>

    <?php echo $this->include('template/include/error/login') ?>

    <div class="mb-3">
        <label for="inputLogin" class="sr-only"><?php echo lang('Auth.authentication_login_index_email'); ?></label>
        <?php echo form_input('email', '', 'id="inputLogin" class="form-control" placeholder="' . lang('Auth.authentication_login_index_email') . '" required autofocus', 'email'); ?>
    </div>

    <div class="mb-3 mb3">
        <label for="inputSenha" class="sr-only"><?php echo lang('Auth.authentication_login_index_password'); ?></label>
        <?php echo form_password('password', '', 'id="inputSenha" class="form-control" placeholder="' . lang('Auth.authentication_login_index_password') . '" required autofocus'); ?>
    </div>

    <?php
    if (isset($reCaptchaV2Api)) {
        ?>
        <div class="g-recaptcha" data-sitekey="<?php echo $reCaptchaV2Api; ?>"></div>
        <?php
    }
    ?>

    <!--<div class="checkbox my-3">
        <label>
            <input type="checkbox" name="remember_me" value="1"> <?php echo lang('Auth.authentication_login_index_remember_me'); ?>
        </label>
    </div>-->
    <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo lang('Auth.authentication_login_index_loggin'); ?></button>
</main>
<!--<a href="authentication/login/forgot-password">Esqueci minha senha</a>-->
<?php echo form_close(); ?>
<?php $this->endSection() ?>
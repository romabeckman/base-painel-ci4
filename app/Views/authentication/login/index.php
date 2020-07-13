<?php $this->extend('template/login') ?>

<?php $this->section('content') ?>
<?php echo form_open('authentication/login/auth', ['class' => 'form-signin', 'data-grecaptcha-action' => 'authentication/login/auth']); ?>

<img class="mb-4" src="<?php echo PROJECT_LOGO; ?>" alt="<?php echo PROJECT_NAME; ?>" width="72" height="72">
<h1 class="h3 mb-3 font-weight-normal"><?php echo lang('Auth.authentication_login_index_welcome'); ?></h1>

<?php echo $this->include('template/layout/erros_login') ?>

<div class="form-group">
    <label for="inputLogin" class="sr-only"><?php echo lang('Auth.authentication_login_index_email'); ?></label>
    <?php echo form_input('email', '', 'id="inputLogin" class="form-control" placeholder="' . lang('Auth.authentication_login_index_email') . '" required autofocus', 'email'); ?>
</div>

<div class="form-group">
    <label for="inputSenha" class="sr-only"><?php echo lang('Auth.authentication_login_index_password'); ?></label>
    <?php echo form_password('password', '', 'id="inputSenha" class="form-control" placeholder="' . lang('Auth.authentication_login_index_password') . '" required autofocus'); ?>
</div>
<div class="checkbox mb-3">
    <label>
        <input type="checkbox" name="remember_me" value="1"> <?php echo lang('Auth.authentication_login_index_remember_me'); ?>
    </label>
</div>

<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo lang('Auth.authentication_login_index_loggin'); ?></button>
<!--<a href="authentication/login/forgot-password">Esqueci minha senha</a>-->
<?php echo form_close(); ?>
<?php $this->endSection() ?>
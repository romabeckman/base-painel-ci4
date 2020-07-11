<?php $this->extend('template/login') ?>

<?php $this->section('content') ?>
<?php echo form_open('authentication/login/auth', ['class' => 'form-signin']); ?>

<img class="mb-4" src="https://getbootstrap.com/docs/4.5/assets/brand/bootstrap-solid.svg" alt="Logo" width="72" height="72">
<h1 class="h3 mb-3 font-weight-normal"><?php echo lang('Auth.authentication_login_index_welcome'); ?></h1>

<?php
if (isset($message_erro)) {
    ?>
    <div class="alert alert-danger" role="alert"><?php echo $message_erro; ?></div>
    <?php
}
?>

<div class="form-group">
    <label for="inputLogin" class="sr-only"><?php echo lang('Auth.authentication_login_index_email'); ?></label>
    <?php echo form_input('email', '', 'id="inputLogin" class="form-control" placeholder="' . lang('Auth.authentication_login_index_email') . '" required autofocus', 'email'); ?>
    <?php
    if (isset($validation) && $validation->hasError('email')) {
        ?>
        <div class="text-danger"><?php echo $validation->getError('email') ?></div>
        <?php
    }
    ?>
</div>

<div class="form-group">
    <label for="inputSenha" class="sr-only"><?php echo lang('Auth.authentication_login_index_password'); ?></label>
    <?php echo form_password('password', '', 'id="inputSenha" class="form-control" placeholder="' . lang('Auth.authentication_login_index_password') . '" required autofocus'); ?>
    <?php
    if (isset($validation) && $validation->hasError('password')) {
        ?>
        <div class="text-danger"><?php echo $validation->getError('password') ?></div>
        <?php
    }
    ?>
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
<?php $this->extend('template/login') ?>

<?php $this->section('content') ?>
<?php echo form_open('authentication/login', ['class' => 'form-signin']); ?>
<img class="mb-4" src="https://getbootstrap.com/docs/4.5/assets/brand/bootstrap-solid.svg" alt="Logo" width="72" height="72">
<h1 class="h3 mb-3 font-weight-normal">Bem vindo</h1>
<label for="inputLogin" class="sr-only">Email</label>
<input type="text" id="inputLogin" class="form-control" placeholder="Login" required autofocus>
<label for="inputSenha" class="sr-only">Password</label>
<input type="password" id="inputSenha" class="form-control" placeholder="Senha" required>

<div class="checkbox mb-3">
    <label>
        <input type="checkbox" name="remember-me" value="1"> Lembrar-me
    </label>
</div>

<button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>
<a href="authentication/login/forgot-password">Esqueci minha senha</a>
<?php echo form_close(); ?>
<?php $this->endSection() ?>
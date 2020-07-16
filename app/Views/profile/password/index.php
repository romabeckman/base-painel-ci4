<?php $this->extend('template/painel') ?>

<?php $this->section('content') ?>

<h6>Atenção aos requisitos mínimos para nova senha:</h6>
<ul>
    <li>Sua senha deve conter no mínimo 8 caracteres (até 32).</li>
    <li>Sua senha deve conter pelo menos 1 letra em maiúsculo.</li>
    <li>Sua senha deve conter pelo menos 1 número.</li>
    <li>Sua senha deve conter pelo menos 1 caractere especial.</li>
</ul>
<hr />
<?php echo form_open('profile/password/update'); ?>
<div class="form-group">
    <label for="curr_password">Senha atual</label>
    <?php echo form_password('old_password', '', 'class="form-control" id="old_password" required'); ?>
</div>

<div class="form-group">
    <label for="password">Sua nova senha</label>
    <?php echo form_password('password', '', 'class="form-control" id="password" minlength="6" maxlength="32" required'); ?>
</div>
<div class="form-group">
    <label for="pass_confirm">Repita sua nova senha</label>
    <?php echo form_password('confirm_password', '', 'class="form-control" id="confirm_password" required'); ?>
</div>
<button type="submit" class="btn btn-primary">Salvar</button>
<?php echo form_close(); ?>

<?php $this->endSection() ?>
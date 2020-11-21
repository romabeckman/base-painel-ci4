<?php $this->extend('template/painel') ?>

<?php $this->section('content') ?>

<?php echo $this->include('template/include/pager/password_requirement') ?>
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

<?php echo $this->include('template/include/btn/form_submit') ?>

<?php echo form_close(); ?>

<?php $this->endSection() ?>
<?php $this->extend('template/painel') ?>

<?php $this->section('content') ?>

<?php echo form_open('administrator/user/save', [], ['id' => $user->id ?? '']); ?>
<div class="form-group">
    <label for="name">Nome</label>
    <?php echo form_input('name', set_value('name', $user->name ?? ''), 'class="form-control" id="name" required'); ?>
</div>
<div class="form-group">
    <label for="id_auth_group">Grupo</label>
    <?php echo form_dropdown('id_auth_group', ['' => 'Selecione'] + $groups, set_value('id_auth_group', $user->id_auth_group ?? ''), 'class="form-control" id="id_auth_group" required'); ?>
</div>
<div class="form-group">
    <label for="email">E-mail</label>
    <?php echo form_input('email', set_value('email', $user->email ?? ''), 'class="form-control" id="name" required', 'email'); ?>
</div>
<?php
if (isset($user)) {
    echo customCheckbox('update_password', 'Atualizar a senha do usuário', 1, false, ['onclick' => '$(\'#password-box\').toggle();', 'id' => 'update_password']);
}
?>
<div class="form-group" id="password-box" style="<?php echo (isset($user) ? 'display: none;' : ''); ?>">
    <label for="password">Senha</label>
    <?php echo form_password('password', '', 'class="form-control" id="password" minlength="8"' . (isset($user) ? '' : 'required')); ?>
</div>

<?php echo $this->include('template/include/btn/form_submit') ?>
<?php echo form_close(); ?>

<?php $this->endSection() ?>
<?php $this->extend('template/painel') ?>

<?php $this->section('content') ?>

<?php echo form_open('administrator/configuration/save', []); ?>
<div class="my-4">
    <h5>E-mail</h5>
    <div class="form-group">
        <label for="EMAIL_FROM">From:</label>
        <?php echo form_input('config[EMAIL_FROM]', set_value('config[EMAIL_FROM]', $configuration['EMAIL_FROM']), 'class="form-control" id="EMAIL_FROM" placeholder="meu@email.com"', 'email'); ?>
    </div>
    <div class="form-group">
        <label for="EMAIL_FROM_NAME">Nome:</label>
        <?php echo form_input('config[EMAIL_FROM_NAME]', set_value('config[EMAIL_FROM_NAME]', $configuration['EMAIL_FROM_NAME']), 'class="form-control" id="EMAIL_FROM_NAME"'); ?>
    </div>
</div>
<?php
if ($recaptchav3) {
    ?>
    <div class="my-4">
        <h5>Segurança</h5>
        <div class="form-group">
            <label for="RECAPTCHA_V3_MINIMUM_SCORE">Google:</label>
            <?php echo form_dropdown('config[RECAPTCHA_V3_MINIMUM_SCORE]', $recatchaScore, set_value('config[RECAPTCHA_V3_MINIMUM_SCORE]', $configuration['RECAPTCHA_V3_MINIMUM_SCORE']), 'class="form-control" id="RECAPTCHA_V3_MINIMUM_SCORE"'); ?>
        </div>
    </div>
    <?php
}
?>
<?php echo $this->include('template/include/btn/form_submit') ?>
<?php echo form_close(); ?>


<?php $this->endSection() ?>
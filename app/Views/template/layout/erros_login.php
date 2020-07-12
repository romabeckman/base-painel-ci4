<?php
if (isset($message_erro)) {
    ?>
    <div class="alert alert-danger" role="alert"><?php echo $message_erro; ?></div>
    <?php
}

if (isset($validation)) {
    $errors = $validation->getErrors();
    ?>
    <div class="alert alert-danger" role="alert">
        <?php
        foreach ($errors as $error) {
            echo esc($error) . '<br>';
        }
        ?>
    </div>
    <?php
}
?>
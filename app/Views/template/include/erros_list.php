<?php
if (isset($alertMessage) && !empty($alertMessage)) {
    ?>
    <div class="alert alert-<?php echo $alertMessage['alert'] ?>" role="alert"><?php echo $alertMessage['text']; ?></div>
    <?php
}

if (isset($validation) && !empty($validation) && $errors = $validation->getErrors()) {
    ?>
    <div class="alert alert-danger" role="alert">
        <ul>
            <?php
            foreach ($errors as $error) {
                ?>
                <li><?php echo esc($error) ?></li>
                <?php
            }
            ?>
        </ul>
    </div>
    <?php
}
?>

<?php
if (isset($validation) && !empty($validation)) {
    $errors = $validation->getErrors();
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

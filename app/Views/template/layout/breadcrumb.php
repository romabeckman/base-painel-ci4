<nav aria-label="breadcrumb">
    <ol class="breadcrumb small">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
        <?php
        if (isset($breadcrumb) && !empty($breadcrumb)) {
            foreach ($breadcrumb as $link => $description) {
                echo '<li class="breadcrumb-item"><a href="' . (is_numeric($link) ? '#' : base_url($link)) . '">' . $description . '</a></li>';
            }
        }
        ?>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?? ''; ?></li>
    </ol>
</nav>

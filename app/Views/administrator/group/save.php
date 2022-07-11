<?php $this->extend('template/painel') ?>

<?php $this->section('content') ?>

<?php echo form_open('administrator/group/save', [], ['id' => $group->id ?? '']); ?>
<div class="mb-3">
    <label for="name">Nome</label>
    <?php echo form_input('name', set_value('name', $group->name ?? ''), 'class="form-control" id="name" required'); ?>
</div>

<div class="mb-3">
    <label>Permissões</label>
    <div class="row">
        <div class="col-sm-6 my-2">
            <ul class="list-group">
                <?php
                $group = '';
                foreach ($routes as $route) {
                    if ($route->group != $group) {
                        echo $group != '' ? '</div></ul>' : '';
                        echo $group != '' ? '<div class="col-sm-6 my-2"><ul class="list-group">' : '';
                        ?>
                        <li class="list-group-item list-group-item-dark">
                            <?php echo $route->group; ?>
                        </li>
                        <?php
                        $group = $route->group;
                    }
                    $id = 'permission_' . $route->id;
                    ?>
                    <li class="list-group-item">
                        <?php echo customCheckbox('permissions[]', $route->name, $route->id, $route->hasPermission == 1); ?>
                        <small><?php echo $route->controller; ?><?php echo $route->method ? '::<span class="text-danger">' . $route->method . '</span>' : ''; ?></small>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<?php echo $this->include('template/include/btn/form_submit') ?>
<?php echo form_close(); ?>

<?php $this->endSection() ?>
<?php $this->extend('template/painel') ?>

<?php $this->section('content') ?>
<div class="row mb-4">
    <?php
    if (hasPermission(App\Controllers\Administrator\Group::class, 'insert')) {
        ?>
        <div class="col-sm">
            <a href="/administrator/group/create" class="btn btn-primary">Novo usuário</a>
        </div>
        <?php
    }
    ?>
    <?php echo $this->include('template/include/form/search') ?>
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">&ensp;</th>
            </tr>
        </thead>
        <?php
        if (!empty($groups)) {
            $update = hasPermission(App\Controllers\Administrator\Group::class, 'update');
            ?>
            <tbody>
                <?php
                foreach ($groups as $group) {
                    ?>
                    <tr>
                        <th>
                            <?php
                            echo $update && $group->id != 1 ?
                                    '<a title="Alterar ' . $group->name . '" href="/administrator/group/update/' . $group->id . '">' . $group->name . '</a>' :
                                    $group->name;
                            ?>
                        </th>
                        <th><?php echo $group->id == 1 ? '' : formDelete(['id' => $group->id], 'administrator/group/delete', 'Remover'); ?></th>
                    </tr>
                </tbody>
                <?php
            }
        } else {
            ?>
            <tfoot><tr><td colspan="3" class="text-center">Nenhum registro encontrado</td></tr></tfoot>
            <?php
        }
        ?>
    </table>
</div>


<?php echo $pager->links() ?>

<?php $this->endSection() ?>
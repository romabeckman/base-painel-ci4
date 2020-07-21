<?php $this->extend('template/painel') ?>

<?php $this->section('content') ?>
<div class="row mb-4">
    <?php
    if ($permission['create']) {
        ?>
        <div class="col-sm">
            <a href="/administrator/group/create" class="btn btn-primary">Novo grupo</a>
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
            ?>
            <tbody>
                <?php
                foreach ($groups as $group) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            echo $permission['update'] && $group->id != 1 ?
                                    '<a title="Alterar ' . $group->name . '" href="/administrator/group/update/' . $group->id . '">' . $group->name . '</a>' :
                                    $group->name;
                            ?>
                        </td>
                        <td class="d-flex flex-row-reverse"><?php echo $group->id == 1 && $permission['delete'] ? '' : formDelete(['id' => $group->id], 'administrator/group/delete', 'Remover'); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <?php
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
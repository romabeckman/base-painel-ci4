<?php $this->extend('template/painel') ?>

<?php $this->section('content') ?>
<div class="row mb-4">
    <?php
    if ($permission['create']) {
        ?>
        <div class="col-sm">
            <a href="/administrator/user/create" class="btn btn-primary">Novo usuário</a>
        </div>
        <?php
    }
    ?>
    <?php echo $this->include('template/include/form/search') ?>
</div>
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Grupo</th>
                <th>&ensp;</th>
            </tr>
        </thead>
        <?php
        if (!empty($entities)) {
            ?>
            <tbody>
                <?php
                foreach ($entities as $user) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            echo $permission['update'] && $user->id != 1 ?
                                    '<a title="' . $user->name . '" href="/administrator/user/update/' . $user->id . '">' . $user->name . '</a>' :
                                    $user->name;
                            ?>
                        </td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->group; ?></td>
                        <td>
                            <div class="d-flex flex-row-reverse">
                                <?php echo $user->id == 1 && $permission['delete'] ? '' : formDelete(['id' => $user->id ?? ''], 'administrator/user/delete', 'Remover'); ?>
                            </div>
                        </td>
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
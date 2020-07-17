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
    <div class="col-sm">
        <form class="form-inline justify-content-end">
            <input value="<?php echo filter_input(INPUT_GET, 'search'); ?>" class="form-control mr-sm-2" type="text" placeholder="Search" name="search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <?php
        if (!empty($groups)) {
            ?>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">&ensp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($groups as $group) {
                    ?>
                    <tr>
                        <th>
                            <?php
                            echo (hasPermission(App\Controllers\Administrator\Group::class, 'update')&& $group->id != 1) ?
                                    '<a href="/administrator/group/update/' . $group->id . '">' . $group->name . '</a>' :
                                    $group->name;
                            ?>
                        </th>
                        <th><?php echo $group->id == 1 ? '' : formDelete(['id' => $group->id], 'administrator/group/delete', 'Remover'); ?></th>
                    </tr>
                </tbody>
                <?php
            }
        }
        ?>
    </table>
</div>


<?php echo $pager->links() ?>

<?php $this->endSection() ?>
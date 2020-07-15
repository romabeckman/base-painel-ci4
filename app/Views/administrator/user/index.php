<?php $this->extend('template/painel') ?>

<?php $this->section('content') ?>
<div class="row mb-4">
    <div class="col-sm">
        <a href="/administrator/user/create" class="btn btn-primary">Novo usuário</a>
    </div>
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
        if (!empty($users)) {
            ?>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Grupo</th>
                    <th scope="col">&ensp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $user) {
                    ?>
                    <tr>
                        <th><a href=""><?php echo $user->name; ?></a></th>
                        <th><?php echo $user->email; ?></th>
                        <th><?php echo $user->group; ?></th>
                        <th><?php echo formDelete(['id' => $user->id], 'administrator/user/delete', 'Remover'); ?></th>
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
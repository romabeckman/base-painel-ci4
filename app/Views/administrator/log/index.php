<?php $this->extend('template/painel') ?>

<?php $this->section('content') ?>
<form class="form-inline justify-content-end">
    <input value="<?php echo filter_input(INPUT_GET, 'search'); ?>" class="form-control mr-sm-2" type="text" placeholder="Search" name="search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
</form>

<div class="table-responsive mt-4">
    <table class="table table-striped">
        <?php
        if (!empty($logs)) {
            ?>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($logs as $log) {
                    ?>
                    <tr>
                        <th><?php echo $log->created_at->toLocalizedString('dd/MM/YYYY HH:mm:ss'); ?></th>
                        <th><?php echo $log->user; ?></th>
                        <th>
                            <pre><?php var_export($log->description); ?></pre>
                            <a href="javavascript:;" onclick="$(this).parent().find('.more-details').toggle();">Ver mais</a>
                            <div class="more-details p-3 bg-white rounded box-shadow" style="display: none;">
                                <h6>Post</h6>
                                <pre><?php var_export(json_decode($log->data, true)); ?></pre>
                            </div>
                        </th>
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
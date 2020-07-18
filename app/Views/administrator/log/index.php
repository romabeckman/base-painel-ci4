<?php $this->extend('template/painel') ?>

<?php $this->section('content') ?>

<?php echo $this->include('template/include/search') ?>

<div class="table-responsive mt-4">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Data</th>
                <th scope="col">Usuário</th>
                <th scope="col">Descrição</th>
            </tr>
        </thead>
        <?php
        if (!empty($logs)) {
            ?>
            <tbody>
                <?php
                foreach ($logs as $log) {
                    ?>
                    <tr>
                        <th>
                            <?php echo $log->created_at->toLocalizedString('dd/MM/YYYY'); ?><br />
                            <?php echo $log->created_at->toLocalizedString('HH:mm:ss'); ?>
                        </th>
                        <th><?php echo $log->user; ?></th>
                        <th>
                            <pre><?php varExport($log->description); ?></pre>
                            <a href="javavascript:;" onclick="$(this).parent().find('.more-details').toggle();">Ver mais</a>
                            <div class="more-details p-3 bg-white rounded box-shadow" style="display: none;">
                                <h6>Post</h6>
                                <pre><?php varExport(json_decode($log->data, true)); ?></pre>
                            </div>
                        </th>
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
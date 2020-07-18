<?php $pager->setSurroundCount(2) ?>

<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm">
            <?php if ($pager->hasPrevious()) : ?>
                <li class="page-item">
                    <a href="<?php echo $pager->getFirst() ?>" class="page-link" aria-label="<?php echo lang('Pager.first') ?>">
                        <span aria-hidden="true"><?php echo lang('Pager.first') ?></span>
                    </a>
                </li>
                <li class="page-item">
                    <a href="<?php echo $pager->getPrevious() ?>" class="page-link" aria-label="<?php echo lang('Pager.previous') ?>">
                        <span aria-hidden="true"><?php echo lang('Pager.previous') ?></span>
                    </a>
                </li>
            <?php endif ?>

            <?php foreach ($pager->links() as $link) : ?>
                <li class="page-item <?php echo $link['active'] ? 'active' : '' ?>">
                    <a href="<?php echo $link['uri'] ?>" class="page-link  <?php echo $link['active'] ? 'active' : '' ?>">
                        <?php echo $link['title'] ?> <?php echo $link['active'] ? '<span class="sr-only">(current)</span>' : '' ?>
                    </a>
                </li>
            <?php endforeach ?>

            <?php if ($pager->hasNext()) : ?>
                <li class="page-item">
                    <a href="<?php echo $pager->getNext() ?>" class="page-link" aria-label="<?php echo lang('Pager.next') ?>">
                        <span aria-hidden="true"><?php echo lang('Pager.next') ?></span>
                    </a>
                </li>
                <li class="page-item">
                    <a href="<?php echo $pager->getLast() ?>" class="page-link" aria-label="<?php echo lang('Pager.last') ?>">
                        <span aria-hidden="true"><?php echo lang('Pager.last') ?></span>
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </nav>
</div>
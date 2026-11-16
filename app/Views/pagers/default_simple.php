<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(0);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination justify-content-center justify-content-md-end mb-0">
        <?php if ($pager->hasPrevious()): ?>
            <li class="page-item">
                <a class="page-link" href="<?= esc($pager->getPrevious()) ?>" aria-label="<?= lang('Pager.previous') ?>">
                    &laquo; Previous
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link" aria-disabled="true">&laquo; Previous</span>
            </li>
        <?php endif; ?>

        <?php if ($pager->hasNext()): ?>
            <li class="page-item">
                <a class="page-link" href="<?= esc($pager->getNext()) ?>" aria-label="<?= lang('Pager.next') ?>">
                    Next &raquo;
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link" aria-disabled="true">Next &raquo;</span>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<?php if ($pager->getPageCount() > 0): ?>
<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination justify-content-center justify-content-md-end mb-0">
        <?php if ($pager->getPageCount() > 1): ?>
            <?php if ($pager->hasPreviousPage()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= esc($pager->getPreviousPage()) ?>" aria-label="<?= lang('Pager.previous') ?>">
                        &laquo; Previous
                    </a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link" aria-disabled="true">&laquo; Previous</span>
                </li>
            <?php endif; ?>
        <?php endif; ?>

        <?php foreach ($pager->links() as $link): ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <?php if ($link['active']): ?>
                    <span class="page-link" aria-current="page"><?= esc($link['title']) ?></span>
                <?php else: ?>
                    <a class="page-link" href="<?= esc($link['uri']) ?>"><?= esc($link['title']) ?></a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>

        <?php if ($pager->getPageCount() > 1): ?>
            <?php if ($pager->hasNextPage()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= esc($pager->getNextPage()) ?>" aria-label="<?= lang('Pager.next') ?>">
                        Next &raquo;
                    </a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link" aria-disabled="true">Next &raquo;</span>
                </li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
</nav>
<?php endif; ?>

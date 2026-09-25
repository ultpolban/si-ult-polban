<div class="ult-page-header mb-3">
    <?php if (! empty($breadcrumb)) : ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0 text-muted" style="font-size: 0.85rem;">
                <?php foreach ($breadcrumb as $index => $item) : ?>
                    <?php if ($index === array_key_last($breadcrumb)) : ?>
                        <li class="breadcrumb-item active text-primary fw-medium" aria-current="page">
                            <?= esc($item) ?>
                        </li>
                    <?php else : ?>
                        <li class="breadcrumb-item">
                            <?= esc($item) ?>
                        </li>
                    <?php endif ?>
                <?php endforeach ?>
            </ol>
        </nav>
    <?php endif ?>
</div>

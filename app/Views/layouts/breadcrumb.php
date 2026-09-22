<div class="ult-page-header">

    <h1>

        <?= esc($pageTitle ?? $title ?? '') ?>

    </h1>

    <?php if (! empty($breadcrumb)) : ?>

        <ol class="ult-breadcrumb">

            <?php foreach ($breadcrumb as $index => $item) : ?>

                <?php if ($index === array_key_last($breadcrumb)) : ?>

                    <li class="active">

                        <?= esc($item) ?>

                    </li>

                <?php else : ?>

                    <li>

                        <?= esc($item) ?>

                    </li>

                <?php endif ?>

            <?php endforeach ?>

        </ol>

    <?php endif ?>

</div>
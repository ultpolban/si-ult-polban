<?php if (session()->getFlashdata('success')) : ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">

        <i class="fas fa-check-circle me-2"></i>

        <?= esc(session()->getFlashdata('success')) ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

<?php endif ?>

<?php if (session()->getFlashdata('error')) : ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <i class="fas fa-exclamation-circle me-2"></i>

        <?= esc(session()->getFlashdata('error')) ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

<?php endif ?>

<?php if (! empty(session()->getFlashdata('errors'))) : ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <strong><i class="fas fa-exclamation-triangle me-2"></i>Terjadi kesalahan:</strong>

        <ul class="mb-0 mt-2">

            <?php foreach (session()->getFlashdata('errors') as $error) : ?>

                <li><?= esc(is_array($error) ? implode(', ', $error) : $error) ?></li>

            <?php endforeach ?>

        </ul>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

<?php endif ?>
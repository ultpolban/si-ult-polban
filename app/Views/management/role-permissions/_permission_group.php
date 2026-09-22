<?php foreach ($modules as $module => $permissions) : ?>

    <div class="card card-outline card-primary mb-3">

        <div class="card-header">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">

                    <?= esc(ucwords(str_replace('_', ' ', $module))) ?>

                </h5>

                <div class="custom-control custom-checkbox">

                    <input
                        type="checkbox"
                        class="custom-control-input module-check"
                        id="module-<?= md5($module) ?>">

                    <label
                        class="custom-control-label"
                        for="module-<?= md5($module) ?>">

                        Pilih Semua

                    </label>

                </div>

            </div>

        </div>

        <div class="card-body">

            <div class="row">

                <?php foreach ($permissions as $permission) : ?>

                    <div class="col-lg-4 col-md-6 mb-2">

                        <div class="custom-control custom-checkbox">

                            <input
                                type="checkbox"
                                class="custom-control-input permission-item permission-module-<?= md5($module) ?>"
                                id="permission<?= $permission['id'] ?>"
                                name="permissions[]"
                                value="<?= $permission['id'] ?>"
                                <?= in_array($permission['id'], $selected) ? 'checked' : '' ?>>

                            <label
                                class="custom-control-label"
                                for="permission<?= $permission['id'] ?>">

                                <?= esc($permission['name']) ?>

                            </label>

                        </div>

                        <small class="text-muted d-block">

                            <?= esc($permission['code']) ?>

                        </small>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

<?php endforeach; ?>
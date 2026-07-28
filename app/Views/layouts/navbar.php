<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Sidebar Toggle -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars" style="color: #6b7280;"></i>
            </a>
        </li>
    </ul>

    <!-- Right: Profile -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-flex align-items-center">
            <div class="profile-pill">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('name') ?? 'User') ?>&background=F58220&color=fff&size=64"
                     alt="Avatar">
                <span>
                    <?= esc(session()->get('name') ?? 'Guest') ?>
                    <small>
                        <?= (session()->get('role_id') == 1) ? 'Admin ULT' : ((session()->get('role_id') == 5) ? 'Pimpinan' : 'User') ?>
                    </small>
                </span>
            </div>
        </li>
    </ul>

</nav>

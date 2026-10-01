<style>
    /* =========================================
       TOPBAR
    ========================================== */
    .main-header.ult-topbar {
        background: #fff !important;
        border: 0 !important;
        border-bottom: 1px solid var(--ult-border);
        box-shadow: 0 1px 3px rgba(16, 24, 40, .04);
        min-height: 66px;
        padding: 0 14px;
    }

    .ult-topbar .navbar-nav { align-items: center; }

    /* Ikon bulat */
    .ult-topbar .ult-icon-btn {
        position: relative;
        width: 40px;
        height: 40px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        color: #5b6478 !important;
        background: #f3f5fa;
        transition: background .18s, color .18s;
    }

    .ult-topbar .ult-icon-btn:hover { background: #e7ebf7; color: var(--ult-navy) !important; }
    .ult-topbar .ult-icon-btn i { font-size: 1.05rem; }

    .ult-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        min-width: 19px;
        height: 19px;
        padding: 0 5px;
        border-radius: 20px;
        background: var(--ult-danger);
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #fff;
    }

    /* Breadcrumb */
    .ult-topbar-crumb .nav-link { color: #98a0b3; padding: .4rem .7rem !important; }
    .ult-topbar-crumb .nav-link:hover { color: var(--ult-navy); }
    .ult-crumb-text { color: var(--ult-navy) !important; font-weight: 700; font-size: .92rem; }

    /* Pencarian */
    .ult-search {
        position: relative;
        display: flex;
        align-items: center;
        background: #f3f5fa;
        border-radius: 30px;
        padding: 0 14px;
        height: 40px;
        margin-right: 8px;
    }

    .ult-search i { color: #98a0b3; font-size: .85rem; }

    .ult-search-input {
        border: 0;
        background: transparent;
        outline: none;
        padding: 0 8px;
        width: 210px;
        font-size: .88rem;
        color: var(--ult-text);
    }

    .ult-search-input::placeholder { color: #a7aebe; }

    /* Tombol akun */
    .ult-user-btn {
        display: flex !important;
        align-items: center;
        gap: 10px;
        padding: 5px 10px 5px 5px !important;
        border-radius: 30px;
        background: #f3f5fa;
        color: var(--ult-text) !important;
        transition: background .18s;
    }

    .ult-user-btn:hover { background: #e7ebf7; }

    .ult-avatar-sm {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--ult-navy), var(--ult-navy-light));
        color: #fff;
        font-size: 12px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .ult-user-meta { flex-direction: column; line-height: 1.2; text-align: left; }
    .ult-user-meta strong { font-size: .86rem; color: var(--ult-navy); font-weight: 700; }
    .ult-user-meta small { font-size: .7rem; color: #98a0b3; }
    .ult-chevron { font-size: .65rem; color: #98a0b3; margin-left: 2px; }

    /* Dropdown */
    .ult-dropdown {
        border: 0;
        border-radius: 16px;
        padding: 0;
        box-shadow: 0 18px 40px rgba(16, 24, 40, .12);
        overflow: hidden;
        margin-top: 6px !important;
    }

    .ult-dropdown-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 16px;
        border-bottom: 1px solid var(--ult-border);
    }

    .ult-dropdown-head strong { color: var(--ult-navy); font-size: .92rem; }
    .ult-dropdown-head a { font-size: .8rem; color: var(--ult-navy-light); font-weight: 600; }

    .ult-dropdown-body { max-height: 340px; overflow-y: auto; }

    .ult-notif-menu { width: 330px; }
    .ult-user-menu { width: 250px; }

    .ult-notif-item {
        display: flex;
        gap: 10px;
        padding: 12px 16px;
        border-bottom: 1px solid #f1f3f9;
        color: var(--ult-text);
        text-decoration: none;
        transition: background .15s;
    }

    .ult-notif-item:hover { background: #f7f9ff; color: var(--ult-text); }
    .ult-notif-item.unread { background: #f7f9ff; }

    .ult-notif-dot {
        width: 8px; height: 8px; border-radius: 50%;
        background: transparent; margin-top: 6px; flex-shrink: 0;
    }

    .ult-notif-item.unread .ult-notif-dot { background: var(--ult-orange); }

    .ult-notif-body { display: flex; flex-direction: column; min-width: 0; }
    .ult-notif-body strong { font-size: .86rem; color: var(--ult-navy); }
    .ult-notif-body small { font-size: .8rem; color: var(--ult-muted); overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
    .ult-notif-body em { font-size: .72rem; color: #a7aebe; font-style: normal; margin-top: 2px; }

    .ult-empty { text-align: center; padding: 30px 16px; color: #a7aebe; }
    .ult-empty i { font-size: 1.6rem; display: block; margin-bottom: 8px; }
    .ult-empty span { font-size: .85rem; }

    .ult-user-card { display: flex; align-items: center; gap: 11px; padding: 16px; }
    .ult-user-card .ult-avatar { width: 42px; height: 42px; border-radius: 13px; }
    .ult-user-card strong { display: block; font-size: .9rem; color: var(--ult-navy); }
    .ult-user-card small { font-size: .76rem; color: var(--ult-muted); }

    .ult-dropdown-divider { height: 1px; background: var(--ult-border); }

    .ult-menu-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        font-size: .88rem;
        color: var(--ult-text);
        text-decoration: none;
        transition: background .15s, color .15s;
    }

    .ult-menu-link i { width: 16px; color: #98a0b3; }
    .ult-menu-link:hover { background: #f7f9ff; color: var(--ult-navy); }
    .ult-menu-link:hover i { color: var(--ult-navy); }
    .ult-menu-link.ult-menu-danger { color: var(--ult-danger); }
    .ult-menu-link.ult-menu-danger i { color: var(--ult-danger); }
    .ult-menu-link.ult-menu-danger:hover { background: #fef2f2; color: #b91c1c; }

    @media (max-width: 767.98px) {
        .ult-search-input { width: 120px; }
    }
</style>

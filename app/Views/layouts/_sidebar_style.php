<?php
/**
 * Gaya sidebar terpusat — dipakai oleh seluruh dashboard & jenis pemohon
 * agar tema, warna, dan logo seragam.
 */
?>
<style>
    /* =========================================
       BRAND
    ========================================== */
    .main-sidebar { background: #232b6b !important; }
    .main-sidebar .sidebar { background: #232b6b !important; }

    .main-sidebar .brand-link {
        display: flex !important;
        align-items: center !important;
        gap: 11px;
        height: 66px !important;
        min-height: 66px !important;
        padding: 0 16px !important;
        background: #1b2159 !important;
        border-bottom: 1px solid rgba(255, 255, 255, .08) !important;
        border-radius: 0 !important;
    }

    .main-sidebar .brand-link:hover { background: #1b2159 !important; }

    .ult-brand-logo {
        width: 38px;
        height: 38px;
        object-fit: contain;
        /* Logo sudah background transparan -> tanpa kotak putih */
        flex-shrink: 0;
    }

    .ult-brand-text {
        color: #fff !important;
        font-size: 15px;
        font-weight: 600;
        letter-spacing: .3px;
        line-height: 1.15;
        display: flex;
        flex-direction: column;
    }

    .ult-brand-text strong { color: var(--ult-orange); font-weight: 800; }
    .ult-brand-text small { font-size: 9.5px; font-weight: 500; opacity: .6; letter-spacing: .4px; text-transform: uppercase; }

    /* =========================================
       USER PANEL
    ========================================== */
    .main-sidebar .user-panel {
        display: flex !important;
        align-items: center;
        gap: 11px;
        padding: 14px 14px !important;
        margin: 0 0 6px !important;
        border-bottom: 1px solid rgba(255, 255, 255, .07) !important;
    }

    .main-sidebar .user-panel .image { margin: 0 !important; float: none !important; flex-shrink: 0; }

    .ult-avatar {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--ult-orange), var(--ult-orange-light));
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 800;
        object-fit: cover;
        box-shadow: 0 3px 10px rgba(0, 0, 0, .2);
    }

    .main-sidebar .user-panel .info { padding: 0 !important; min-width: 0; flex: 1; }

    .ult-user-name {
        display: block;
        color: #fff !important;
        font-size: 13.5px;
        font-weight: 700 !important;
        text-decoration: none;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .ult-user-role {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 2px;
        color: rgba(255, 255, 255, .55) !important;
        font-size: 10.5px;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .ult-user-role i { color: var(--ult-orange); font-size: 10px; }

    /* =========================================
       MENU
    ========================================== */
    .main-sidebar .nav-sidebar > .nav-item { margin-bottom: 2px; }

    .main-sidebar .nav-header {
        font-size: 9.5px;
        font-weight: 800;
        letter-spacing: 1.1px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, .38) !important;
        padding: 14px 14px 6px !important;
        margin: 0;
    }

    .main-sidebar .nav-sidebar .nav-link {
        position: relative;
        display: flex;
        align-items: center;
        border-radius: 10px !important;
        margin: 0 10px;
        padding: 10px 12px !important;
        color: rgba(255, 255, 255, .78) !important;
        font-size: 13.5px;
        font-weight: 500;
        transition: background .18s, color .18s, padding .18s;
    }

    .main-sidebar .nav-sidebar .nav-link:hover {
        background: rgba(255, 255, 255, .07) !important;
        color: #fff !important;
    }

    .main-sidebar .nav-sidebar .nav-link.active {
        background: linear-gradient(90deg, var(--ult-orange), var(--ult-orange-light)) !important;
        color: #fff !important;
        font-weight: 700;
        box-shadow: 0 5px 14px rgba(255, 139, 0, .3);
    }

    .main-sidebar .nav-sidebar .nav-icon {
        width: 20px;
        margin-right: 10px;
        text-align: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .main-sidebar .nav-sidebar .nav-link p {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0;
    }

    .ult-menu-active-dot {
        position: absolute;
        right: 10px;
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #fff;
    }

    .main-sidebar .nav-link.ult-logout { color: #ffb4b4 !important; }
    .main-sidebar .nav-link.ult-logout:hover { background: rgba(220, 38, 38, .18) !important; color: #fff !important; }
    .main-sidebar .nav-link.ult-logout .nav-icon { color: #ff8f8f; }

    /* =========================================
       FOOTER SIDEBAR
    ========================================== */
    .ult-sidebar-foot {
        margin: 18px 10px 10px;
        padding: 14px;
        border-radius: 14px;
        background: rgba(255, 255, 255, .05);
        border: 1px solid rgba(255, 255, 255, .07);
    }

    .ult-sidebar-foot-title {
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .ult-sidebar-foot-title i { color: var(--ult-orange); margin-right: 5px; }

    .ult-sidebar-foot p {
        color: rgba(255, 255, 255, .5);
        font-size: 10.5px;
        line-height: 1.5;
        margin: 0 0 8px;
    }

    .ult-sidebar-foot a {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, .1);
        color: #fff;
        border-radius: 20px;
        padding: 5px 12px;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
    }

    .ult-sidebar-foot a:hover { background: var(--ult-orange); color: #fff; }

    /* =========================================
       SIDEBAR COLLAPSED
    ========================================== */
    body.sidebar-collapse .main-sidebar:not(:hover) .ult-brand-text,
    body.sidebar-collapse .main-sidebar:not(:hover) .ult-user-panel .info,
    body.sidebar-collapse .main-sidebar:not(:hover) .nav-header,
    body.sidebar-collapse .main-sidebar:not(:hover) .ult-sidebar-foot {
        display: none !important;
    }

    body.sidebar-collapse .main-sidebar:not(:hover) .brand-link { justify-content: center; padding: 0 !important; }
    body.sidebar-collapse .main-sidebar:not(:hover) .user-panel { justify-content: center; padding: 12px 0 !important; }
    body.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-link { justify-content: center; padding: 11px 0 !important; }
    body.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-icon { margin-right: 0 !important; width: 100% !important; }
    body.sidebar-collapse .main-sidebar:not(:hover) .ult-menu-active-dot { display: none; }
</style>

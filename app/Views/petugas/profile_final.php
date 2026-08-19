<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    /* =========================================================
       PROFILE PETUGAS ULT POLBAN - OFFICIAL DASHBOARD THEME (DEWA EDITION V3.2 FIXED)
       ========================================================= */

    :root {
        /* Palette Resmi Dashboard ULT POLBAN */
        --ult-navy-deep: #0f172a;       /* Dark Slate / Slate 900 */
        --ult-navy-card: #1e293b;       /* Slate 800 */
        --ult-primary: #1e40af;         /* POLBAN Blue / Blue 800 */
        --ult-primary-light: #2563eb;   /* Vivid Blue / Blue 600 */
        --ult-accent-blue: #0284c7;     /* Ocean Cyan / Sky 600 */
        --ult-cyan: #06b6d4;            /* Cyan 500 */
        --ult-amber: #d97706;           /* Amber / Gold POLBAN */
        --ult-amber-glow: rgba(217, 119, 6, 0.25);
        --ult-green: #059669;           /* Emerald 600 */
        --ult-green-glow: rgba(5, 150, 105, 0.25);
        --ult-bg: #f8fafc;              /* Slate 50 Neutral BG */
        --ult-card-bg: #ffffff;
        --ult-text-dark: #0f172a;
        --ult-text-muted: #64748b;
        --ult-border: #e2e8f0;
        --ult-border-hover: #cbd5e1;
        
        /* Glassmorphism Ultra & Shadow Tokens */
        --ult-glass-bg: rgba(255, 255, 255, 0.78);
        --ult-glass-border: rgba(255, 255, 255, 0.6);
        --ult-shadow-xl: 0 25px 50px -12px rgba(15, 23, 42, 0.08), 0 10px 20px -8px rgba(15, 23, 42, 0.04);
        --ult-shadow-glow: 0 12px 36px rgba(30, 64, 175, 0.18);
        --ult-shadow-amber: 0 10px 25px rgba(217, 119, 6, 0.2);
        
        /* Character Branding Variable (Default) */
        --theme-char-bg: linear-gradient(135deg, #3b82f6, #1e40af);
        --theme-badge-bg: #eff6ff;
        --theme-badge-text: #1d4ed8;
    }

    /* --- PILIHAN TEMA FILM & KARAKTER VISUAL --- */
    body.theme-spiderman {
        --ult-navy-deep: #1a0505;
        --ult-primary: #dc2626;
        --ult-primary-light: #ef4444;
        --ult-cyan: #3b82f6;
        --ult-amber: #f59e0b;
        --ult-bg: #fff1f2;
        --ult-glass-bg: rgba(255, 241, 242, 0.88);
        --ult-shadow-xl: 0 25px 50px -12px rgba(220, 38, 38, 0.2);
        --theme-char-bg: linear-gradient(135deg, #dc2626, #991b1b);
        --theme-badge-bg: #fee2e2;
        --theme-badge-text: #b91c1c;
    }

    body.theme-mcqueen {
        --ult-navy-deep: #450a0a;
        --ult-primary: #b91c1c;
        --ult-primary-light: #e11d48;
        --ult-cyan: #facc15;
        --ult-amber: #ea580c;
        --ult-bg: #fff1f2;
        --ult-glass-bg: rgba(255, 242, 242, 0.9);
        --ult-shadow-xl: 0 25px 50px -12px rgba(185, 28, 28, 0.22);
        --theme-char-bg: linear-gradient(135deg, #ea580c, #b91c1c);
        --theme-badge-bg: #ffedd5;
        --theme-badge-text: #c2410c;
    }

    body.theme-up {
        --ult-navy-deep: #0c4a6e;
        --ult-primary: #0284c7;
        --ult-primary-light: #38bdf8;
        --ult-cyan: #34d399;
        --ult-amber: #fbbf24;
        --ult-bg: #f0f9ff;
        --ult-glass-bg: rgba(240, 249, 255, 0.88);
        --ult-shadow-xl: 0 25px 50px -12px rgba(2, 132, 199, 0.18);
        --theme-char-bg: linear-gradient(135deg, #0284c7, #0369a1);
        --theme-badge-bg: #e0f2fe;
        --theme-badge-text: #0369a1;
    }

    body.theme-monster {
        --ult-navy-deep: #064e3b;
        --ult-primary: #0d9488;
        --ult-primary-light: #14b8a6;
        --ult-cyan: #84cc16;
        --ult-amber: #10b981;
        --ult-bg: #f0fdf4;
        --ult-glass-bg: rgba(240, 253, 244, 0.88);
        --ult-shadow-xl: 0 25px 50px -12px rgba(13, 148, 136, 0.18);
        --theme-char-bg: linear-gradient(135deg, #10b981, #047857);
        --theme-badge-bg: #d1fae5;
        --theme-badge-text: #047857;
    }

    body.theme-elemental {
        --ult-navy-deep: #431407;
        --ult-primary: #c2410c;
        --ult-primary-light: #f97316;
        --ult-cyan: #0284c7;
        --ult-amber: #fb923c;
        --ult-bg: #fff7ed;
        --ult-glass-bg: rgba(255, 247, 237, 0.9);
        --ult-shadow-xl: 0 25px 50px -12px rgba(194, 65, 12, 0.2);
        --theme-char-bg: linear-gradient(135deg, #f97316, #c2410c);
        --theme-badge-bg: #ffedd5;
        --theme-badge-text: #c2410c;
    }

    .petugas-profile {
        padding: 32px 36px 64px;
        background: var(--ult-bg);
        min-height: calc(100vh - 70px);
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        position: relative;
        overflow-x: hidden;
        transition: background 0.5s ease;
    }

    /* BACKGROUND GLOW DECORATIVE ELEMENTS */
    .petugas-profile::before,
    .petugas-profile::after {
        content: '';
        position: absolute;
        width: 380px;
        height: 380px;
        border-radius: 50%;
        filter: blur(90px);
        pointer-events: none;
        z-index: 0;
        opacity: 0.45;
        transition: background 0.5s ease;
    }

    .petugas-profile::before {
        top: -80px;
        left: -80px;
        background: radial-gradient(circle, var(--ult-primary-light) 0%, rgba(255,255,255,0) 70%);
    }

    .petugas-profile::after {
        bottom: 40px;
        right: -60px;
        background: radial-gradient(circle, var(--ult-cyan) 0%, rgba(255,255,255,0) 70%);
    }

    .profile-page-header,
    .profile-main-card {
        position: relative;
        z-index: 1;
    }

    /* HEADER PAGE WITH ELEGANT ACCENT */
    .profile-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 32px;
    }

    .profile-title-wrap {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .profile-title-icon-wrapper {
        position: relative;
    }

    .profile-title-icon {
        width: 68px;
        height: 68px;
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--ult-navy-deep) 0%, var(--ult-primary) 100%);
        color: #ffffff;
        font-size: 28px;
        box-shadow: 0 14px 30px rgba(30, 64, 175, 0.28);
        transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        z-index: 2;
    }

    .profile-title-icon-wrapper::before {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: 26px;
        background: linear-gradient(135deg, var(--ult-cyan), var(--ult-amber));
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 1;
        filter: blur(10px);
    }

    .profile-title-icon-wrapper:hover::before {
        opacity: 0.8;
    }

    .profile-title-icon-wrapper:hover .profile-title-icon {
        transform: scale(1.08) rotate(-5deg);
    }

    .profile-title-wrap h1 {
        margin: 0;
        color: var(--ult-navy-deep);
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -0.8px;
        background: linear-gradient(135deg, var(--ult-navy-deep) 0%, var(--ult-primary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: all 0.4s ease;
    }

    .profile-title-wrap p {
        margin: 4px 0 0;
        color: var(--ult-text-muted);
        font-size: 14px;
        font-weight: 500;
    }

    /* THEME CHARACTER BADGE HEADER */
    .theme-character-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        border-radius: 20px;
        background: var(--theme-badge-bg);
        color: var(--theme-badge-text);
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        transition: all 0.4s ease;
    }

    /* BUTTON ACTION PROFESSIONAL WITH RIPPLE */
    .profile-edit-main-btn {
        border: 0;
        padding: 14px 28px;
        border-radius: 16px;
        background: linear-gradient(135deg, var(--ult-primary-light) 0%, var(--ult-primary) 100%);
        color: #ffffff;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 0.2px;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 12px 25px rgba(37, 99, 235, 0.32);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .profile-edit-main-btn::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(60deg, transparent, rgba(255,255,255,0.3), transparent);
        transform: rotate(30deg) translateY(-100%);
        transition: transform 0.8s ease;
    }

    .profile-edit-main-btn:hover::after {
        transform: rotate(30deg) translateY(100%);
    }

    .profile-edit-main-btn:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 18px 36px rgba(30, 64, 175, 0.42);
        color: #ffffff;
    }

    .profile-edit-main-btn:active {
        transform: translateY(-1px) scale(0.98);
    }

    /* MAIN CARD GLASSMORPHISM & TILT TARGET */
    .profile-main-card {
        background: var(--ult-glass-bg);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 28px;
        border: 1px solid var(--ult-glass-border);
        overflow: hidden;
        box-shadow: var(--ult-shadow-xl);
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.15s ease-out, box-shadow 0.4s ease, background 0.5s ease;
    }

    .profile-main-card:hover {
        box-shadow: 0 35px 70px -15px rgba(15, 23, 42, 0.12), var(--ult-shadow-glow);
    }

    .profile-card-header {
        background: linear-gradient(135deg, var(--ult-navy-deep) 0%, #1e293b 60%, var(--ult-primary) 100%);
        padding: 30px 42px;
        color: #ffffff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
        transition: background 0.5s ease;
    }

    .profile-card-header-bg-glow {
        position: absolute;
        top: -80px;
        right: -40px;
        width: 280px;
        height: 280px;
        background: radial-gradient(circle, rgba(6, 182, 212, 0.35) 0%, rgba(0,0,0,0) 70%);
        border-radius: 50%;
        pointer-events: none;
        animation: pulseHeaderGlow 6s infinite alternate ease-in-out;
    }

    @keyframes pulseHeaderGlow {
        0% { transform: scale(1) translate(0, 0); opacity: 0.6; }
        100% { transform: scale(1.3) translate(-20px, 20px); opacity: 0.95; }
    }

    .profile-card-header h3 {
        margin: 0;
        font-size: 22px;
        font-weight: 800;
        letter-spacing: -0.4px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .profile-card-header small {
        opacity: 0.88;
        font-size: 13px;
        display: block;
        margin-top: 5px;
        font-weight: 400;
    }

    .profile-card-body {
        padding: 42px;
    }

    /* PROFILE TOP LAYOUT */
    .profile-top {
        display: grid;
        grid-template-columns: 340px 1fr;
        gap: 42px;
        align-items: stretch;
    }

    /* PHOTO SECTION WITH THEME CHARACTER ART CARD */
    .profile-photo-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 28px 24px 36px;
        border-right: 1px dashed var(--ult-border);
        position: relative;
        background: linear-gradient(180deg, rgba(248, 250, 252, 0.85) 0%, rgba(255,255,255,0.4) 100%);
        border-radius: 24px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        overflow: hidden;
    }

    /* THEME CHARACTER DECORATIVE BANNER/AVATAR ACCENT */
    .theme-char-banner {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 85px;
        background: var(--theme-char-bg);
        opacity: 0.12;
        border-radius: 24px 24px 0 0;
        z-index: 0;
        transition: background 0.5s ease;
    }

    .profile-photo-wrapper {
        position: relative;
        width: 176px;
        height: 176px;
        margin-bottom: 24px;
        z-index: 2;
    }

    .profile-photo-ring {
        position: absolute;
        inset: -6px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--ult-primary-light), var(--ult-cyan), var(--ult-amber));
        background-size: 200% 200%;
        animation: rotateGradient 5s linear infinite;
        opacity: 0.95;
        box-shadow: 0 12px 28px rgba(30, 64, 175, 0.25);
    }

    @keyframes rotateGradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .profile-photo {
        width: 176px;
        height: 176px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #ffffff;
        position: relative;
        z-index: 2;
        background: #ffffff;
        transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .profile-photo:hover {
        transform: scale(1.04);
    }

    .profile-photo-empty {
        width: 176px;
        height: 176px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        color: var(--ult-primary);
        font-size: 70px;
        border: 4px solid #ffffff;
        position: relative;
        z-index: 2;
        box-shadow: inset 0 4px 10px rgba(0,0,0,0.05);
    }

    .photo-upload-button {
        position: absolute;
        right: 4px;
        bottom: 6px;
        width: 46px;
        height: 46px;
        border-radius: 50%;
        border: 3.5px solid #ffffff;
        background: linear-gradient(135deg, var(--ult-primary-light), var(--ult-primary));
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 3;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.22);
    }

    .photo-upload-button:hover {
        transform: scale(1.15) rotate(12deg);
        background: linear-gradient(135deg, var(--ult-amber), #b45309);
        box-shadow: var(--ult-shadow-amber);
    }

    .photo-upload-input {
        display: none;
    }

    .profile-name {
        margin: 0;
        color: var(--ult-navy-deep);
        font-size: 23px;
        font-weight: 800;
        text-align: center;
        letter-spacing: -0.5px;
        word-break: break-word;
        transition: all 0.3s ease;
        z-index: 2;
    }

    .profile-role {
        margin-top: 6px;
        color: var(--ult-text-muted);
        font-size: 13.5px;
        font-weight: 600;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        z-index: 2;
    }

    .profile-status {
        margin-top: 18px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
        border-radius: 30px;
        padding: 7px 18px;
        font-size: 12.5px;
        font-weight: 700;
        box-shadow: 0 4px 14px var(--ult-green-glow);
        z-index: 2;
    }

    .status-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: var(--ult-green);
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.2);
        animation: pulseLiveStatus 2s infinite;
    }

    @keyframes pulseLiveStatus {
        0% { box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.5); }
        70% { box-shadow: 0 0 0 9px rgba(5, 150, 105, 0); }
        100% { box-shadow: 0 0 0 0 rgba(5, 150, 105, 0); }
    }

    .photo-help {
        margin-top: 14px;
        color: #94a3b8;
        font-size: 12px;
        text-align: center;
        font-weight: 500;
        z-index: 2;
    }

    /* THEME CHARACTER VISUAL ILLUSTRATION CARD */
    .theme-char-preview {
        margin-top: 18px;
        width: 100%;
        padding: 10px 14px;
        background: rgba(255,255,255,0.7);
        border-radius: 14px;
        border: 1px solid var(--ult-border);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 12.5px;
        font-weight: 700;
        color: var(--ult-navy-deep);
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        z-index: 2;
    }

    .theme-char-preview i {
        font-size: 16px;
        color: var(--ult-primary-light);
    }

    /* DATA SECTION */
    .profile-data-section {
        padding: 4px 0;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
    }

    .section-heading-icon {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: #eff6ff;
        color: var(--ult-primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.1);
        transition: background 0.5s ease, color 0.5s ease;
    }

    .section-heading h4 {
        margin: 0;
        color: var(--ult-navy-deep);
        font-size: 20px;
        font-weight: 800;
        letter-spacing: -0.4px;
    }

    .data-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .data-item {
        padding: 20px 24px;
        border: 1px solid var(--ult-border);
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(8px);
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        cursor: pointer;
        overflow: hidden;
    }

    .data-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(6, 182, 212, 0.05) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .data-item:hover {
        border-color: #93c5fd;
        background: #ffffff;
        transform: translateY(-4px) scale(1.01);
        box-shadow: 0 16px 32px rgba(30, 64, 175, 0.1);
    }

    .data-item:hover::before {
        opacity: 1;
    }

    .data-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: var(--ult-text-muted);
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 8px;
        position: relative;
        z-index: 2;
    }

    .data-label-left {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .data-label i {
        color: var(--ult-primary-light);
        font-size: 14px;
        transition: color 0.5s ease;
    }

    .data-copy-badge {
        font-size: 11px;
        padding: 3px 9px;
        border-radius: 7px;
        background: #eff6ff;
        color: var(--ult-primary-light);
        font-weight: 600;
        opacity: 0;
        transform: translateX(8px);
        transition: all 0.3s ease;
        text-transform: none;
    }

    .data-item:hover .data-copy-badge {
        opacity: 1;
        transform: translateX(0);
    }

    .data-value {
        color: var(--ult-text-dark);
        font-size: 16px;
        font-weight: 700;
        word-break: break-word;
        position: relative;
        z-index: 2;
    }

    /* DIVIDER ELEGAN */
    .profile-divider {
        height: 1px;
        background: linear-gradient(90deg, rgba(226,232,240,0) 0%, rgba(226,232,240,1) 20%, rgba(226,232,240,1) 80%, rgba(226,232,240,0) 100%);
        margin: 40px 0;
    }

    /* INFO CARDS HIGH-END */
    .profile-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
    }

    .info-card {
        position: relative;
        overflow: hidden;
        border: 1px solid var(--ult-border);
        border-radius: 20px;
        padding: 26px 28px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .info-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--ult-primary);
        transition: width 0.3s ease, background 0.5s ease;
    }

    .info-card.orange::before { background: var(--ult-amber); }
    .info-card.green::before { background: var(--ult-green); }

    .info-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 36px rgba(15, 23, 42, 0.08);
        border-color: var(--ult-border-hover);
    }

    .info-card:hover::before {
        width: 8px;
    }

    .info-icon {
        width: 50px;
        height: 50px;
        border-radius: 15px;
        background: #eff6ff;
        color: var(--ult-primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        font-size: 21px;
        transition: transform 0.4s ease;
    }

    .info-card:hover .info-icon {
        transform: scale(1.1) rotate(6deg);
    }

    .info-card.orange .info-icon {
        background: #fff7ed;
        color: var(--ult-amber);
    }

    .info-card.green .info-icon {
        background: #ecfdf5;
        color: var(--ult-green);
    }

    .info-title {
        color: var(--ult-text-muted);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .info-value {
        color: var(--ult-navy-deep);
        font-size: 18px;
        font-weight: 800;
    }

    /* MODAL ENHANCEMENT GLASSMORPHISM (SUPER DEWA) */
    .profile-modal .modal-content {
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 32px;
        overflow: hidden;
        box-shadow: 0 40px 90px rgba(15, 23, 42, 0.35);
        background: rgba(255, 255, 255, 0.96);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
    }

    .profile-modal .modal-header {
        border: 0;
        padding: 30px 38px;
        background: linear-gradient(135deg, var(--ult-navy-deep) 0%, var(--ult-primary) 100%);
        color: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .profile-modal .modal-title {
        font-weight: 800;
        font-size: 22px;
        letter-spacing: -0.4px;
    }

    .profile-modal .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.85;
        transition: all 0.25s ease;
    }

    .profile-modal .btn-close:hover {
        opacity: 1;
        transform: rotate(90deg) scale(1.1);
    }

    .profile-modal .modal-body {
        padding: 40px;
    }

    .profile-modal .form-label {
        color: var(--ult-text-dark);
        font-weight: 700;
        font-size: 13px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .profile-modal .form-control,
    .profile-modal .form-select {
        border: 1.5px solid var(--ult-border);
        border-radius: 16px;
        padding: 14px 18px;
        min-height: 52px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .profile-modal .form-control:focus,
    .profile-modal .form-select:focus {
        border-color: var(--ult-primary-light);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.14);
        background: #ffffff;
    }

    .profile-modal .form-control:disabled {
        background-color: #f1f5f9;
        color: #64748b;
        opacity: 1;
    }

    /* THEME OPTIONS SELECTOR GRID PREVIEW IN MODAL */
    .theme-options-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-top: 6px;
    }

    .theme-option-card {
        border: 2px solid var(--ult-border);
        border-radius: 14px;
        padding: 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        background: #ffffff;
    }

    .theme-option-card:hover {
        border-color: var(--ult-primary-light);
        transform: translateY(-2px);
    }

    .theme-option-card.active {
        border-color: var(--ult-primary);
        background: #eff6ff;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.15);
    }

    .theme-option-card i {
        font-size: 20px;
        margin-bottom: 4px;
        display: block;
        color: var(--ult-primary-light);
    }

    .theme-option-card span {
        font-size: 11.5px;
        font-weight: 700;
        color: var(--ult-text-dark);
    }

    .btn-profile-save {
        border: 0;
        border-radius: 16px;
        background: linear-gradient(135deg, var(--ult-primary-light) 0%, var(--ult-primary) 100%);
        color: #ffffff;
        padding: 14px 32px;
        font-weight: 800;
        font-size: 14px;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 10px 24px rgba(30, 64, 175, 0.28);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
    }

    .btn-profile-save:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 16px 32px rgba(30, 64, 175, 0.4);
        color: #ffffff;
    }

    /* TOAST NOTIFICATION SYSTEM APPLE macOS/iOS SPRING ANIMATION */
    .profile-toast-wrapper {
        position: fixed;
        right: 32px;
        bottom: 32px;
        z-index: 999999;
        pointer-events: none;
    }

    .profile-toast {
        background: rgba(15, 23, 42, 0.88);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        color: #ffffff;
        padding: 18px 24px;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.15);
        box-shadow: 0 25px 50px rgba(15, 23, 42, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        gap: 16px;
        min-width: 340px;
        max-width: 450px;
        transform: translateY(120px) scale(0.85);
        opacity: 0;
        pointer-events: auto;
        transition: transform 0.6s cubic-bezier(0.34, 1.8, 0.64, 1), opacity 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .profile-toast.show {
        transform: translateY(0) scale(1);
        opacity: 1;
    }

    .profile-toast-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        width: 100%;
        background: var(--ult-cyan);
        transition: width linear;
    }

    .profile-toast.toast-error .profile-toast-progress {
        background: #ef4444;
    }

    .profile-toast.toast-success .profile-toast-progress {
        background: var(--ult-green);
    }

    .profile-toast-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.12);
        color: var(--ult-cyan);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .profile-toast.toast-error .profile-toast-icon {
        background: rgba(239, 68, 68, 0.22);
        color: #ef4444;
    }

    .profile-toast.toast-success .profile-toast-icon {
        background: rgba(5, 150, 105, 0.22);
        color: var(--ult-green);
    }

    .profile-toast-content {
        display: flex;
        flex-direction: column;
    }

    .profile-toast-title {
        font-size: 14px;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 2px;
        letter-spacing: -0.2px;
    }

    .profile-toast-message {
        font-size: 12.5px;
        color: #cbd5e1;
        font-weight: 500;
        line-height: 1.4;
    }

    /* RIPPLE EFFECT CANVAS */
    .ripple-effect {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.45);
        transform: scale(0);
        animation: rippleAnim 0.6s linear;
        pointer-events: none;
    }

    @keyframes rippleAnim {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    /* STAGGERED ENTRANCE ANIMATIONS */
    .stagger-item {
        opacity: 0;
        transform: translateY(24px);
        transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .stagger-item.stagger-show {
        opacity: 1;
        transform: translateY(0);
    }

    /* RESPONSIVE DESIGN */
    @media (max-width: 1024px) {
        .profile-top {
            grid-template-columns: 1fr;
            gap: 32px;
        }

        .profile-photo-section {
            border-right: 0;
            border-bottom: 1px dashed var(--ult-border);
            padding-bottom: 36px;
        }

        .profile-info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .theme-options-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .petugas-profile {
            padding: 20px 16px 48px;
        }

        .profile-page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .profile-edit-main-btn {
            width: 100%;
            justify-content: center;
        }

        .profile-title-wrap h1 {
            font-size: 26px;
        }

        .profile-card-body {
            padding: 24px 18px;
        }

        .data-grid,
        .profile-info-grid,
        .theme-options-grid {
            grid-template-columns: 1fr;
        }

        .profile-card-header {
            padding: 22px 18px;
        }

        .profile-toast-wrapper {
            right: 16px;
            left: 16px;
            bottom: 20px;
        }

        .profile-toast {
            max-width: 100%;
            min-width: 100%;
        }
    }
</style>

<div class="petugas-profile">

    <!-- HEADER PAGE -->
    <div class="profile-page-header stagger-item">

        <div class="profile-title-wrap">
            <div class="profile-title-icon-wrapper">
                <div class="profile-title-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>

            <div>
                <div class="theme-character-badge" id="themeHeaderBadge">
                    <i class="fas fa-film"></i> <span id="themeBadgeText">Official Dashboard Theme</span>
                </div>
                <h1>Profil Petugas</h1>
                <p>Kelola dan tinjau identitas resmi petugas Unit Layanan Terpadu Polban.</p>
            </div>
        </div>

        <button
            type="button"
            class="profile-edit-main-btn ripple-btn"
            id="openEditModalBtn"
        >
            <i class="fas fa-pen"></i>
            <span>Edit Profil</span>
        </button>

    </div>


    <!-- CARD UTAMA -->
    <div class="profile-main-card stagger-item" id="tiltCard">

        <div class="profile-card-header">
            <div class="profile-card-header-bg-glow"></div>
            <div>
                <h3>
                    <i class="fas fa-id-card"></i>
                    Informasi Akun Petugas
                </h3>
                <small>Data terverifikasi pada sistem Unit Layanan Terpadu POLBAN</small>
            </div>

            <i class="fas fa-shield-alt fs-2 opacity-50"></i>
        </div>


        <div class="profile-card-body">

            <div class="profile-top">

                <!-- FOTO SECTION DENGAN KARAKTER FILM -->
                <div class="profile-photo-section stagger-item">
                    <div class="theme-char-banner"></div>

                    <div class="profile-photo-wrapper">
                        <div class="profile-photo-ring"></div>

                        <div id="photoContainer">
                            <div class="profile-photo-empty">
                                <i class="fas fa-user-tie"></i>
                            </div>
                        </div>

                        <label
                            for="photoInput"
                            class="photo-upload-button ripple-btn"
                            title="Ganti Foto Profil"
                        >
                            <i class="fas fa-camera"></i>
                        </label>

                        <input
                            type="file"
                            id="photoInput"
                            class="photo-upload-input"
                            accept="image/png,image/jpeg,image/jpg,image/webp"
                        >

                    </div>

                    <h2
                        class="profile-name"
                        id="displayName"
                    >
                        <?= esc(session()->get('name') ?? 'Petugas ULT') ?>
                    </h2>

                    <div class="profile-role">
                        <i class="fas fa-user-check text-primary"></i>
                        Petugas ULT Polban
                    </div>

                    <div class="profile-status">
                        <span class="status-dot"></span>
                        Akun Aktif & Terverifikasi
                    </div>

                    <!-- KONTEN KARAKTER FILM GRAFIS -->
                    <div class="theme-char-preview" id="themeCharInfoBox">
                        <i class="fas fa-star" id="themeCharIcon"></i>
                        <span id="themeCharText">Tema Normal / Standar</span>
                    </div>

                    <div class="photo-help">
                        Format JPG, PNG, WEBP · Maks. 2 MB
                    </div>

                </div>


                <!-- DATA UTAMA -->
                <div class="profile-data-section">

                    <div class="section-heading stagger-item">
                        <div class="section-heading-icon">
                            <i class="fas fa-address-card"></i>
                        </div>
                        <h4>Data Personal</h4>
                    </div>

                    <div class="data-grid">

                        <div class="data-item stagger-item" onclick="copyToClipboard('displayNameData', 'Nama Lengkap')">
                            <div class="data-label">
                                <div class="data-label-left">
                                    <i class="fas fa-user"></i>
                                    Nama Lengkap
                                </div>
                                <span class="data-copy-badge"><i class="fas fa-copy me-1"></i>Salin</span>
                            </div>

                            <div
                                class="data-value"
                                id="displayNameData"
                            >
                                <?= esc(session()->get('name') ?? 'Petugas ULT') ?>
                            </div>
                        </div>


                        <div class="data-item stagger-item" onclick="copyToClipboard('displayId', 'ID Petugas')">
                            <div class="data-label">
                                <div class="data-label-left">
                                    <i class="fas fa-id-badge"></i>
                                    ID Petugas
                                </div>
                                <span class="data-copy-badge"><i class="fas fa-copy me-1"></i>Salin</span>
                            </div>

                            <div
                                class="data-value"
                                id="displayId"
                            >
                                <?= esc(session()->get('user_id') ?? '-') ?>
                            </div>
                        </div>


                        <div class="data-item stagger-item" onclick="copyToClipboard('displayEmail', 'Email')">
                            <div class="data-label">
                                <div class="data-label-left">
                                    <i class="fas fa-envelope"></i>
                                    Email Official
                                </div>
                                <span class="data-copy-badge"><i class="fas fa-copy me-1"></i>Salin</span>
                            </div>

                            <div
                                class="data-value"
                                id="displayEmail"
                            >
                                <?= esc(session()->get('email') ?? '-') ?>
                            </div>
                        </div>


                        <div class="data-item stagger-item" onclick="copyToClipboard('displayPhone', 'Nomor HP')">
                            <div class="data-label">
                                <div class="data-label-left">
                                    <i class="fas fa-phone-alt"></i>
                                    Nomor WhatsApp / HP
                                </div>
                                <span class="data-copy-badge"><i class="fas fa-copy me-1"></i>Salin</span>
                            </div>

                            <div
                                class="data-value"
                                id="displayPhone"
                            >
                                -
                            </div>
                        </div>


                        <div class="data-item stagger-item">
                            <div class="data-label">
                                <div class="data-label-left">
                                    <i class="fas fa-briefcase"></i>
                                    Jabatan
                                </div>
                            </div>

                            <div
                                class="data-value"
                                id="displayPosition"
                            >
                                Petugas ULT
                            </div>
                        </div>


                        <div class="data-item stagger-item">
                            <div class="data-label">
                                <div class="data-label-left">
                                    <i class="fas fa-building"></i>
                                    Unit / Departemen
                                </div>
                            </div>

                            <div
                                class="data-value"
                                id="displayUnit"
                            >
                                Unit Layanan Terpadu
                            </div>
                        </div>

                    </div>

                </div>

            </div>


            <div class="profile-divider stagger-item"></div>


            <!-- INFORMASI KEPEGAWAIAN -->
            <div class="section-heading stagger-item">
                <div class="section-heading-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h4>Otoritas Kepegawaian</h4>
            </div>


            <div class="profile-info-grid">

                <div class="info-card stagger-item">
                    <div class="info-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>

                    <div class="info-title">
                        Role Access
                    </div>

                    <div class="info-value">
                        Petugas ULT
                    </div>
                </div>


                <div class="info-card orange stagger-item">
                    <div class="info-icon">
                        <i class="fas fa-headset"></i>
                    </div>

                    <div class="info-title">
                        Tugas Utama
                    </div>

                    <div class="info-value">
                        Pengelolaan Tiket & Aduan
                    </div>
                </div>


                <div class="info-card green stagger-item">
                    <div class="info-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>

                    <div class="info-title">
                        Status Sistem
                    </div>

                    <div class="info-value">
                        Aktif Beroperasi
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     MODAL EDIT PROFILE DEWA (DENGAN PILIHAN TEMA KARAKTER VISUAL)
     ========================================================= -->

<div
    class="modal fade profile-modal"
    id="modalEditProfile"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <div>
                    <h5 class="modal-title">
                        <i class="fas fa-user-edit me-2"></i>
                        Edit Informasi Profil & Karakter Tema
                    </h5>

                    <small class="opacity-80">
                        Pembaruan data petugas dan kustomisasi karakter film interaktif
                    </small>
                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">

                <form id="profileEditForm">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label">
                                <i class="fas fa-user text-primary"></i> Nama Lengkap
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="editName"
                                value="<?= esc(session()->get('name') ?? 'Petugas ULT') ?>"
                                required
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                <i class="fas fa-envelope text-primary"></i> Email Official
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                id="editEmail"
                                value="<?= esc(session()->get('email') ?? '') ?>"
                                required
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                <i class="fas fa-id-badge text-primary"></i> ID Petugas (System Locked)
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="<?= esc(session()->get('user_id') ?? '-') ?>"
                                disabled
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                <i class="fas fa-phone text-primary"></i> Nomor WhatsApp / HP
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="editPhone"
                                placeholder="Contoh: 081234567890"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                <i class="fas fa-briefcase text-primary"></i> Jabatan
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="editPosition"
                                value="Petugas ULT"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                <i class="fas fa-building text-primary"></i> Unit / Departemen
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="editUnit"
                                value="Unit Layanan Terpadu"
                            >

                        </div>


                        <!-- SELECTOR TEMA FILM BERKARAKTER INTERAKTIF -->
                        <div class="col-12">
                            <label class="form-label">
                                <i class="fas fa-palette text-primary"></i> Pilih Tema Karakter Film Favorit
                            </label>
                            
                            <select class="form-select d-none" id="themeSelector">
                                <option value="normal">Normal</option>
                                <option value="spiderman">Spiderman</option>
                                <option value="mcqueen">Lightning McQueen</option>
                                <option value="up">UP (Carl & Balloons)</option>
                                <option value="monster">Monsters Inc (Sully)</option>
                                <option value="elemental">Elemental (Ember & Wade)</option>
                            </select>

                            <div class="theme-options-grid">
                                <div class="theme-option-card" data-theme="normal">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Normal Pro</span>
                                </div>
                                <div class="theme-option-card" data-theme="spiderman">
                                    <i class="fas fa-spider"></i>
                                    <span>Spider-Man</span>
                                </div>
                                <div class="theme-option-card" data-theme="mcqueen">
                                    <i class="fas fa-car-side"></i>
                                    <span>McQueen</span>
                                </div>
                                <div class="theme-option-card" data-theme="up">
                                    <i class="fas fa-house"></i>
                                    <span>UP Movie</span>
                                </div>
                                <div class="theme-option-card" data-theme="monster">
                                    <i class="fas fa-ghost"></i>
                                    <span>Monsters Inc</span>
                                </div>
                                <div class="theme-option-card" data-theme="elemental">
                                    <i class="fas fa-fire"></i>
                                    <span>Elemental</span>
                                </div>
                            </div>
                        </div>


                        <div class="col-12">

                            <label class="form-label">
                                <i class="fas fa-camera text-primary"></i> Unggah Foto Profil Baru
                            </label>

                            <input
                                type="file"
                                class="form-control"
                                id="modalPhotoInput"
                                accept="image/png,image/jpeg,image/jpg,image/webp"
                            >

                        </div>

                    </div>


                    <div class="d-flex justify-content-end gap-3 mt-4">

                        <button
                            type="button"
                            class="btn btn-light border px-4 fw-bold ripple-btn"
                            style="border-radius:16px;"
                            data-bs-dismiss="modal"
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="btn-profile-save ripple-btn"
                        >
                            <i class="fas fa-save me-1"></i>
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>


<!-- TOAST CONTAINER NOTIFIKASI DEWA -->
<div class="profile-toast-wrapper">
    <div class="profile-toast" id="profileToast">
        <div class="profile-toast-icon" id="profileToastIcon">
            <i class="fas fa-check-circle"></i>
        </div>

        <div class="profile-toast-content">
            <span class="profile-toast-title" id="profileToastTitle">SI ULT POLBAN</span>
            <span class="profile-toast-message" id="profileToastText">
                Profil berhasil diperbarui.
            </span>
        </div>

        <div class="profile-toast-progress" id="profileToastProgress"></div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const STORAGE_KEY = 'si_ult_petugas_profile_v3';
    const THEME_KEY = 'si_ult_petugas_theme_v3';

    const editForm = document.getElementById('profileEditForm');
    const themeSelector = document.getElementById('themeSelector');
    const themeCards = document.querySelectorAll('.theme-option-card');

    const themeHeaderBadge = document.getElementById('themeHeaderBadge');
    const themeBadgeText = document.getElementById('themeBadgeText');
    const themeCharInfoBox = document.getElementById('themeCharInfoBox');
    const themeCharIcon = document.getElementById('themeCharIcon');
    const themeCharText = document.getElementById('themeCharText');

    const photoInput = document.getElementById('photoInput');
    const modalPhotoInput = document.getElementById('modalPhotoInput');
    const photoContainer = document.getElementById('photoContainer');

    const displayName = document.getElementById('displayName');
    const displayNameData = document.getElementById('displayNameData');
    const displayEmail = document.getElementById('displayEmail');
    const displayPhone = document.getElementById('displayPhone');
    const displayPosition = document.getElementById('displayPosition');
    const displayUnit = document.getElementById('displayUnit');

    const editName = document.getElementById('editName');
    const editEmail = document.getElementById('editEmail');
    const editPhone = document.getElementById('editPhone');
    const editPosition = document.getElementById('editPosition');
    const editUnit = document.getElementById('editUnit');

    const toast = document.getElementById('profileToast');
    const toastText = document.getElementById('profileToastText');
    const toastTitle = document.getElementById('profileToastTitle');
    const toastIcon = document.getElementById('profileToastIcon');
    const toastProgress = document.getElementById('profileToastProgress');

    let toastTimer = null;
    const TOAST_DURATION = 3800;

    /* =========================================================
       FIX BUTTON MODAL TRIGGER MANUAL VIA JAVASCRIPT
       ========================================================= */
    const openEditModalBtn = document.getElementById('openEditModalBtn');
    if (openEditModalBtn) {
        openEditModalBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const modalEl = document.getElementById('modalEditProfile');
            if (modalEl) {
                const bootstrapModal = new bootstrap.Modal(modalEl);
                bootstrapModal.show();
            }
        });
    }

    /* =========================================================
       FUNGSI TEMA DINAMIS & KARAKTER FILM MAPPING
       ========================================================= */
    const themeDetails = {
        normal: { name: 'Official Dashboard Theme', icon: 'fas fa-shield-alt', text: 'Tema Standar ULT POLBAN Profesional' },
        spiderman: { name: 'Spider-Man Edition', icon: 'fas fa-spider', text: 'Karakter: Spider-Man (Friendly Neighborhood)' },
        mcqueen: { name: 'Lightning McQueen Edition', icon: 'fas fa-car-side', text: 'Karakter: Lightning McQueen (Ka-Chow!)' },
        up: { name: 'UP Movie Edition', icon: 'fas fa-house', text: 'Karakter: Carl & Ellie (Adventure is Out There)' },
        monster: { name: 'Monsters Inc Edition', icon: 'fas fa-ghost', text: 'Karakter: Sulley & Mike (We Scare Because We Care)' },
        elemental: { name: 'Elemental Edition', icon: 'fas fa-fire', text: 'Karakter: Ember & Wade (Fire & Water Elements)' }
    };

    function applyTheme(themeName) {
        document.body.classList.remove('theme-spiderman', 'theme-mcqueen', 'theme-up', 'theme-monster', 'theme-elemental');
        
        if (themeName && themeName !== 'normal') {
            document.body.classList.add(`theme-${themeName}`);
        }
        
        if (themeSelector) {
            themeSelector.value = themeName;
        }

        themeCards.forEach(card => {
            if (card.getAttribute('data-theme') === themeName) {
                card.classList.add('active');
            } else {
                card.classList.remove('active');
            }
        });

        const detail = themeDetails[themeName] || themeDetails['normal'];
        if (themeBadgeText) themeBadgeText.textContent = detail.name;
        if (themeCharIcon) themeCharIcon.className = detail.icon;
        if (themeCharText) themeCharText.textContent = detail.text;
    }

    const savedTheme = localStorage.getItem(THEME_KEY) || 'normal';
    applyTheme(savedTheme);

    themeCards.forEach(card => {
        card.addEventListener('click', function() {
            const selectedTheme = this.getAttribute('data-theme');
            applyTheme(selectedTheme);
        });
    });


    /* =========================================================
       1. STAGGERED ENTRANCE ANIMATION (DEWA LEVEL)
       ========================================================= */
    const staggerItems = document.querySelectorAll('.stagger-item');
    staggerItems.forEach((item, index) => {
        setTimeout(() => {
            item.classList.add('stagger-show');
        }, 80 * index);
    });

    /* =========================================================
       2. 3D TILT EFFECT FOR PROFILE CARD (DEWA LEVEL)
       ========================================================= */
    const tiltCard = document.getElementById('tiltCard');
    if (tiltCard && window.innerWidth > 992) {
        tiltCard.addEventListener('mousemove', (e) => {
            const rect = tiltCard.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = ((y - centerY) / centerY) * -4.5;
            const rotateY = ((x - centerX) / centerX) * 4.5;

            tiltCard.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.005, 1.005, 1.005)`;
        });

        tiltCard.addEventListener('mouseleave', () => {
            tiltCard.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
        });
    }

    /* =========================================================
       3. RIPPLE CLICK EFFECT ON BUTTONS (DEWA LEVEL)
       ========================================================= */
    document.querySelectorAll('.ripple-btn, .btn-profile-save').forEach(btn => {
        btn.addEventListener('click', function (e) {
            const circle = document.createElement('span');
            const diameter = Math.max(this.clientWidth, this.clientHeight);
            const radius = diameter / 2;
            
            const rect = this.getBoundingClientRect();
            circle.style.width = circle.style.height = `${diameter}px`;
            circle.style.left = `${e.clientX - rect.left - radius}px`;
            circle.style.top = `${e.clientY - rect.top - radius}px`;
            circle.classList.add('ripple-effect');

            const existingRipple = this.querySelector('.ripple-effect');
            if (existingRipple) {
                existingRipple.remove();
            }

            this.appendChild(circle);
        });
    });

    /* =========================================================
       4. AUDIO FEEDBACK SYSTEM (WEB AUDIO API HIGH-PRECISION)
       ========================================================= */
    function playAudioFeedback(type = 'success') {
        try {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();

            osc.connect(gain);
            gain.connect(ctx.destination);

            if (type === 'success') {
                osc.type = 'sine';
                osc.frequency.setValueAtTime(523.25, ctx.currentTime);
                osc.frequency.exponentialRampToValueAtTime(880, ctx.currentTime + 0.15);
                gain.gain.setValueAtTime(0.08, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.25);
                osc.start(ctx.currentTime);
                osc.stop(ctx.currentTime + 0.25);
            } else if (type === 'copy') {
                osc.type = 'triangle';
                osc.frequency.setValueAtTime(783.99, ctx.currentTime);
                gain.gain.setValueAtTime(0.05, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.12);
                osc.start(ctx.currentTime);
                osc.stop(ctx.currentTime + 0.12);
            } else {
                osc.type = 'sawtooth';
                osc.frequency.setValueAtTime(220, ctx.currentTime);
                osc.frequency.exponentialRampToValueAtTime(110, ctx.currentTime + 0.2);
                gain.gain.setValueAtTime(0.09, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.2);
                osc.start(ctx.currentTime);
                osc.stop(ctx.currentTime + 0.2);
            }
        } catch (e) {}
    }


    /* =========================================================
       5. SYSTEM NOTIFIKASI TOAST macOS/iOS SPRING ANIMATION
       ========================================================= */
    function showToast(message, type = 'success', title = 'Pemberitahuan') {
        if (toastTimer) {
            clearTimeout(toastTimer);
        }

        playAudioFeedback(type);

        toastText.textContent = message;
        toastTitle.textContent = title;

        toast.classList.remove('toast-success', 'toast-error');
        toastProgress.style.transition = 'none';
        toastProgress.style.width = '100%';

        if (type === 'error') {
            toast.classList.add('toast-error');
            toastIcon.innerHTML = '<i class="fas fa-exclamation-triangle"></i>';
        } else {
            toast.classList.add('toast-success');
            toastIcon.innerHTML = '<i class="fas fa-check-circle"></i>';
        }

        toast.classList.add('show');

        setTimeout(() => {
            toastProgress.style.transition = `width ${TOAST_DURATION}ms linear`;
            toastProgress.style.width = '0%';
        }, 50);

        toastTimer = setTimeout(function () {
            toast.classList.remove('show');
        }, TOAST_DURATION);
    }


    /* =========================================================
       COPY TO CLIPBOARD INTERACTIVE WITH ANIMATION
       ========================================================= */
    window.copyToClipboard = function(elementId, labelName) {
        const element = document.getElementById(elementId);
        if (!element) return;

        const textToCopy = element.textContent.trim();
        if (textToCopy === '' || textToCopy === '-') return;

        navigator.clipboard.writeText(textToCopy).then(() => {
            playAudioFeedback('copy');
            
            const parentItem = element.closest('.data-item');
            if (parentItem) {
                parentItem.style.transform = 'scale(0.96)';
                setTimeout(() => {
                    parentItem.style.transform = '';
                }, 180);
            }

            showToast(`${labelName} berhasil disalin ke clipboard!`, 'success', 'Salin Teks');
        }).catch(() => {
            showToast(`Gagal menyalin ${labelName}.`, 'error', 'Peringatan');
        });
    };


    /* =========================================================
       LOAD DATA PROFIL DARI STORAGE
       ========================================================= */
    let savedData = {};

    try {
        savedData = JSON.parse(
            localStorage.getItem(STORAGE_KEY) || '{}'
        );
    } catch (error) {
        savedData = {};
    }

    function applySavedData() {
        if (savedData.name) {
            displayName.textContent = savedData.name;
            displayNameData.textContent = savedData.name;
            editName.value = savedData.name;
        }

        if (savedData.email) {
            displayEmail.textContent = savedData.email;
            editEmail.value = savedData.email;
        }

        if (savedData.phone) {
            displayPhone.textContent = savedData.phone;
            editPhone.value = savedData.phone;
        }

        if (savedData.position) {
            displayPosition.textContent = savedData.position;
            editPosition.value = savedData.position;
        }

        if (savedData.unit) {
            displayUnit.textContent = savedData.unit;
            editUnit.value = savedData.unit;
        }

        if (savedData.photo) {
            showPhoto(savedData.photo);
        }
    }

    applySavedData();


    /* =========================================================
       EFEK VISUAL TAMPILAN FOTO DEWA
       ========================================================= */
    function showPhoto(imageSource) {
        photoContainer.innerHTML = '';

        const image = document.createElement('img');
        image.src = imageSource;
        image.className = 'profile-photo';
        image.alt = 'Foto Profil Petugas';

        image.style.opacity = '0';
        image.style.transform = 'scale(0.8) rotate(-8deg)';

        photoContainer.appendChild(image);

        requestAnimationFrame(() => {
            image.style.transition = 'all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1)';
            image.style.opacity = '1';
            image.style.transform = 'scale(1) rotate(0deg)';
        });
    }


    /* =========================================================
       BACA & VALIDASI INPUT FOTO
       ========================================================= */
    function processPhoto(file) {
        if (!file) return;

        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

        if (!allowedTypes.includes(file.type)) {
            showToast('Format foto harus berformat JPG, PNG, atau WEBP.', 'error', 'Format Salah');
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            showToast('Ukuran berkas foto maksimal 2 MB.', 'error', 'Berkas Terlalu Besar');
            return;
        }

        const reader = new FileReader();
        reader.onload = function (event) {
            const imageSource = event.target.result;
            savedData.photo = imageSource;

            localStorage.setItem(STORAGE_KEY, JSON.stringify(savedData));
            showPhoto(imageSource);
            showToast('Foto profil baru berhasil diperbarui!', 'success', 'Foto Disimpan');
        };
        reader.readAsDataURL(file);
    }

    photoInput.addEventListener('change', function () {
        processPhoto(this.files[0]);
    });

    modalPhotoInput.addEventListener('change', function () {
        processPhoto(this.files[0]);
    });


    /* =========================================================
       SUBMIT FORM EDIT PROFIL INTERAKTIF
       ========================================================= */
    editForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const name = editName.value.trim();
        const email = editEmail.value.trim();
        const phone = editPhone.value.trim();
        const position = editPosition.value.trim();
        const unit = editUnit.value.trim();
        const selectedTheme = themeSelector ? themeSelector.value : 'normal';

        if (!name) {
            showToast('Nama lengkap wajib diisi.', 'error', 'Validasi Gagal');
            editName.focus();
            return;
        }

        if (!email) {
            showToast('Alamat email wajib diisi.', 'error', 'Validasi Gagal');
            editEmail.focus();
            return;
        }

        savedData.name = name;
        savedData.email = email;
        savedData.phone = phone || '-';
        savedData.position = position || 'Petugas ULT';
        savedData.unit = unit || 'Unit Layanan Terpadu';

        localStorage.setItem(STORAGE_KEY, JSON.stringify(savedData));
        localStorage.setItem(THEME_KEY, selectedTheme);
        applyTheme(selectedTheme);

        const elementsToAnimate = [displayName, displayNameData, displayEmail, displayPhone, displayPosition, displayUnit];
        elementsToAnimate.forEach(el => {
            el.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            el.style.opacity = '0';
            el.style.transform = 'translateY(-6px)';
        });

        setTimeout(() => {
            displayName.textContent = name;
            displayNameData.textContent = name;
            displayEmail.textContent = email;
            displayPhone.textContent = phone || '-';
            displayPosition.textContent = position || 'Petugas ULT';
            displayUnit.textContent = unit || 'Unit Layanan Terpadu';

            elementsToAnimate.forEach(el => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            });
        }, 280);

        const modalElement = document.getElementById('modalEditProfile');
        const modal = bootstrap.Modal.getInstance(modalElement);

        if (modal) {
            modal.hide();
        }

        showToast('Profil petugas & tema karakter berhasil diperbarui secara permanen.', 'success', 'Pembaruan Disimpan');
    });

});
</script>

<?= $this->endSection() ?>
<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    /* =========================================================
       PROFILE PETUGAS ULT POLBAN - OFFICIAL DASHBOARD THEME (DEWA EDITION)
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
        --ult-glass-bg: rgba(255, 255, 255, 0.72);
        --ult-glass-border: rgba(255, 255, 255, 0.6);
        --ult-shadow-xl: 0 25px 50px -12px rgba(15, 23, 42, 0.08), 0 10px 20px -8px rgba(15, 23, 42, 0.04);
        --ult-shadow-glow: 0 12px 36px rgba(30, 64, 175, 0.18);
        --ult-shadow-amber: 0 10px 25px rgba(217, 119, 6, 0.2);
    }

    .petugas-profile {
        padding: 32px 36px 64px;
        background: var(--ult-bg);
        min-height: calc(100vh - 70px);
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        position: relative;
        overflow-x: hidden;
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
    }

    .profile-title-wrap p {
        margin: 4px 0 0;
        color: var(--ult-text-muted);
        font-size: 14px;
        font-weight: 500;
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
        transition: transform 0.15s ease-out, box-shadow 0.4s ease;
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
        grid-template-columns: 320px 1fr;
        gap: 42px;
        align-items: stretch;
    }

    /* PHOTO SECTION WITH GLASSMORPHISM CARD */
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
    }

    .profile-photo-wrapper {
        position: relative;
        width: 176px;
        height: 176px;
        margin-bottom: 24px;
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
        background: rgba(248, 250, 25c, 0.8);
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
        transition: width 0.3s ease;
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

    /* MODAL ENHANCEMENT GLASSMORPHISM */
    .profile-modal .modal-content {
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 35px 80px rgba(15, 23, 42, 0.3);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
    }

    .profile-modal .modal-header {
        border: 0;
        padding: 28px 36px;
        background: linear-gradient(135deg, var(--ult-navy-deep) 0%, var(--ult-primary) 100%);
        color: #ffffff;
    }

    .profile-modal .modal-title {
        font-weight: 800;
        font-size: 21px;
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
        padding: 36px;
    }

    .profile-modal .form-label {
        color: var(--ult-text-dark);
        font-weight: 700;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .profile-modal .form-control,
    .profile-modal .form-select {
        border: 1.5px solid var(--ult-border);
        border-radius: 14px;
        padding: 13px 18px;
        min-height: 50px;
        font-size: 14px;
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

    .btn-profile-save {
        border: 0;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--ult-primary-light) 0%, var(--ult-primary) 100%);
        color: #ffffff;
        padding: 14px 30px;
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
        .profile-info-grid {
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
                <h1>Profil Petugas</h1>
                <p>Kelola dan tinjau identitas resmi petugas Unit Layanan Terpadu Polban.</p>
            </div>
        </div>

        <button
            type="button"
            class="profile-edit-main-btn ripple-btn"
            data-bs-toggle="modal"
            data-bs-target="#modalEditProfile"
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

                <!-- FOTO SECTION -->
                <div class="profile-photo-section stagger-item">

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
     MODAL EDIT PROFILE DEWA
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
                        Edit Informasi Profil
                    </h5>

                    <small class="opacity-80">
                        Pembaruan data petugas akan disinkronkan secara otomatis
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
                                Nama Lengkap
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
                                Email Official
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
                                ID Petugas (System Locked)
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
                                Nomor WhatsApp / HP
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
                                Jabatan
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
                                Unit / Departemen
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="editUnit"
                                value="Unit Layanan Terpadu"
                            >

                        </div>


                        <div class="col-12">

                            <label class="form-label">
                                Unggah Foto Profil Baru
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
                            style="border-radius:14px;"
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

    const STORAGE_KEY = 'si_ult_petugas_profile_v2';

    const editForm = document.getElementById('profileEditForm');

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
    document.querySelectorAll('.ripple-btn, .profile-edit-main-btn, .btn-profile-save').forEach(btn => {
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
                osc.frequency.setValueAtTime(523.25, ctx.currentTime); // C5
                osc.frequency.exponentialRampToValueAtTime(880, ctx.currentTime + 0.15); // A5
                gain.gain.setValueAtTime(0.08, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.25);
                osc.start(ctx.currentTime);
                osc.stop(ctx.currentTime + 0.25);
            } else if (type === 'copy') {
                osc.type = 'triangle';
                osc.frequency.setValueAtTime(783.99, ctx.currentTime); // G5
                gain.gain.setValueAtTime(0.05, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.12);
                osc.start(ctx.currentTime);
                osc.stop(ctx.currentTime + 0.12);
            } else {
                osc.type = 'sawtooth';
                osc.frequency.setValueAtTime(220, ctx.currentTime); // A3
                osc.frequency.exponentialRampToValueAtTime(110, ctx.currentTime + 0.2);
                gain.gain.setValueAtTime(0.09, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.2);
                osc.start(ctx.currentTime);
                osc.stop(ctx.currentTime + 0.2);
            }
        } catch (e) {
            // Audio Context disabled or muted by browser policy
        }
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
            
            // Visual pulse effect on item
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

        if (!file) {
            return;
        }

        const allowedTypes = [
            'image/jpeg',
            'image/jpg',
            'image/png',
            'image/webp'
        ];

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

            localStorage.setItem(
                STORAGE_KEY,
                JSON.stringify(savedData)
            );

            showPhoto(imageSource);

            showToast('Foto profil baru berhasil diperbarui!', 'success', 'Foto Disimpan');

        };

        reader.readAsDataURL(file);

    }


    /* =========================================================
       LISTENER INPUT FOTO
       ========================================================= */

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

        // Simpan Data
        savedData.name = name;
        savedData.email = email;
        savedData.phone = phone || '-';
        savedData.position = position || 'Petugas ULT';
        savedData.unit = unit || 'Unit Layanan Terpadu';

        localStorage.setItem(
            STORAGE_KEY,
            JSON.stringify(savedData)
        );

        // Transisi Pembaruan Teks Dewa
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

        showToast('Profil petugas berhasil diperbarui secara permanen.', 'success', 'Pembaruan Disimpan');

    });

});
</script>

<?= $this->endSection() ?>
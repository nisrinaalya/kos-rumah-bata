<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Kos Rumah Bata</title>
    <link rel="icon" type="image/png" href="/logo.png">

    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --bg: #f8f3ee;
            --white: #ffffff;
            --text: #211713;
            --muted: #86766f;
            --primary: #c8664a;
            --primary-dark: #b75a41;
            --soft: #f4ddd4;
            --soft-light: #fbf5f1;
            --border: #ead6ce;
            --danger: #ef4136;
            --success: #2e8b45;
            --warning: #b77700;
            --sidebar-width: 260px;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: rgba(255, 255, 255, 0.95);
            border-right: 1px solid var(--border);
            padding: 26px 18px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            overflow-y: auto;
            z-index: 50;
            transition: 0.25s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 4px 4px 28px;
            border-bottom: 1px solid #f0e3dc;
            margin-bottom: 24px;
        }

        .brand-logo {
            width: 46px;
            height: 46px;
            background: var(--primary);
            color: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 20px;
            flex-shrink: 0;
        }

        .brand h3 {
            margin: 0;
            font-size: 16px;
            line-height: 1.2;
            font-weight: 700;
            letter-spacing: -0.02em;
            white-space: nowrap;
        }

        .brand p {
            margin: 4px 0 0;
            color: var(--muted);
            font-size: 12px;
            font-weight: 400;
        }

        .menu-title {
            margin: 0 10px 13px;
            color: #a69890;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .menu {
            display: grid;
            gap: 7px;
        }

        .menu a {
            text-decoration: none;
            color: #3d332e;
            padding: 14px 16px;
            border-radius: 16px;
            font-size: 15px;
            font-weight: 500;
            transition: 0.2s ease;
            display: flex;
            align-items: center;
        }

        .menu a:hover {
            background: var(--soft-light);
            color: var(--primary);
        }

        .menu a.active {
            background: var(--soft);
            color: var(--primary);
            font-weight: 700;
        }

        .sidebar-dropdown {
            display: grid;
            gap: 6px;
        }

        .sidebar-dropdown summary {
            text-decoration: none;
            color: #3d332e;
            padding: 14px 16px;
            border-radius: 16px;
            font-size: 15px;
            font-weight: 500;
            transition: 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            cursor: pointer;
            list-style: none;
        }

        .sidebar-dropdown summary::-webkit-details-marker {
            display: none;
        }

        .sidebar-dropdown summary:hover {
            background: var(--soft-light);
            color: var(--primary);
        }

        .sidebar-dropdown[open] summary {
            background: var(--soft-light);
            color: var(--primary);
            font-weight: 700;
        }

        .sidebar-dropdown summary span:first-child {
            white-space: nowrap;
        }

        .dropdown-arrow {
            width: 16px;
            height: 16px;
            color: var(--muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-left: 6px;
            transition: 0.2s ease;
        }

        .dropdown-arrow svg {
            width: 15px;
            height: 15px;
            display: block;
        }

        .dropdown-arrow path {
            fill: none;
            stroke: currentColor;
            stroke-width: 2.3;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .sidebar-dropdown[open] .dropdown-arrow {
            transform: rotate(180deg);
            color: var(--primary);
        }

        .sidebar-submenu {
            display: grid;
            gap: 5px;
            margin: 2px 0 4px 14px;
            padding-left: 10px;
            border-left: 1px solid var(--border);
        }

        .sidebar-submenu a {
            min-height: 38px;
            padding: 0 14px;
            border-radius: 12px;
            font-size: 14px;
        }

        .sidebar-submenu a.active {
            background: var(--soft);
            color: var(--primary);
            font-weight: 700;
        }

        .sidebar-overlay {
            display: none;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
        }

        .admin-navbar {
            min-height: 76px;
            background: rgba(255, 255, 255, 0.92);
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            position: sticky;
            top: 0;
            z-index: 40;
            box-shadow: 0 1px 0 rgba(234, 214, 206, 0.7);
            backdrop-filter: blur(14px);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .mobile-menu {
            display: none;
            width: 42px;
            height: 42px;
            border: 1px solid var(--border);
            background: var(--white);
            border-radius: 14px;
            cursor: pointer;
            font-size: 20px;
            color: var(--text);
            flex-shrink: 0;
        }

        .navbar-title h2 {
            margin: 0;
            font-size: 23px;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .navbar-title p {
            margin: 5px 0 0;
            font-size: 14px;
            color: var(--muted);
            font-weight: 400;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            flex-shrink: 0;
        }

        .notification-wrap {
            position: relative;
        }

        .notification-button {
            width: 46px;
            height: 46px;
            border: 1px solid var(--border);
            background: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text);
            transition: 0.2s ease;
            position: relative;
        }

        .notification-button:hover {
            background: #fffaf7;
            border-color: #dfc6ba;
        }

        .notification-button svg {
            width: 19px;
            height: 19px;
            stroke: currentColor;
        }

        .notification-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            min-width: 17px;
            height: 17px;
            padding: 0 5px;
            border-radius: 999px;
            background: var(--danger);
            color: white;
            font-size: 10px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        .notification-dropdown {
            display: none;
            position: absolute;
            top: 58px;
            right: -8px;
            width: 320px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 18px 45px rgba(66, 38, 22, 0.14);
            overflow: hidden;
            z-index: 120;
        }

        .notification-dropdown.show {
            display: block;
        }

        .notification-head {
            padding: 16px 18px;
            border-bottom: 1px solid #f2e5de;
        }

        .notification-head strong {
            display: block;
            font-size: 15px;
            font-weight: 700;
        }

        .notification-head span {
            display: block;
            margin-top: 3px;
            font-size: 12px;
            color: var(--muted);
        }

        .notification-list {
            display: grid;
        }

        .notification-item {
            display: grid;
            grid-template-columns: 38px 1fr;
            gap: 12px;
            padding: 14px 18px;
            text-decoration: none;
            color: var(--text);
            border-bottom: 1px solid #f5ebe5;
        }

        .notification-item:hover {
            background: #fbf5f1;
        }

        .notification-icon {
            width: 38px;
            height: 38px;
            border-radius: 13px;
            background: #faf1ed;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
        }

        .notification-text strong {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .notification-text span {
            display: block;
            font-size: 12px;
            color: var(--muted);
            line-height: 1.5;
        }

        .notification-footer {
            display: block;
            padding: 13px 18px;
            text-align: center;
            color: var(--primary);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            border-top: 1px solid #f2e5de;
        }

        .notification-footer:hover {
            background: #fbf5f1;
        }

        .profile-wrap {
            position: relative;
        }

        .profile-button {
            border: 1px solid var(--border);
            background: var(--white);
            border-radius: 999px;
            padding: 7px 12px 7px 7px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            min-width: 150px;
            font-family: inherit;
            transition: 0.2s ease;
        }

        .profile-button:hover {
            background: #fffaf7;
            border-color: #dfc6ba;
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            background: var(--primary);
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .profile-text {
            text-align: left;
            flex: 1;
            line-height: 1.2;
        }

        .profile-text strong {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
        }

        .profile-text span {
            display: block;
            margin-top: 3px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 400;
        }

        .profile-arrow {
            width: 18px;
            height: 18px;
            color: var(--muted);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .profile-arrow svg {
            width: 16px;
            height: 16px;
            display: block;
        }

        .profile-arrow path {
            fill: none;
            stroke: currentColor;
            stroke-width: 2.2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .profile-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 58px;
            width: 180px;
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 18px 45px rgba(66, 38, 22, 0.14);
            overflow: hidden;
            z-index: 100;
        }

        .profile-dropdown.show {
            display: block;
        }

        .profile-dropdown a {
            display: block;
            padding: 14px 16px;
            color: #3d332e;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-bottom: 1px solid #f2e5de;
        }

        .profile-dropdown a:hover {
            background: var(--soft-light);
            color: var(--primary);
        }

        .profile-dropdown a:last-child {
            border-bottom: none;
            color: #c0392b;
        }

        .content-area {
            padding: 32px;
        }

        .topbar {
            background: white;
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 24px 28px;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .topbar h2 {
            margin: 0;
            font-size: 25px;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .topbar p {
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 15px;
        }

        .section {
            background: white;
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 24px;
        }

        .btn {
            background: var(--primary);
            color: white;
            border: 1px solid var(--primary);
            border-radius: 12px;
            padding: 12px 18px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            font-family: inherit;
            transition: 0.2s ease;
        }

        .btn:hover {
            background: var(--primary-dark);
        }

        .btn-secondary,
        .btn-soft {
            background: var(--soft);
            color: var(--primary);
            border-color: var(--soft);
        }

        .btn-secondary:hover,
        .btn-soft:hover {
            background: #ebcec2;
        }

        .btn-danger {
            background: var(--danger);
            border-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background: #d9362c;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 14px 16px;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            background: white;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #dba08d;
            box-shadow: 0 0 0 3px rgba(200, 102, 74, 0.08);
        }

        .form-group {
            margin-bottom: 18px;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            width: fit-content;
        }

        .badge.lunas {
            background: #e5f7e8;
            color: var(--success);
        }

        .badge.dp {
            background: #fff1d6;
            color: var(--warning);
        }

        .badge.maintenance {
            background: #ffe1dc;
            color: #c94f36;
        }

        @media (max-width: 980px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.22);
                z-index: 45;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .mobile-menu {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .admin-navbar {
                padding: 0 22px;
            }

            .content-area {
                padding: 22px;
            }
        }

        @media (max-width: 640px) {
            .admin-navbar {
                padding: 14px 16px;
            }

            .navbar-title p {
                display: none;
            }

            .navbar-title h2 {
                font-size: 19px;
            }

            .notification-button {
                width: 42px;
                height: 42px;
            }

            .notification-dropdown {
                right: -70px;
                width: 290px;
            }

            .profile-button {
                min-width: auto;
                padding: 6px;
            }

            .profile-text,
            .profile-arrow {
                display: none;
            }

            .profile-dropdown {
                right: 0;
                width: 180px;
            }

            .content-area {
                padding: 16px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                padding: 20px;
            }
        }

                .brand-logo {
            background: none !important;
            background-color: transparent !important;
            border-radius: 0 !important;
            padding: 0;


            width: 45px;
            height: auto;
            object-fit: contain;
        }
            </style>
</head>

<body>
<div class="admin-wrapper">

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <img src="/logo.png" alt="Logo Kos Rumah Bata" class="brand-logo">

            <div>
                <h3>Kos Rumah Bata</h3>
                <p>Admin Panel</p>
            </div>
        </div>

        <p class="menu-title">Menu Admin</p>

        <nav class="menu">
            <a href="/admin" class="{{ request()->is('admin') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="/admin/kamar" class="{{ request()->is('admin/kamar*') ? 'active' : '' }}">
                Data Kamar
            </a>

            <a href="/admin/penghuni" class="{{ request()->is('admin/penghuni*') || request()->is('admin/pengajuan-sewa*') ? 'active' : '' }}">
                Data Penghuni
            </a>

            <a href="/admin/pembayaran" class="{{ request()->is('admin/pembayaran*') ? 'active' : '' }}">
                Pembayaran
            </a>

            <a href="/admin/maintenance" class="{{ request()->is('admin/maintenance*') || request()->is('admin/pengajuan-maintenance*') ? 'active' : '' }}">
                Maintenance
            </a>

            <details class="sidebar-dropdown" {{ request()->is('admin/konten*') ? 'open' : '' }}>
                <summary>
                    <span>Manajemen Konten</span>

                    <span class="dropdown-arrow">
                        <svg viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M5.5 7.5L10 12l4.5-4.5" />
                        </svg>
                    </span>
                </summary>

                <div class="sidebar-submenu">
                    <a href="/admin/konten/faq" class="{{ request()->is('admin/konten/faq*') ? 'active' : '' }}">
                        FAQ
                    </a>

                    <a href="/admin/konten/activity" class="{{ request()->is('admin/konten/activity*') ? 'active' : '' }}">
                        Aktivitas
                    </a>

                    <a href="/admin/konten/galeri" class="{{ request()->is('admin/konten/galeri*') ? 'active' : '' }}">
                        Galeri
                    </a>
                </div>
            </details>

            <a href="/admin/laporan" class="{{ request()->is('admin/laporan*') ? 'active' : '' }}">
                Laporan
            </a>
        </nav>
    </aside>

    <main class="main-content">
        <header class="admin-navbar">
            <div class="navbar-left">
                <button class="mobile-menu" type="button" onclick="toggleSidebar()">☰</button>

                <div class="navbar-title">
                    <h2>@yield('page-title', 'Dashboard')</h2>
                    <p>@yield('page-subtitle', 'Kelola operasional Kos Rumah Bata.')</p>
                </div>
            </div>

            <div class="navbar-right">

                {{-- <div class="notification-wrap">
                    <button class="notification-button" type="button" onclick="toggleNotificationMenu()">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 8-3 8h18s-3-1-3-8"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="notification-badge">3</span>
                    </button>

                    <div class="notification-dropdown" id="notificationDropdown">
                        <div class="notification-head">
                            <strong>Notifikasi</strong>
                            <span>3 informasi terbaru perlu dicek.</span>
                        </div>

                        <div class="notification-list">
                            <a href="/admin/pengajuan-sewa" class="notification-item">
                                <div class="notification-icon">S</div>
                                <div class="notification-text">
                                    <strong>Pengajuan sewa baru</strong>
                                    <span>Calon penghuni mengajukan Kamar 01.</span>
                                </div>
                            </a>

                            <a href="/admin/pembayaran" class="notification-item">
                                <div class="notification-icon">P</div>
                                <div class="notification-text">
                                    <strong>Bukti pembayaran masuk</strong>
                                    <span>Rani Amelia mengirim bukti DP.</span>
                                </div>
                            </a>

                            <a href="/admin/pengajuan-maintenance" class="notification-item">
                                <div class="notification-icon">M</div>
                                <div class="notification-text">
                                    <strong>Laporan maintenance</strong>
                                    <span>Kamar 12 melaporkan saluran air.</span>
                                </div>
                            </a>
                        </div>

                        <a href="/" class="notification-footer">Lihat semua aktivitas</a>
                    </div>
                </div> --}}

                <div class="profile-wrap">
                    <button class="profile-button" type="button" onclick="toggleProfileMenu()">
                        <div class="profile-avatar">A</div>

                        <div class="profile-text">
                            <strong>Admin</strong>
                            <span>Owner</span>
                        </div>

                        <span class="profile-arrow">
                            <svg viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M5.5 7.5L10 12l4.5-4.5" />
                            </svg>
                        </span>
                    </button>

                    <div class="profile-dropdown" id="profileDropdown">
                        <a href="/logout">Logout</a>
                    </div>
                </div>

            </div>
        </header>

        <div class="content-area">
            @yield('content')
        </div>
    </main>

</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }

    function toggleProfileMenu() {
        document.getElementById('profileDropdown').classList.toggle('show');
        document.getElementById('notificationDropdown').classList.remove('show');
    }

    function toggleNotificationMenu() {
        document.getElementById('notificationDropdown').classList.toggle('show');
        document.getElementById('profileDropdown').classList.remove('show');
    }

    document.addEventListener('click', function(event) {
        const profileWrap = document.querySelector('.profile-wrap');
        const notificationWrap = document.querySelector('.notification-wrap');

        if (!profileWrap.contains(event.target)) {
            document.getElementById('profileDropdown').classList.remove('show');
        }

        if (!notificationWrap.contains(event.target)) {
            document.getElementById('notificationDropdown').classList.remove('show');
        }
    });
</script>

</body>
</html>

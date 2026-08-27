@extends('admin.layout')

@section('content')

<style>
    .profile-wrap {
        display: grid;
        grid-template-columns: 360px 1fr;
        gap: 22px;
    }

    .profile-card {
        background: white;
        border: 1px solid #ead6ce;
        border-radius: 22px;
        padding: 26px;
        height: fit-content;
    }

    .profile-cover {
        background: #c8664a;
        height: 110px;
        border-radius: 18px;
        margin-bottom: -42px;
    }

    .profile-avatar-large {
        width: 86px;
        height: 86px;
        background: white;
        border: 5px solid white;
        color: #c8664a;
        box-shadow: 0 8px 18px rgba(0,0,0,.08);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        font-weight: 800;
        margin-left: 24px;
        margin-bottom: 18px;
    }

    .profile-name {
        margin-top: 12px;
    }

    .profile-name h3 {
        margin: 0;
        font-size: 22px;
    }

    .profile-name p {
        margin: 6px 0 0;
        color: #888;
    }

    .profile-info {
        margin-top: 24px;
        display: grid;
        gap: 14px;
    }

    .profile-info-row {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid #f0e3dd;
        padding-bottom: 12px;
        font-size: 14px;
    }

    .profile-info-row span {
        color: #8b6a5f;
    }

    .profile-form {
        background: white;
        border: 1px solid #ead6ce;
        border-radius: 22px;
        padding: 26px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .form-full {
        grid-column: span 2;
    }
</style>

<div class="topbar">
    <div>
        <h2>Profile Admin</h2>
        <p>Kelola informasi akun pengelola Kos Rumah Bata.</p>
    </div>

    <a href="/" class="btn btn-secondary">Kembali ke Dashboard</a>
</div>

<div class="profile-wrap">

    <div class="profile-card">
        <div class="profile-cover"></div>
        <div class="profile-avatar-large">A</div>

        <div class="profile-name">
            <h3>Admin Kos Rumah Bata</h3>
            <p>Pengelola utama sistem kos</p>
        </div>

        <div class="profile-info">
            <div class="profile-info-row">
                <span>Status</span>
                <strong style="color:#2e8b45;">Aktif</strong>
            </div>

            <div class="profile-info-row">
                <span>Role</span>
                <strong>Admin / Owner</strong>
            </div>

            <div class="profile-info-row">
                <span>Akses</span>
                <strong>Full Access</strong>
            </div>

            <div class="profile-info-row">
                <span>Login terakhir</span>
                <strong>Hari ini</strong>
            </div>
        </div>
    </div>

    <div class="profile-form">
        <h3 style="margin-top:0;">Informasi Akun</h3>
        <p style="margin:6px 0 24px; color:#888;">
            Data ini digunakan sebagai identitas admin pada sistem pengelolaan kos.
        </p>

        <div class="form-grid">
            <div>
                <label>Nama Admin</label>
                <input type="text" value="Admin Kos Rumah Bata">
            </div>

            <div>
                <label>Role</label>
                <input type="text" value="Admin / Owner">
            </div>

            <div>
                <label>Email</label>
                <input type="email" value="admin@kosrumahbata.com">
            </div>

            <div>
                <label>No. HP</label>
                <input type="text" value="0812-3456-7890">
            </div>

            <div class="form-full">
                <label>Alamat Kos</label>
                <textarea>Jl. Mawar No. 12, Bogor</textarea>
            </div>

            <div class="form-full">
                <label>Catatan Admin</label>
                <textarea>Admin bertanggung jawab mengelola data kamar, penghuni, pembayaran, fasilitas, dan maintenance kos.</textarea>
            </div>
        </div>

        <div style="margin-top:22px; display:flex; gap:10px;">
            <a href="/" class="btn">Simpan Perubahan</a>
            <a href="/" class="btn btn-secondary">Batal</a>
        </div>
    </div>

</div>

@endsection

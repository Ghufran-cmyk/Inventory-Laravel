<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Supplier - Multivision Gear</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* CSS Dasar & Sidebar */
        :root {
            --sidebar-bg: #09090b; --sidebar-hover: #27272a; --bg-color: #f4f4f5;
            --card-bg: #ffffff; --text-main: #18181b; --text-light: #71717a; --border: #e4e4e7;
        }
        body { margin: 0; font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-color); color: var(--text-main); display: flex; }
        .sidebar { width: 260px; background: var(--sidebar-bg); color: white; min-height: 100vh; position: fixed; left: 0; top: 0; display: flex; flex-direction: column; }
        .sidebar-brand { padding: 25px 20px; display: flex; align-items: center; gap: 12px; border-bottom: 1px solid #27272a; }
        .sidebar-brand img { height: 40px; width: 40px; border-radius: 8px; background: white; padding: 2px; object-fit: cover;}
        .sidebar-brand h2 { margin: 0; font-size: 15px; font-weight: 800; line-height: 1.2; color: #ffffff; }
        .sidebar-brand h2 span { color: #a1a1aa; }
        .sidebar-menu { padding: 20px 15px; display: flex; flex-direction: column; gap: 8px; flex-grow: 1; }
        .menu-item { display: flex; align-items: center; padding: 12px 16px; color: #a1a1aa; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; transition: 0.2s; }
        .menu-item:hover { background: var(--sidebar-hover); color: white; }
        .menu-item.active { background: #ffffff; color: #000000; }
        .sidebar-profile { padding: 20px; border-top: 1px solid #27272a; background: #09090b; }
        
        .main-content { margin-left: 260px; padding: 35px 45px; width: calc(100% - 260px); box-sizing: border-box; }
        .page-header { margin-bottom: 30px; }
        .page-header h1 { margin: 0; font-size: 24px; font-weight: 800; }

        /* Desain Khusus Form & Tabel Supplier */
        .card { background: white; border: 1px solid var(--border); border-radius: 12px; padding: 25px; margin-bottom: 30px; }
        .card-title { margin: 0 0 20px 0; font-size: 16px; font-weight: 700; }
        
        .form-row { display: flex; gap: 20px; margin-bottom: 20px; }
        .form-group { flex: 1; display: flex; flex-direction: column; gap: 8px; }
        .form-group label { font-size: 13px; font-weight: 600; color: var(--text-main); }
        .form-control { padding: 10px 15px; border: 1px solid var(--border); border-radius: 8px; font-family: inherit; font-size: 14px; outline: none; }
        .form-control:focus { border-color: var(--text-main); }
        
        .btn-submit { background: #000; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; font-family: inherit; cursor: pointer; transition: 0.2s; }
        .btn-submit:hover { background: #27272a; }

        .history-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .history-table th { text-align: left; padding: 12px 15px; background: #fafafa; border-bottom: 1px solid var(--border); font-size: 11px; text-transform: uppercase; color: var(--text-light); }
        .history-table td { padding: 15px; border-bottom: 1px solid var(--border); font-size: 14px; color: var(--text-main); font-weight: 500; }

        .alert-success { padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; font-weight: 600; background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    </style>
</head>
<body>
    
    <div class="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('images/logo-saya.png') }}" alt="Logo">
            <h2>MULTIVISION<br><span>GEAR</span></h2>
        </div>
        <div class="sidebar-menu">
            <a href="/products" class="menu-item">Dashboard Utama</a>
            <a href="/movements" class="menu-item">Pergerakan Stok</a> 
            <a href="/suppliers" class="menu-item active">Data Supplier</a>
        </div>
        <div class="sidebar-profile">
            <div class="profile-info" style="display: flex; flex-direction: column; align-items: flex-start; gap: 6px;">
                <strong style="margin: 0;">{{ auth()->check() ? auth()->user()->name : 'Guest' }}</strong>
                <span style="background: rgba(16, 185, 129, 0.15); color: #34d399; padding: 3px 10px; border-radius: 12px; font-size: 10px; font-weight: 700; text-transform: uppercase;">{{ auth()->check() ? auth()->user()->role : 'guest' }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin-top: 15px;">
                @csrf
                <button type="submit" style="width:100%; padding:10px; border-radius:8px; background:rgba(225, 29, 72, 0.05); color:#fb7185; border:1px solid rgba(225, 29, 72, 0.3); cursor:pointer; font-weight:600; font-family:inherit;">Logout Akun</button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="page-header">
            <h1>Manajemen Mitra / Supplier</h1>
        </div>

        @if(session('success')) <div class="alert-success">{{ session('success') }}</div> @endif

        <!-- Form Tambah Supplier -->
        <div class="card">
            <h3 class="card-title">+ Tambah Supplier Baru</h3>
            <form action="/suppliers" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Perusahaan / Toko</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: PT. Sentra Kamera" required>
                    </div>
                    <div class="form-group">
                        <label>Kontak (HP / Email)</label>
                        <input type="text" name="contact" class="form-control" placeholder="Contoh: 0812-xxxx-xxxx" required>
                    </div>
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label>Alamat Lengkap</label>
                    <input type="text" name="address" class="form-control" placeholder="Alamat gudang atau kantor supplier..." required>
                </div>
                <button type="submit" class="btn-submit">Simpan Supplier</button>
            </form>
        </div>

        <!-- Tabel Daftar Supplier -->
        <div class="card">
            <h3 class="card-title">Daftar Supplier Aktif</h3>
            <table class="history-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Supplier</th>
                        <th>Info Kontak</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $s)
                    <tr>
                        <td style="color: var(--text-light);">#{{ $s->id }}</td>
                        <td style="font-weight: 700;">{{ $s->name }}</td>
                        <td>{{ $s->contact }}</td>
                        <td style="color: var(--text-light);">{{ $s->address }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; color: var(--text-light); padding: 30px;">Belum ada data supplier yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pergerakan Stok - Multivision Gear</title>
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
        
        /* CSS KHUSUS PROFIL ADMIN (Yang tadi ada di Langkah 2) */
        .sidebar-profile { padding: 20px; border-top: 1px solid #27272a; background: #09090b; }
        .profile-info { font-size: 13px; color: #a1a1aa; margin-bottom: 15px; }
        .profile-info strong { color: white; font-size: 15px; display: block; margin-bottom: 4px;}
        .role-badge { background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.2); padding: 3px 10px; border-radius: 12px; font-size: 10px; text-transform: uppercase; font-weight: 700; }
        .btn-logout { display: block; width: 100%; cursor: pointer; font-family: inherit; text-align: center; background: rgba(225, 29, 72, 0.05); border: 1px solid rgba(225, 29, 72, 0.3); color: #fb7185; padding: 10px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 13px; transition: 0.3s; }
        .btn-logout:hover { background: #e11d48; color: white; border-color: #e11d48; }

        .main-content { margin-left: 260px; padding: 35px 45px; width: calc(100% - 260px); box-sizing: border-box; }
        .page-header { margin-bottom: 30px; }
        .page-header h1 { margin: 0; font-size: 24px; font-weight: 800; }

        /* Desain Form & Tabel Pergerakan */
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
        
        .badge { padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; }
        .badge.in { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .badge.out { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; font-weight: 600; }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
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
            <a href="/movements" class="menu-item active">Pergerakan Stok</a> 
            <!-- Hanya Admin yang bisa melihat menu Supplier -->
            @if(auth()->check() && auth()->user()->role == 'admin')
                <a href="/suppliers" class="menu-item">Data Supplier</a>
            @endif
        </div>
        
        <div class="sidebar-profile">
            <div class="profile-info" style="display: flex; flex-direction: column; align-items: flex-start; gap: 6px;">
                <strong style="margin: 0;">{{ auth()->check() ? auth()->user()->name : 'Guest' }}</strong>
                <!-- Otomatis berubah ADMIN atau STAFF -->
                <span class="role-badge">{{ auth()->check() && auth()->user()->role == 'admin' ? 'ADMIN' : 'STAFF' }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin-top: 15px;">
                @csrf
                <button type="submit" class="btn-logout">Logout Akun</button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="page-header">
            <h1>Catatan Keluar/Masuk Barang</h1>
        </div>

        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-error">{{ session('error') }}</div> @endif

        <div class="card">
            <h3 class="card-title">+ Catat Pergerakan Baru</h3>
            <form action="/movements" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group" style="flex: 2;">
                        <label>Pilih Barang</label>
                        <select name="product_id" class="form-control" required>
                            <option value="">-- Pilih Gear --</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->name }} (Sisa: {{ $p->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <select name="type" class="form-control" required>
                            <option value="in">Barang Masuk (Tambah)</option>
                            <option value="out">Barang Keluar (Kurang)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="quantity" class="form-control" value="1" min="1" required>
                    </div>
                </div>
                
                <div class="form-group" style="margin-bottom: 20px;">
                    <label>Keterangan (Opsional)</label>
                    <input type="text" name="description" class="form-control" placeholder="Contoh: Disewa oleh pelanggan A / Beli baru dari supplier">
                </div>

                <button type="submit" class="btn-submit">Catat Stok</button>
            </form>
        </div>

        <div class="card">
            <h3 class="card-title">Histori Pergerakan Terakhir</h3>
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Nama Alat</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movements as $m)
                    <tr>
                        <td style="color: var(--text-light);">{{ $m->created_at->format('d M Y, H:i') }}</td>
                        <td style="font-weight: 700;">{{ $m->product->name ?? 'Barang Dihapus' }}</td>
                        <td>
                            @if($m->type == 'in')
                                <span class="badge in">MASUK</span>
                            @else
                                <span class="badge out">KELUAR</span>
                            @endif
                        </td>
                        <td><strong>{{ $m->quantity }}</strong> unit</td>
                        <td style="color: var(--text-light);">{{ $m->description ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--text-light); padding: 30px;">Belum ada riwayat pergerakan stok.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Multivision Gear (Laravel)</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: #09090b;
            --sidebar-hover: #27272a;
            --bg-color: #f4f4f5;
            --card-bg: #ffffff;
            --text-main: #18181b;
            --text-light: #71717a;
            --border: #e4e4e7;
            --danger-text: #9f1239;
            --danger-bg: #fff1f2;
            --danger-border: #fecdd3;
            --success-text: #2f5233;
            --success-bg: #e8f0e9;
        }

        body { 
            margin: 0; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg-color); 
            color: var(--text-main);
            display: flex; 
        }

        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            color: white;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #27272a;
        }

        .sidebar-brand {
            padding: 25px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid #27272a;
        }

        .sidebar-brand img {
            height: 40px; 
            border-radius: 8px;
            background: white;
            padding: 2px;
        }

        .sidebar-brand h2 {
            margin: 0;
            font-size: 15px;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: 0.5px;
            color: #ffffff;
        }

        .sidebar-brand h2 span { color: #a1a1aa; }

        .sidebar-menu {
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex-grow: 1;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: #a1a1aa;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu-item:hover { background: var(--sidebar-hover); color: white; }
        .menu-item.active { background: #ffffff; color: #000000; }

        .sidebar-profile {
            padding: 20px;
            border-top: 1px solid #27272a;
            background: #09090b;
        }

        .profile-info { font-size: 13px; color: #a1a1aa; margin-bottom: 15px; }
        .profile-info strong { color: white; font-size: 15px; display: block; margin-bottom: 4px;}
        
        .role-badge { 
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.2);
            padding: 3px 10px; 
            border-radius: 12px; 
            font-size: 10px; 
            text-transform: uppercase; 
            font-weight: 700; 
        }
        
        .btn-logout {
            display: block;
            text-align: center;
            background: rgba(225, 29, 72, 0.05);
            border: 1px solid rgba(225, 29, 72, 0.3); 
            color: #fb7185;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            transition: 0.3s;
        }
        
        .btn-logout:hover { 
            background: #e11d48;
            color: white; 
            border-color: #e11d48;
        }

        .main-content {
            margin-left: 260px; 
            padding: 35px 45px;
            width: calc(100% - 260px);
            box-sizing: border-box;
        }

        .page-header { margin-bottom: 35px; }
        .page-header h1 { margin: 0; font-size: 24px; color: var(--text-main); font-weight: 800; letter-spacing: -0.5px;}
        .page-header p { margin: 5px 0 0 0; color: var(--text-light); font-size: 14px; }

        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: var(--card-bg); padding: 25px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); border: 1px solid var(--border); position: relative; overflow: hidden;}
        .stat-card::before { content: ''; position: absolute; left: 0; top: 0; width: 4px; height: 100%; background: #3f3f46; }
        .stat-card.danger::before { background: var(--danger-text); }
        .stat-card h3 { margin: 0 0 8px; font-size: 12px; color: var(--text-light); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700;}
        .stat-card p { margin: 0; font-size: 26px; font-weight: 800; color: var(--text-main); }

        .action-bar { display: flex; justify-content: space-between; align-items: center; background: transparent; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;}
        
        .btn-add { background: var(--text-main); color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.2s;}
        .btn-add:hover { background: #27272a; }

        .search-form { display: flex; gap: 10px; }
        .search-form input, .search-form select { padding: 12px 16px; border: 1px solid var(--border); border-radius: 8px; font-family: inherit; font-size: 14px; outline: none; background: white;}
        .search-form input:focus, .search-form select:focus { border-color: var(--text-main); }
        .btn-filter { background: white; color: var(--text-main); padding: 12px 20px; border-radius: 8px; border: 1px solid var(--border); font-weight: 600; cursor: pointer; transition: 0.2s;}
        .btn-filter:hover { background: #f4f4f5; }

        .categories { display: flex; gap: 8px; margin-bottom: 25px; flex-wrap: wrap; }
        .cat-tag { padding: 8px 18px; background: white; border: 1px solid var(--border); border-radius: 8px; text-decoration: none; color: var(--text-light); font-size: 13px; font-weight: 600; transition: 0.2s;}
        .cat-tag:hover { border-color: #a1a1aa; color: var(--text-main); }
        .cat-tag.active { background: var(--text-main); color: white; border-color: var(--text-main); }

        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap: 20px; }
        .product-card { background: white; padding: 20px; border-radius: 12px; border: 1px solid var(--border); display: flex; flex-direction: column; transition: 0.2s; }
        .product-card:hover { border-color: #a1a1aa; box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
        
        .product-img { width: 100%; height: 180px; object-fit: cover; border-radius: 8px; background: var(--bg-color); margin-bottom: 15px; border: 1px solid var(--border); }
        .product-info { flex-grow: 1; }
        .product-title { margin: 0 0 5px; font-size: 15px; color: var(--text-main); font-weight: 700;}
        .product-sku { font-size: 12px; color: var(--text-light); font-weight: 600;}
        .product-price { font-size: 18px; font-weight: 800; color: var(--text-main); margin: 12px 0; }
        
        .product-stock { display: inline-block; padding: 4px 10px; background: var(--success-bg); color: var(--success-text); font-size: 12px; font-weight: 700; border-radius: 6px; }
        .product-stock.low { background: var(--danger-bg); color: var(--danger-text); border: 1px solid var(--danger-border); }
        
        .card-actions { display: flex; gap: 8px; margin-top: 20px; }
        .card-actions a { flex: 1; text-align: center; padding: 8px; border-radius: 6px; font-size: 13px; font-weight: 600; text-decoration: none; transition: 0.2s; border: 1px solid var(--border);}
        .btn-edit { background: white; color: var(--text-main); }
        .btn-edit:hover { background: #f4f4f5; border-color: #d4d4d8; }
        .btn-delete { background: white; color: var(--danger-text); border-color: var(--danger-border); }
        .btn-delete:hover { background: var(--danger-bg); }
    </style>
</head>
<body>
    
    <div class="sidebar">
        <div class="sidebar-brand">
            <!-- Untuk sementara kita kosongi logo agar tidak error -->
            <div style="width: 40px; height: 40px; background: white; border-radius: 8px;"></div>
            <h2>MULTIVISION<br><span>GEAR</span></h2>
        </div>
        
        <div class="sidebar-menu">
            <a href="/products" class="menu-item active">Dashboard Utama</a>
            <a href="#" class="menu-item">Pergerakan Stok</a>
            <a href="#" class="menu-item">Data Supplier</a>
        </div>
        
        <div class="sidebar-profile">
            <div class="profile-info">
                <strong>Admin Multivision</strong>
                <span class="role-badge">admin</span>
            </div>
            <a href="#" class="btn-logout">Logout Akun</a>
        </div>
    </div>

    <div class="main-content">
        
        <div class="page-header">
            <div>
                <h1>Katalog Inventaris</h1>
                <p>Kelola dan pantau stok peralatan fotografi secara real-time (Versi Laravel).</p>
            </div>
        </div>

        <!-- Bagian Statistik: Menggunakan fungsi Collection bawaan Laravel -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Produk Tersimpan</h3>
                <p>{{ $products->count() }}</p>
            </div>
            <div class="stat-card">
                <h3>Total Nilai Aset (Rp)</h3>
                <p>Rp {{ number_format($products->sum('price'), 0, ',', '.') }}</p>
            </div>
            @php $stokRendah = $products->where('stock', '<=', 5)->count(); @endphp
            <div class="stat-card {{ $stokRendah > 0 ? 'danger' : '' }}">
                <h3 style="{{ $stokRendah > 0 ? 'color: var(--danger-text);' : '' }}">Produk Stok Kritis</h3>
                <p style="{{ $stokRendah > 0 ? 'color: var(--danger-text);' : '' }}">
                    {{ $stokRendah }} Produk
                </p>
            </div>
        </div>

        <div class="action-bar">
            <div>
                <a href="/products/create" class="btn-add">Tambah Peralatan Baru</a>
            </div>
            
            <form class="search-form">
                <input type="text" placeholder="Cari nama atau kode SKU..." style="width: 250px;">
                <select>
                    <option>Terbaru Ditambahkan</option>
                    <option>Harga: Termurah</option>
                </select>
                <button type="button" class="btn-filter">Cari Data</button>
            </form>
        </div>

        <div class="categories">
            <a href="#" class="cat-tag active">Tampilkan Semua</a>
            <a href="#" class="cat-tag">Kamera & Lensa</a>
            <a href="#" class="cat-tag">Audio & Recording</a>
        </div>

        <!-- Grid Produk Laravel -->
        <div class="product-grid">
            @forelse ($products as $product)
                <div class="product-card">
                    
                    <!-- KODE UNTUK MENAMPILKAN GAMBAR (MENGGANTIKAN NO IMAGE) -->
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Foto" class="product-img">
                    @else
                        <div class="product-img" style="display: flex; align-items: center; justify-content: center; color: #a1a1aa; font-size: 12px; font-weight: 700; border: none;">NO IMAGE</div>
                    @endif
                    <!-- ======================================================== -->

                    <div class="product-info">
                        <!-- Menggunakan $product->nama_kolom (Sistem Objek Laravel) -->
                        <h3 class="product-title">{{ $product->name }}</h3>
                        <span class="product-sku">Kode: {{ $product->sku }}</span>
                        <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        
                        @php $isLow = $product->stock <= $product->minimum_stock; @endphp
                        <span class="product-stock {{ $isLow ? 'low' : '' }}">
                            {{ $isLow ? 'Sisa ' : 'Tersedia ' }}{{ $product->stock }} Unit
                        </span>
                    </div>
                    
                    <div class="card-actions">
                        <a href="/products/{{ $product->id }}/edit" class="btn-edit">Edit</a>
                        <form action="/products/{{ $product->id }}" method="POST" style="flex: 1; display: flex;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" style="flex: 1; padding: 8px; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; border: 1px solid var(--danger-border);" onclick="return confirm('Yakin ingin menghapus {{ $product->name }}?');">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <!-- Jika database kosong -->
                <p style="grid-column: 1 / -1; text-align: center; color: var(--text-light); margin-top: 40px; font-size: 14px; padding: 50px; border: 1px dashed var(--border); border-radius: 12px; background: white;">
                    Belum ada data peralatan yang sesuai.<br>Silakan tambah barang baru.
                </p>
            @endforelse
        </div>

    </div>
</body>
</html>
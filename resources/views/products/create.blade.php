<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Peralatan - Multivision Gear</title>
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

        .main-content {
            margin-left: 260px; 
            padding: 35px 45px;
            width: calc(100% - 260px);
            box-sizing: border-box;
        }

        .page-header { margin-bottom: 35px; }
        .page-header h1 { margin: 0; font-size: 24px; color: var(--text-main); font-weight: 800; letter-spacing: -0.5px;}
        .page-header p { margin: 5px 0 0 0; color: var(--text-light); font-size: 14px; }

        .form-card {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            border: 1px solid var(--border);
            max-width: 800px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            font-size: 13px;
            color: var(--text-main);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
            background: var(--bg-color);
        }

        .form-control:focus {
            border-color: var(--text-main);
            background: white;
        }

        .btn-submit {
            background: var(--text-main);
            color: white;
            padding: 14px 24px;
            border-radius: 8px;
            border: none;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 10px;
        }

        .btn-submit:hover { background: #27272a; }
        
        .btn-cancel {
            display: inline-block;
            background: white;
            color: var(--text-main);
            padding: 13px 24px;
            border-radius: 8px;
            border: 1px solid var(--border);
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            margin-right: 10px;
        }
        .btn-cancel:hover { background: #f4f4f5; }
    </style>
</head>
<body>
    
    <div class="sidebar">
        <div class="sidebar-brand">
            <div style="width: 40px; height: 40px; background: white; border-radius: 8px;"></div>
            <h2>MULTIVISION<br><span>GEAR</span></h2>
        </div>
        
        <div class="sidebar-menu">
            <a href="/products" class="menu-item active">Dashboard Utama</a>
            <a href="#" class="menu-item">Pergerakan Stok</a>
            <a href="#" class="menu-item">Data Supplier</a>
        </div>
    </div>

    <div class="main-content">
        
        <div class="page-header">
            <div>
                <h1>Tambah Peralatan Baru</h1>
                <p>Masukkan detail inventaris baru ke dalam sistem.</p>
            </div>
        </div>

        <div class="form-card">
            <!-- Form untuk input data menggunakan method POST -->
            <form action="/products" method="POST" enctype="multipart/form-data">
                @csrf 

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kategori Peralatan</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kode SKU</label>
                        <input type="text" name="sku" class="form-control" placeholder="Contoh: CAM-001" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Lengkap Peralatan</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Kamera Sony A7III" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Harga Sewa / Nilai (Rp)</label>
                        <input type="number" name="price" class="form-control" placeholder="Contoh: 150000" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jumlah Stok Fisik</label>
                        <input type="number" name="stock" class="form-control" placeholder="Contoh: 5" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Foto Produk (Opsional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div>
                    <a href="/products" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">Simpan Peralatan</button>
                </div>
            </form>
        </div>

    </div>
</body>
</html>
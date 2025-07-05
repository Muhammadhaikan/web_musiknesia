<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event/Concert</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background: #f8fafc; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #212529 70%, #343a40 100%);
            color: #fff;
            padding-top: 2rem;
            box-shadow: 2px 0 10px rgba(0,0,0,0.08);
        }
        .sidebar .nav-link {
            color: #fff;
            margin-bottom: 1rem;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: #ffc107;
            color: #212529;
            font-weight: bold;
        }
        .content {
            margin-left: 220px;
            padding: 2rem 1rem 1rem 1rem;
        }
        @media (max-width: 991px) {
            .sidebar { min-height: auto; position: static; }
            .content { margin-left: 0; }
        }
        .dropdown-toggle::after { margin-left: 0.5em; }
        .card {
            border-radius: 1rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }
        .card-title {
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .display-5 {
            font-size: 2.2rem;
            font-weight: 700;
        }
        .sidebar .fs-4 {
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <nav class="sidebar flex-shrink-0 p-3">
        <a href="/admin/dashboard" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <i class="bi bi-music-note-beamed me-2 fs-3"></i>
            <span class="fs-4 fw-bold">Admin Panel</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li><a href="/admin/dashboard" class="nav-link"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
            <li><a href="/admin/concerts" class="nav-link active"><i class="bi bi-music-note-list me-2"></i>Event</a></li>
            <li><a href="/admin/users" class="nav-link"><i class="bi bi-people me-2"></i>User</a></li>
            <li><a href="/admin/transactions" class="nav-link"><i class="bi bi-receipt me-2"></i>Transaksi</a></li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle me-2"></i>{{ auth()->user()->name ?? 'Admin' }}
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div class="content flex-grow-1">
        <h2 class="mb-4">Edit Event/Concert</h2>
        <form action="{{ route('admin.concerts.update', $concert->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_band" class="form-label">Nama Band</label>
                <input type="text" class="form-control" id="nama_band" name="nama_band" value="{{ old('nama_band', $concert->nama_band) }}" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $concert->tanggal) }}" required>
            </div>
            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi', $concert->lokasi) }}" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Tiket</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga', $concert->harga) }}" required>
            </div>
            <div class="mb-3">
                <label for="stok_tiket" class="form-label">Stok Tiket</label>
                <input type="number" class="form-control" id="stok_tiket" name="stok_tiket" value="{{ old('stok_tiket', $concert->stok_tiket) }}" min="0" required>
            </div>
            <div class="mb-3">
                <label for="poster" class="form-label">Poster Event (JPG/PNG)</label>
                <input type="file" class="form-control" id="poster" name="poster" accept="image/*">
                @if($concert->poster)
                    <img src="{{ asset('storage/' . $concert->poster) }}" alt="Poster" class="mt-2" style="max-width:120px; border-radius:8px;">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.concerts.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

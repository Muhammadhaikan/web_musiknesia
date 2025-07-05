<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event/Concert</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background: #f8fafc; }
        .sidebar {
            min-height: 100vh;
            background: #212529;
            color: #fff;
            padding-top: 2rem;
        }
        .sidebar .nav-link {
            color: #fff;
            margin-bottom: 1rem;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: #343a40;
            color: #ffc107;
        }
        .content {
            margin-left: 220px;
            padding: 2rem 1rem 1rem 1rem;
        }
        @media (max-width: 991px) {
            .sidebar { min-height: auto; }
            .content { margin-left: 0; }
        }
    </style>
</head>
<body>
<div class="d-flex">
    <nav class="sidebar flex-shrink-0 p-3">
        <a href="/admin/dashboard" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">Admin Panel</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li><a href="/admin/dashboard" class="nav-link">Dashboard</a></li>
            <!-- <li><a href="/admin/tickets" class="nav-link">Tiket</a></li> -->
            <li><a href="/admin/concerts" class="nav-link active">Event</a></li>
            <li><a href="/admin/users" class="nav-link">User</a></li>
            <li><a href="/admin/transactions" class="nav-link">Transaksi</a></li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->name ?? 'Admin' }}
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
        <h2 class="mb-4">Tambah Event/Concert</h2>
        <form action="{{ route('admin.concerts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_band" class="form-label">Nama Band</label>
                <input type="text" class="form-control" id="nama_band" name="nama_band" value="{{ old('nama_band') }}" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
            </div>
            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Tiket</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" required>
            </div>
            <div class="mb-3">
                <label for="stok_tiket" class="form-label">Stok Tiket</label>
                <input type="number" class="form-control" id="stok_tiket" name="stok_tiket" value="{{ old('stok_tiket') }}" min="0" required>
            </div>
            <div class="mb-3">
                <label for="poster" class="form-label">Poster Event (JPG/PNG)</label>
                <input type="file" class="form-control" id="poster" name="poster" accept="image/*" onchange="previewPoster(event)">
                <img id="poster-preview" src="#" alt="Preview Poster" class="mt-2" style="max-width:120px; border-radius:8px; display:none;" />
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.concerts.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function previewPoster(event) {
    const input = event.target;
    const preview = document.getElementById('poster-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}
</script>
</body>
</html>

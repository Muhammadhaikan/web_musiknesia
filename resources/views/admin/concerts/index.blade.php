<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Event</title>
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
        .sidebar .fs-4 {
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            letter-spacing: 1px;
        }
        .event-poster { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .card {
            border-radius: 1rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            border: none;
        }
        .table {
            border-radius: 1rem;
            overflow: hidden;
            background: #fff;
        }
        .table thead {
            position: sticky;
            top: 0;
            z-index: 1;
        }
        .table th, .table td {
            vertical-align: middle;
            padding: 0.75rem 1rem;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #f8fafc;
        }
        .btn-primary, .btn-warning, .btn-danger, .btn-secondary {
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
            transition: background 0.2s, color 0.2s;
        }
        .btn-primary { background: linear-gradient(90deg, #212529 60%, #ffc107 100%); border: none; }
        .btn-primary:hover { background: #ffc107; color: #212529; }
        .btn-warning { background: #ffc107; color: #212529; border: none; }
        .btn-warning:hover { background: #e0a800; color: #fff; }
        .btn-danger { background: #dc3545; color: #fff; border: none; }
        .btn-danger:hover { background: #b52a37; color: #fff; }
        .btn-secondary { background: #6c757d; color: #fff; border: none; }
        .btn-secondary:hover { background: #495057; color: #fff; }
        .card-title {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
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
        <div class="card p-4 mb-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                <div class="card-title mb-0">Kelola Event</div>
                <a href="{{ route('admin.concerts.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>Tambah Event</a>
            </div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Poster</th>
                            <th>Nama Band</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Harga</th>
                            <th>Stok Tiket</th>
                            <th style="width:120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($concerts as $concert)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if($concert->poster)
                                    <img src="{{ asset('storage/' . $concert->poster) }}" alt="Poster" class="event-poster">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $concert->nama_band ?? $concert->name }}</td>
                            <td>{{ $concert->tanggal ?? $concert->date }}</td>
                            <td>{{ $concert->lokasi ?? $concert->location }}</td>
                            <td>Rp {{ number_format($concert->harga ?? $concert->price, 0, ',', '.') }}</td>
                            <td>{{ $concert->stok_tiket ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.concerts.edit', $concert->id) }}" class="btn btn-warning btn-sm me-1" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('admin.concerts.destroy', $concert->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin hapus?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada event.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $concerts->links() }}
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

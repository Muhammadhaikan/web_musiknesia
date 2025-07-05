
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Transaksi</title>
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
            <li><a href="/admin/concerts" class="nav-link"><i class="bi bi-music-note-list me-2"></i>Event</a></li>
            <li><a href="/admin/users" class="nav-link"><i class="bi bi-people me-2"></i>User</a></li>
            <li><a href="/admin/transactions" class="nav-link active"><i class="bi bi-receipt me-2"></i>Transaksi</a></li>
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
        <h2 class="mb-4">Data Transaksi</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" class="row g-3 align-items-end mb-4">
            <div class="col-md-3">
                <label for="filter_date" class="form-label mb-1">Tanggal Transaksi</label>
                <input type="date" id="filter_date" name="filter_date" class="form-control" value="{{ request('filter_date') }}">
            </div>
            <div class="col-md-3">
                <label for="filter_status" class="form-label mb-1">Status</label>
                <select id="filter_status" name="filter_status" class="form-select">
                    <option value="">-- Semua Status --</option>
                    <option value="pending" {{ request('filter_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="sudah bayar" {{ request('filter_status') == 'sudah bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                    <option value="dibatalkan" {{ request('filter_status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="search_name" class="form-label mb-1">Cari Nama User</label>
                <input type="text" id="search_name" name="search_name" class="form-control" placeholder="Cari nama user..." value="{{ request('search_name') }}">
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">Carikan</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>User</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th style="width:120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $transaction->user->name ?? '-' }}</td>
                        <td>{{ isset($transaction->jumlah) ? $transaction->jumlah : (isset($transaction->quantity) ? $transaction->quantity : '-') }}</td>
                        <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        <td>
                            <span>
                                {{ $transaction->status_label }}
                            </span>
                        </td>
                        <td>{{ $transaction->created_at }}</td>
                        <td class="text-center">
                        <div class="btn-group" role="group">
                            <form action="{{ route('admin.transactions.updateStatus', $transaction->id) }}" method="POST" class="d-inline">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <select name="status" class="form-select form-select-sm status-select" onchange="this.form.submit()" style="min-width: 110px;">
                                        <option value="pending" data-color="warning" style="color: #ffc107;" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="sudah bayar" data-color="success" style="color: #198754;" {{ $transaction->status == 'sudah bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                                        <option value="dibatalkan" data-color="danger" style="color: #dc3545;" {{ $transaction->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                    <!-- Tombol submit dihapus, status akan otomatis tersimpan saat select diubah dengan JS -->
                                </div>
                            </form>
                            <a href="{{ route('admin.transactions.show', $transaction->id) }}" class="btn btn-info btn-sm ms-1"><i class="bi bi-eye"></i> Detail</a>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mb-0">
                    @if ($transactions->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $transactions->previousPageUrl() }}">&laquo;</a></li>
                    @endif
                    @foreach ($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $transactions->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    @if ($transactions->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $transactions->nextPageUrl() }}">&raquo;</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                    @endif
                </ul>
            </nav>
        </div>
        <style>
        .pagination { margin-bottom: 0; }
        .pagination .page-link { border-radius: 6px; }
        </style>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

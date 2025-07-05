<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
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
        .dropdown-toggle::after { margin-left: 0.5em; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-dark sidebar" style="min-height:100vh;">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="/admin/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="/admin/concerts">Event</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="/admin/users">User</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link active bg-secondary text-warning" href="/admin/transactions">Transaksi</a>
                    </li>
                </ul>
                <hr class="bg-light">
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
            </div>
        </nav>
        <main class="col-md-10 ms-sm-auto px-md-4 py-4" style="background:#f8fafc; min-height:100vh;">
            <h2 class="mb-4">Detail Pesanan Masuk</h2>
            <div class="card shadow-sm" style="max-width: 900px; margin:auto;">
                <div class="card-body">
                    <h5 class="card-title mb-3">User: {{ $transaction->user->name ?? '-' }}</h5>
                    <div class="row mb-2">
                        <div class="col-4">Email</div>
                        <div class="col-8">: {{ $transaction->user->email ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">No Identitas</div>
                        <div class="col-8">: {{ $transaction->user->nik ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">No. Telepon</div>
                        <div class="col-8">: {{ $transaction->user->no_tlp ?? '-' }}</div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-4">Nama Band</div>
                        <div class="col-8">: {{ $transaction->concert->nama_band ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">Tanggal Konser</div>
                        <div class="col-8">: {{ $transaction->concert->tanggal ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">Lokasi</div>
                        <div class="col-8">: {{ $transaction->concert->lokasi ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">Harga Tiket</div>
                        <div class="col-8">: Rp {{ number_format($transaction->concert->harga ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">Jumlah Tiket Dipesan</div>
                        <div class="col-8">: {{ $transaction->jumlah }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">Total Harga</div>
                        <div class="col-8">: Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">Metode Pembayaran</div>
                        <div class="col-8">: {{ strtoupper($transaction->payment_method ?? '-') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">Status</div>
                        <div class="col-8">: {{ $transaction->status_label }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">Tanggal Transaksi</div>
                        <div class="col-8">: {{ $transaction->created_at }}</div>
                    </div>
                    <div class="mt-4 text-end">
                        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary btn-sm px-3"><i class="bi bi-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

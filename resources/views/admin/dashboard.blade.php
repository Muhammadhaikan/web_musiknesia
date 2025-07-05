<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
            <span class="fs-4">Admin Panel</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li><a href="/admin/dashboard" class="nav-link active"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
            <li><a href="/admin/concerts" class="nav-link"><i class="bi bi-music-note-list me-2"></i>Event</a></li>
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
        <h2 class="mb-4">Dashboard Admin</h2>
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card text-bg-primary h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total User</h5>
                        <p class="display-5">{{ isset($userCount) ? number_format($userCount, 0, ',', '.') : '0' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-bg-warning h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Event</h5>
                        <p class="display-5">{{ isset($concertCount) ? number_format($concertCount, 0, ',', '.') : '0' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-danger h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Transaksi</h5>
                        <p class="display-5">{{ isset($transactionCount) ? number_format($transactionCount, 0, ',', '.') : '0' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4 g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">Total Pendapatan</h5>
                        <p class="display-5 mb-2 text-success">Rp {{ isset($totalRevenue) ? number_format($totalRevenue, 0, ',', '.') : '0' }}</p>
                        <small class="text-muted">* Hanya dari transaksi yang sudah diterima/sudah bayar</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">Tiket Terjual</h5>
                        <p class="display-5 mb-2 text-primary">{{ isset($totalTicketsSold) ? number_format($totalTicketsSold, 0, ',', '.') : '0' }}</p>
                        <small class="text-muted">* Hanya dari transaksi yang sudah diterima/sudah bayar</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

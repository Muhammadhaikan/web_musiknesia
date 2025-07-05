
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User</title>
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
            <li><a href="/admin/users" class="nav-link active"><i class="bi bi-people me-2"></i>User</a></li>
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
        <h2 class="mb-4">Kelola User</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Tambah User</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" class="row g-3 align-items-end mb-4">
            <div class="col-md-5">
                <label for="search_name" class="form-label mb-1">Cari Nama</label>
                <input type="text" id="search_name" name="search_name" class="form-control" placeholder="Cari nama user..." value="{{ request('search_name') }}">
            </div>
            <div class="col-md-5">
                <label for="search_email" class="form-label mb-1">Cari Email</label>
                <input type="text" id="search_email" name="search_email" class="form-control" placeholder="Cari email user..." value="{{ request('search_email') }}">
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIK</th>
                        <th>No. Telepon</th>
                        <th style="width:120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->nik }}</td>
                        <td>{{ $user->no_tlp }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

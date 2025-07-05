<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tiket Event - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background: #f8fafc; }
        .table thead th { vertical-align: middle; text-align: center; }
        .table tbody td { vertical-align: middle; }
        .navbar { margin-bottom: 2rem; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/admin/dashboard">Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="/admin/tickets">Tiket</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/concerts">Event</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/users">User</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/transactions">Transaksi</a></li>
            </ul>
            <span class="navbar-text text-white">{{ auth()->user()->name ?? 'Admin' }}</span>
        </div>
    </div>
</nav>
<div class="container">
    <h2 class="mb-4">Kelola Tiket Event</h2>
    <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary mb-3">Tambah Tiket</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width:40px;">#</th>
                    <th>Nama Tiket</th>
                    <th>Event</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th style="width:120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $ticket->name }}</td>
                    <td>{{ $ticket->concert->name ?? '-' }}</td>
                    <td>Rp {{ number_format($ticket->price, 0, ',', '.') }}</td>
                    <td>{{ $ticket->stock }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada tiket.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $tickets->links() }}
</div>
</body>
</html>

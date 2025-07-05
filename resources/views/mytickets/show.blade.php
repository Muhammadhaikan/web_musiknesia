<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Tiket') }}
        </h2>
    </x-slot>
    <div class="py-8 px-4 mx-auto max-w-screen-md lg:py-16 lg:px-6">
        <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-800 rounded-lg shadow p-6">
            <h3 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">{{ $trx->concert->nama_band ?? '-' }}</h3>
            <div class="my-6 flex flex-col md:flex-row md:items-center gap-8">
                <div class="flex-1">
                    <p class="mb-2 text-gray-700 dark:text-gray-300">Nama Pemesan: {{ $trx->user->name ?? auth()->user()->name ?? '-' }}</p>
                    <p class="mb-2 text-gray-700 dark:text-gray-300">Tanggal: {{ optional($trx->concert)->tanggal ? \Carbon\Carbon::parse($trx->concert->tanggal)->format('d M Y') : '-' }}</p>
                    <p class="mb-2 text-gray-700 dark:text-gray-300">Lokasi: {{ $trx->concert->lokasi ?? '-' }}</p>
                    <p class="mb-2 text-gray-700 dark:text-gray-300">Harga: Rp {{ number_format($trx->concert->harga ?? 0, 0, ',', '.') }}</p>
                    <p class="mb-2 text-gray-700 dark:text-gray-300">Status: <span class="font-bold">{{ $trx->status }}</span></p>
                    <p class="mb-2 text-gray-700 dark:text-gray-300">Dibeli pada: {{ \Carbon\Carbon::parse($trx->created_at)->format('d M Y H:i') }}</p>
                    <p class="mb-2 text-gray-700 dark:text-gray-300">Metode Pembayaran: {{ $trx->payment_method ?? '-' }}</p>
                    <p class="mb-2 text-gray-700 dark:text-gray-300">Kode Tiket: <span class="font-mono">{{ $trx->kode_tiket ?? '-' }}</span></p>
                    <p class="mb-2 text-gray-700 dark:text-gray-300">Jumlah Tiket: <span class="font-bold">{{ $trx->jumlah ?? 1 }}</span></p>
                </div>
                <div class="flex-shrink-0 flex justify-center md:justify-end">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ $trx->kode_tiket ?? $trx->id }}" alt="Barcode Tiket" class="border rounded bg-white p-2 shadow-md">
                </div>
            </div>
            <div class="mt-6 flex flex-col md:flex-row gap-4">
                <a href="/mytickets" class="inline-block px-6 py-2 bg-gray-500 text-white rounded">Kembali</a>
                <button onclick="window.print()" class="inline-block px-6 py-2 bg-blue-600 text-white rounded">Cetak Tiket</button>
            </div>
        </div>
    </div>
</x-app-layout>

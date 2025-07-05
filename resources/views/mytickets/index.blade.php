<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tiketku') }}
        </h2>
    </x-slot>
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
            @forelse ($transactions as $trx)
                <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-800 rounded-lg shadow p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $trx->concert->nama_band ?? '-' }}</h5>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">Tanggal: {{ optional($trx->concert)->tanggal ? \Carbon\Carbon::parse($trx->concert->tanggal)->format('d M Y') : '-' }}</p>
                    <p class="text-gray-700 dark:text-gray-400 mb-2">Lokasi: {{ $trx->concert->lokasi ?? '-' }}</p>
                    <p class="text-gray-700 dark:text-gray-400 mb-2">Status: <span class="font-bold">{{ $trx->status }}</span></p>
                    <p class="text-gray-700 dark:text-gray-400 mb-2">Dibeli pada: {{ \Carbon\Carbon::parse($trx->created_at)->format('d M Y H:i') }}</p>
                    <a href="{{ '/mytickets/' . $trx->id }}" class="mt-3 inline-block px-5 py-2 bg-blue-600 text-white rounded shadow">Lihat Detail Tiket</a>
                </div>
            @empty
                <div class="col-span-2 text-center text-gray-400">Belum ada tiket/event yang dibeli.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>

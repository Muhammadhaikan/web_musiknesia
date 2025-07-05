<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Event / Beli Tiket') }}
        </h2>
    </x-slot>
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-3">
            @foreach ($concerts as $concert)
                <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-800 rounded-lg shadow ">
                    <img class="rounded-t-lg max-h-15 bg-auto" src="{{ asset('storage/' . $concert->poster) }}" alt="poster" />
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $concert->nama_band}}</h5>
                        <p class="text-gray-700 dark:text-gray-300 mb-6">Concert by {{ $concert->nama_band}}.</p>
                        <p class="text-gray-700 flex items-center dark:text-gray-400 mb-2">Tanggal: {{ \Carbon\Carbon::parse($concert->tanggal)->format('d M Y') }}</p>
                        <p class="text-gray-700 flex items-center dark:text-gray-400 mb-2">Lokasi: {{ $concert->lokasi }}</p>
                        <p class="text-slate-900 font-bold text-xl dark:text-gray-400 mb-0">Rp. {{$concert->harga}}</p>
                        <span class="badge bg-info text-dark">Stok Tiket: {{ $concert->stok_tiket }}</span>
                        <form action="{{ route('concerts.buy', $concert->id) }}" method="POST" class="mt-4 flex gap-2 items-center">
                            @csrf
                            <input type="number" name="jumlah" min="1" max="{{ $concert->stok_tiket }}" value="1" class="w-16 rounded border-gray-300" required @if($concert->stok_tiket==0) disabled @endif>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded disabled:opacity-50" @if($concert->stok_tiket==0) disabled @endif>Beli</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

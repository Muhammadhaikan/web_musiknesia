
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Beranda
        </h2>
    </x-slot>


    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">

                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                    <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Konser yang Tersedia</h2>
                    </div>
                    <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-3">
                        <!-- Lopping Concerts -->
                        @foreach ($concerts as $concert)

                        <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-800 rounded-lg shadow ">

                            <img class="rounded-t-lg max-h-15 bg-auto" src="{{ asset('storage/' . $concert->poster) }}" alt="ndx" />

                            <div class="p-5">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $concert->nama_band}}</h5>

                                <p class="text-gray-700  dark:text-gray-300 mb-6">
                                    Concert by {{ $concert->nama_band}}.
                                </p>
                                <p class="text-gray-700 flex items-center dark:text-gray-400 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($concert->tanggal)->format('d M Y') }}

                                </p>
                                <p class="text-gray-700  flex items-center dark:text-gray-400 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    {{ $concert->lokasi}}
                                </p>

                                <p class="text-gray-700 dark:text-gray-400 mb-4">
                                </p>
                                <div class=""></div>
                                <div class="flex flex-col gap-2 border-t-2 pt-4">
                                    <div class="flex justify-between items-center">
                                        <p class="text-slate-900 font-bold text-xl dark:text-gray-400 mb-0">
                                            Rp. {{$concert->harga}}
                                        </p>
                                        <span class="badge bg-info text-dark dark:text-white">Stok Tiket: {{ $concert->stok_tiket }}</span>
                                    </div>
                                    <div class="mt-2 flex flex-col md:flex-row gap-2 md:gap-0 md:items-center">
                                        @if($concert->stok_tiket > 0)
                                            <a href="{{ route('ticket.form', $concert->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition mb-2 md:mb-0 md:me-2">Beli Tiket</a>
                                        @else
                                            <button class="px-4 py-2 bg-gray-400 text-white rounded opacity-50 cursor-not-allowed mb-2 md:mb-0 md:me-2" disabled>Stok Habis</button>
                                        @endif
                                        <!-- <a href="{{ route('mytickets') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition w-full md:w-auto">Tiketku</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pembayaran QRIS') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg p-8 text-center">
                <h3 class="mb-4 text-lg font-bold">Scan QRIS untuk membayar</h3>
                <img src="/img/qr.png" alt="QRIS" class="mx-auto mb-4 w-64 h-64 object-contain border rounded">
                <p class="mb-2">Total Bayar: <span class="font-bold text-xl">{{ $total_bayar }}</span></p>
                <div class="text-center">
                    <form method="POST" action="{{ route('payment.process', ['method' => 'qris', 'trx' => $trx_id, 'action' => 'confirm']) }}" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="mt-4 px-6 py-2 bg-primary text-white rounded border border-primary shadow" style="background-color:#0d6efd;">Konfirmasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

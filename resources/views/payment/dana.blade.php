<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pembayaran DANA') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg p-8 text-center">
                <h3 class="mb-4 text-lg font-bold">Transfer ke DANA berikut</h3>
                <div class="mb-4">
                    <span class="font-bold">No. DANA:</span> 0812-3456-7890<br>
                    <span class="font-bold">Atas Nama:</span> PT Lifevent Musik
                </div>
                <p class="mb-2">Total Bayar: <span class="font-bold text-xl">{{ $total_bayar }}</span></p>
                <div class="d-flex justify-content-center gap-3">
                    <form method="POST" action="{{ route('payment.process', ['method' => 'dana', 'trx' => $trx_id, 'action' => 'confirm']) }}">
                        @csrf
                        <button type="submit" class="mt-4 px-6 py-2 bg-primary text-white rounded border border-primary shadow" style="background-color:#0d6efd;">Konfirmasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

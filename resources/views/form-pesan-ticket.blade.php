<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulir Pemesanan Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">

                    <form method="post" action="{{ route('ticket.order', $concert->id ) }}" id="orderForm">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Nama Lengkap')" />
                            <x-text-input id="name" class="block mt-1 w-full bg-gray-100 dark:bg-slate-700" type="text" name="name" value="{{ $user->name }}" readonly />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="nik" :value="__('No Identitas')" />
                            <x-text-input id="nik" class="block mt-1 w-full bg-gray-100 dark:bg-slate-700" type="number" name="nik" value="{{ $user->nik }}" readonly />
                            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="no_tlp" :value="__('No. Telephone')" />
                            <x-text-input id="no_tlp" class="block mt-1 w-full bg-gray-100 dark:bg-slate-700" type="number" name="no_tlp" value="{{ $user->no_tlp}}" readonly />
                            <x-input-error :messages="$errors->get('no_tlp')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full bg-gray-100 dark:bg-slate-700" type="email" name="email" value="{{$user->email}}" readonly />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="nama_band" :value="__('Nama Band')" />
                            <x-text-input id="nama_band" class="block mt-1 w-full bg-gray-100 dark:bg-slate-700" type="text" name="nama_band" value="{{$concert->nama_band}}" readonly />
                            <x-input-error :messages="$errors->get('nama_band')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="quantity" :value="__('Jumlah Ticket')" />
                            <x-text-input oninput="count()" id="quantity" class="block mt-1 w-full" type="number" name="quantity" min="1" max="{{$concert->stok_tiket}}" value="1" required autofocus autocomplete="quantity" />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="harga" :value="__('Harga Ticket')" />
                            <div class="flex items-center gap-3">
                                <x-text-input pref id="harga" data-harga="{{$concert->harga}}" class=" block mt-1 w-full bg-gray-100 dark:bg-slate-700" type="text" name="harga" value="{{ number_format($concert->harga,0,',','.') }}" readonly />
                            </div>
                            <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="total_harga" :value="__('Total Bayar')" />
                            <div class="flex items-center gap-3">
                                <x-text-input pref id="total_harga" class="block mt-1 w-full bg-gray-100 dark:bg-slate-700" type="text" name="total_harga" value="{{ number_format($concert->harga,0,',','.') }}" readonly />
                            </div>
                            <x-input-error :messages="$errors->get('total_harga')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="payment_method" :value="__('Metode Pembayaran')" />
                            <select id="payment_method" name="payment_method" class="block mt-1 w-full" required>
                                <option value="">-- Pilih Metode Pembayaran --</option>
                                <option value="qris">QRIS</option>
                                <option value="bri">BRI</option>
                                <option value="dana">DANA</option>
                            </select>
                        </div>

                        <input type="hidden" name="client_datetime" id="client_datetime">
                        <div class="flex justify-end mt-8">
                            <x-primary-button>
                                Pesan Ticket
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        count();
        $('#quantity').on('input', count);
        // Set client datetime saat submit
        $('#orderForm').on('submit', function() {
            const now = new Date();
            // Format: YYYY-MM-DD HH:mm:ss
            const pad = n => n.toString().padStart(2, '0');
            const formatted = now.getFullYear() + '-' + pad(now.getMonth()+1) + '-' + pad(now.getDate()) + ' ' + pad(now.getHours()) + ':' + pad(now.getMinutes()) + ':' + pad(now.getSeconds());
            $('#client_datetime').val(formatted);
        });
    });

    function count() {
        let harga = parseInt($('#harga').data('harga')) || 0;
        let qty = parseInt($('#quantity').val()) || 1;
        let total = harga * qty;
        $('#total_harga').val(formatRupiah(total));
    }

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    }
</script>
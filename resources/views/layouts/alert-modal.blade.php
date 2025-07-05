<x-modal name="alert" show="{{session('success')? true : false ;}}" focusable>
    <div class="p-6">

        <!-- Deskripsi -->

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ session('success')? session('success') : '' ; }}
        </h2>
        <!-- Tombol -->
        <div class="flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Okey') }}
            </x-secondary-button>
        </div>
    </div>
</x-modal>
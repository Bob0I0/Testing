<x-layouts.app :title="__('Surat Keluar')">
    <div class="relative mb-4 w-full">
        <flux:heading size="xl" level="1" variant="strong">
            <strong>{{ __('Data Surat Masuk') }}</strong>
        </flux:heading>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="rounded-xl border border-neutral-200 bg-white dark:bg-zinc-800 p-4 shadow-sm">
                <div class="grid grid-cols-3 items-end gap-4">
                    <div class="flex items-center gap-2">
                        <label for="tanggal_awal" class="w-28 font-medium">Tanggal Awal</label>
                        <flux:input id="tanggal_awal" type="date" max="2999-12-31" label="" />
                    </div>
                    <div class="flex items-center gap-2">
                        <label for="tanggal_akhir" class="w-28 font-medium">Tanggal Akhir</label>
                        <flux:input id="tanggal_akhir" type="date" max="2999-12-31" label="" />
                    </div>
                    <div class="flex justify-end">
                        <flux:button variant="danger" wire:click="$emit('openModal', 'transaksi-masuk')">
                            <span class="flex justify-center">
                                <span>{{ __('Cari Surat') }}</span>
                            </span>
                        </flux:button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-6"></div>
        <div class="card-header">
            <livewire:transaksi-masuk />
        </div>
    </div>
</x-layouts.app>

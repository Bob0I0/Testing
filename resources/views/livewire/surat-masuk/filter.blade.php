<x-layouts.app :title="__('Surat Keluar')">
<div class="relative mb-4 w-full">
    <flux:heading size="xl" level="1" variant="strong">
        <strong>{{ __('Data Surat Masuk') }}</strong>
    </flux:heading>
</div>
<div class="card">
    <div class="card-header">
        <div class="rounded-xl border border-neutral-200 bg-white dark:bg-zinc-800 p-4 shadow-sm">
            <div class="grid grid-cols-6 items-end gap-4">
                {{-- Kolom 1-2: Tanggal Awal (mengambil 2 kolom dari 6) --}}
                <div class="col-span-2 flex items-center gap-2">
                    <label for="tanggal_awal" class="w-35 font-medium">Tanggal Awal</label>
                    <flux:input 
                        icon:trailing="calendar" 
                        datepicker 
                        id="tanggal_awal" 
                        type="text" 
                        class="text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1 
                            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        placeholder="dd/mm/yyyy"
                        wire:model.live="tanggalAwal"
                    />
                </div>
                {{-- Kolom 3: Kosong (mengambil 1 kolom dari 6) --}}
                <div class="col-span-1"></div>
                {{-- Kolom 4-5: Tanggal Akhir (mengambil 2 kolom dari 6) --}}
                <div class="col-span-2 flex items-center gap-2">
                    <label for="tanggal_akhir" class="w-35 font-medium">Tanggal Akhir</label>
                    <flux:input 
                        icon:trailing="calendar" 
                        datepicker 
                        id="tanggal_akhir" 
                        type="text" 
                        class="text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-1
                            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        placeholder="dd/mm/yyyy"
                        wire:model.live="tanggalAkhir"
                    />
                </div>
                {{-- Kolom 6: Tombol Cari Surat (mengambil 1 kolom dari 6) --}}
                <div class="col-span-1 flex justify-end">
                    <flux:button 
                        variant="primary" color="cyan"
                        class="w-full h-auto py-2.5" 
                        wire:click="cariSurat"
                    >
                        Cari Surat
                    </flux:button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-6"></div>
    <div class="card-header">
        <livewire:surat-masuk.show />
    </div>
</div>
</x-layouts.app>

<x-layouts.app :title="__('Surat Keluar')">

{{-- <flux:input sticky placeholder="Cari Berdasarkan Nomor Surat" icon="magnifying-glass" class="w-full text-lg shadow-sm rounded-xl mb-4"/> --}}
<flux:input 
     
    type="text"
    placeholder="Cari Berdasarkan Nomor Surat" 
    icon="magnifying-glass" 
    class="w-full text-lg shadow-md rounded-xl mb-4"
    wire:model.live.debounce.300ms="search"
    {{-- wire:keyup="set('search', $event.target.value)" --}}
/>
<div class="relative mb-4 w-full">
    <flux:heading size="xl" level="1" variant="strong">
        <strong>{{ __('Data Surat Keluar') }}</strong>
    </flux:heading>
</div>

<div class="card">
    <div class="card-header">
        <div class="rounded-xl border border-neutral-200 bg-white dark:bg-zinc-800 p-4 shadow-sm">
            <div class="grid grid-cols-7 items-end gap-4">
                {{-- Kolom 1-2: Tanggal Awal (mengambil 2 kolom dari 6) --}}
                <div class="col-span-2 flex items-center gap-2">
                    <label for="tanggal_awal" class="w-38 font-medium">Tanggal Awal</label>
                    <flux:input 
                        icon:trailing="calendar" 
                        datepicker 
                        datepicker-autohide
                        id="tanggal_awal" 
                        type="text" 
                        placeholder="dd/mm/yyyy"
                        wire:model.live="tanggalAwal"
                    />
                </div>

                <div class="col-span-1"></div>
                {{-- Kolom 3-4: Tanggal Akhir (mengambil 2 kolom dari 6) --}}
                <div class="col-span-2 flex items-center gap-2">
                    <label for="tanggal_akhir" class="w-38 font-medium">Tanggal Akhir</label>
                    <flux:input 
                        icon:trailing="calendar" 
                        datepicker 
                        datepicker-autohide
                        id="tanggal_akhir" 
                        type="text" 
                        placeholder="dd/mm/yyyy"
                        wire:model.live="tanggalAkhir"
                    />
                </div>
                
                {{-- Kolom 6: Tombol Cari Surat (mengambil 1 kolom dari 6) --}}
                <div class="col-span-1 flex justify-end">
                    <flux:button 
                        variant="danger"
                        class="w-full h-auto py-2.5" 
                        wire:click="reset"
                    >
                        Reset
                    </flux:button>
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
        <livewire:surat-keluar.show />
    </div>
</div>
</x-layouts.app>

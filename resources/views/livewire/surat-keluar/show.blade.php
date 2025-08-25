<div>
    <flux:input placeholder="Cari Berdasarkan Nomor Surat" icon="magnifying-glass" type="text" name="search" wire:model.live.debounce.300ms="search" class="w-full text-lg shadow-sm rounded-xl mb-4"/>

    <div class="relative mb-4 w-full">
        <flux:heading size="xl" level="1" variant="strong">
            <strong>{{ __('Data Surat Keluar') }}</strong>
        </flux:heading>
    </div>

    <div class="card my-4">
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
    <div class="overflow-x-auto bg-white dark:bg-zinc-800 p-4 rounded-xl shadow-sm border">
        
        <livewire:surat-keluar.create /> 

        <div class="my-3"></div>
            <table class="table-fixed min-w-full border border-gray-300 text-sm">
                <thead class="bg-cyan-900 text-white text-left">
                    <tr>
                        <th class="border px-3 py-1 w-12">No</th>
                        <th class="border px-3 py-1 w-40">Nomor Surat</th>
                        <th class="border px-3 py-1 w-48">Tujuan Surat</th>
                        <th class="border px-3 py-1 w-32">Tanggal Surat</th>
                        <th class="border px-3 py-1">Perihal</th>
                        <th class="border px-3 py-1 w-36">Jenis Surat</th>
                        <th class="border px-3 py-1 w-28 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->datakeluar as $key => $surat)
                        <tr>
                            <td class="border px-3 py-1 text-center">{{ $this->datakeluar->firstItem() + $key }}</td>
                            <td class="border px-3 py-1">{{ $surat->nomor_surat }}</td>
                            <td class="border px-3 py-1">{{ $surat->tujuan_surat }}</td>
                            <td class="border px-3 py-1">{{ $surat->tanggal_surat->format('d-m-Y') }}</td>
                            <td class="border px-3 py-1 break-words max-w-xs">{{ $surat->perihal }}</td>
                            <td class="border px-3 py-1">{{ $surat->jenis_surat }}</td>
                            <td class="border px-3 py-1">
                                <flux:button.group>

                                    <flux:button icon="edit" variant="subtle" data-modal-target="edit-{{ $surat->id }}" data-modal-toggle="edit-{{ $surat->id }}"></flux:button>

                                    <flux:modal.trigger name="delete-{{ $surat->id }}">
                                        <flux:button icon="trash" variant="subtle"></flux:button>
                                    </flux:modal.trigger>
                                    <livewire:surat-keluar.delete :surat-id="$surat->id" :nomor-surat="$surat->nomor_surat" :key="$surat->id" />

                                    <flux:modal.trigger name="download_SKeluar-{{ $surat->id }}">
                                        <flux:button icon="receive" variant="subtle"></flux:button>
                                    </flux:modal.trigger>
                                    <livewire:surat-keluar.unduh :surat-id="$surat->id" :nomor-surat="$surat->nomor_surat" :key="$surat->id"/>

                                </flux:button.group>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td class="border px-3 py-4"></td>
                            <td class="border px-3 py-4"></td>
                            <td class="border px-3 py-4"></td>
                            <td class="border px-3 py-4"></td>
                            <td class="border px-3 py-4"></td>
                            <td class="border px-3 py-4"></td>
                            <td class="border px-3 py-4"></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-5">
                {{ $this->datakeluar->links('vendor.pagination.custom-pagi') }}
            </div>
            
            {{-- DEFINISI MODAL EDIT (DI LUAR LOOP!) --}}
            {{-- Ini adalah tempat modal sebenarnya akan di-render. --}}
            {{-- Kita menggunakan x-data untuk menyimpan ID surat yang dipilih --}}
            {{-- Ini adalah pendekatan umum jika Anda menggunakan 1 modal untuk semua edit --}}
            <div x-data="{ editingId: null }" @open-modal.window="if ($event.detail === 'edit-' + editingId) editingId = $event.detail.substring(5)">

                @foreach ($this->datakeluar as $surat)
                    {{-- Render komponen Livewire Edit untuk setiap surat di dalam modal masing-masing --}}
                    {{-- Name modal harus cocok dengan name trigger --}}
                        {{-- Gunakan :key untuk memastikan Livewire merender ulang komponen ketika ID surat berubah --}}
                        <livewire:surat-keluar.edit :surat-id="$surat->id" :key="'edit-form-'.$surat->id" />
                @endforeach
            </div>
        </div>
        {{-- Toast Message (opsional, bisa juga di layout utama) --}}
        {{-- @if (session()->has('message'))
            <div id="toast-bottom-right" class="fixed flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow-sm right-5 bottom-5 dark:text-gray-400 dark:divide-gray-700 dark:bg-gray-800" role="alert" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
                <div class="text-sm font-normal">{{ session('message') }}</div>
            </div>
        @endif --}}
    </div>
</div>
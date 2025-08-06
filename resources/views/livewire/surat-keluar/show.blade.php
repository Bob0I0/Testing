<div class="overflow-x-auto bg-white dark:bg-zinc-800 p-4 rounded-xl shadow-sm border">
    <flux:input placeholder="Cari Berdasarkan Nomor Surat" icon="magnifying-glass" type="text" name="search" wire:model.live.debounc.450mse="search" class="w-full text-lg shadow-sm rounded-xl mb-4"/>
    <livewire:surat-keluar.create /> {{-- Pastikan ini ada di tempat yang benar dan punya trigger --}}

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
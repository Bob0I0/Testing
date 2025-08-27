<div>
    
    <flux:input placeholder="Cari Berdasarkan Nomor Surat" icon="magnifying-glass" type="text" name="search" wire:model.live.debounc.450mse="#" class="w-full text-lg shadow-sm rounded-xl mb-4"/>
    
    <div class="card flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        
        <div class="card-header">
            <h1 class="text-2xl font-semibold">{{ __('Data Peminjaman dan Pengembalian Surat ') }}</h1>
        </div>

        <div class="overflow-x-auto bg-white dark:bg-zinc-700 p-4 rounded-xl shadow-sm border">
            <div class="card-body my-3">
                <livewire:pinjamsurat.create />
                <table class="table-fixed min-w-full border border-gray-300 dark:bg-zinc-600 text-sm my-3">
                    <thead class="bg-cyan-900 text-white text-left">
                        <tr class="text-zinc-50">
                            <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-12">No</th>
                            <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-40">Nomor Surat</th>
                            <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-35">Nama Peminjam</th>
                            <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1">Perihal</th>
                            <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-40">Tanggal Peminjaman</th>
                            <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-43">Tanggal Pengembalian</th>
                            <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-20">Status</th>
                            <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-28 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->PinjamSurat as $key => $surat)
                            <tr class="text-zinc-900 dark:text-zinc-50">
                                <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1">{{ $this->PinjamSurat->firstItem() + $key }}</td>
                                <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1">{{ $surat->nomor_surat }}</td>
                                <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1">{{ $surat->nama_peminjam }}</td>
                                <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1">{{ $surat->perihal }}</td>
                                <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1">{{ $surat->tanggal_pinjam->format('d-m-Y') }}</td>
                                <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1">{{ $surat->tanggal_kembali?->format('d-m-Y') }}</td>
                                <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 text-center">
                                    <livewire:pinjamsurat.status />
                                </td>
                                <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1">
                                    <flux:button.group>
                                        <flux:button icon="edit" variant="subtle" data-modal-target="editPS-{{ $surat->id }}" data-modal-toggle="editPS-{{ $surat->id }}"></flux:button>

                                        <flux:modal.trigger name="deletePS-{{ $surat->id }}">
                                            <flux:button icon="trash" variant="subtle"></flux:button>
                                        </flux:modal.trigger>
                                        <livewire:pinjamsurat.delete :surat-id="$surat->id" :nomor-surat="$surat->nomor_surat" :key="$surat->id" />
                                    </flux:button.group>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-4"></td>
                                <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-4"></td>
                                <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-4"></td>
                                <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-4"></td>
                                <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-4"></td>
                                <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-4"></td>
                                <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-4"></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-5">
                    {{-- {{ $this->datauser->links('vendor.pagination.custom-pagi') }} --}}
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ editingId: null }" @open-modal.window="if ($event.detail === 'editPS-' + editingId) editingId = $event.detail.substring(5)">
        @foreach ($this->PinjamSurat as $surat)
            <livewire:pinjamsurat.edit :surat-id="$surat->id" :key="'edit-form-'.$surat->id" />
        @endforeach
    </div>
</div>
<div>
    
    <flux:input placeholder="Cari Berdasarkan Username" icon="magnifying-glass" type="text" name="search" wire:model.live.debounc.450mse="#" class="w-full text-lg shadow-sm rounded-xl mb-4"/>
    
    <div class="card flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        
        <div class="card-header">
            <h1 class="text-2xl font-semibold">{{ __('Data Peminjaman dan Pengembalian Surat ') }}</h1>
        </div>

        <div class="overflow-x-auto bg-white dark:bg-zinc-800 p-4 rounded-xl shadow-sm border">
            <div class="card-body my-3">
                
                <livewire:kelolauser.create />

                <table class="table-fixed min-w-full border border-gray-300 text-sm my-3">
                    <thead class="bg-cyan-900 text-white text-left">
                        <tr>
                            <th class="border px-3 py-1 w-12">No</th>
                            <th class="border px-3 py-1 w-40">Nomor Surat</th>
                            <th class="border px-3 py-1 w-35">Nama Peminjam</th>
                            <th class="border px-3 py-1">Perihal</th>
                            <th class="border px-3 py-1 w-40">Tanggal Peminjaman</th>
                            <th class="border px-3 py-1 w-43">Tanggal Pengembalian</th>
                            <th class="border px-3 py-1 w-20">Status</th>
                            <th class="border px-3 py-1 w-28 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border px-3 py-4"></td>
                            <td class="border px-3 py-4">XXX/AA/UDDPNK/MM/YYYY</td>
                            <td class="border px-3 py-4">bagian kesehatan</td>
                            <td class="border px-3 py-4">bla bla bla ....</td>
                            <td class="border px-3 py-4">12-02-1900</td>
                            <td class="border px-3 py-4">20-03-2019</td>
                            <td class="border px-3 py-4 w-32">
                                <flux:select size="sm" placeholder="Choose">
                                    <flux:select.option>Selesai</flux:select.option>
                                    <flux:select.option>Pinjam</flux:select.option>
                                </flux:select>
                            </td>
                            <td class="border px-3 py-4"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-5">
                    {{-- {{ $this->datauser->links('vendor.pagination.custom-pagi') }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
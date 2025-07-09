<div class="overflow-x-auto bg-white dark:bg-zinc-800 p-4 rounded-lg shadow-md">
    <flux:modal.trigger name="add-file">
        <flux:button variant="danger">Tambah Data</flux:button>
    </flux:modal.trigger>

    <flux:modal name="add-file" class="md:w-130">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Data</flux:heading>
            </div>

            <flux:input label="Nomor Surat" placeholder="XXX/AA/UDDPNK/MM/YYYY" />
            <flux:input label="Asal Surat" placeholder="Instansi" />
            <flux:input rows="2" label="Perihal" placeholder="Isi Perihal" />
            <div class="grid grid-cols-2 gap-4">
                <flux:input type="date" max="2999-12-31" label="Tanggal Masuk" />
                <flux:input label="Jenis Surat" placeholder="Jenis Surat" />
            </div>
            <flux:input type="file" wire:model="UploadFile" label="Upload file" class="border rounded-md" />
            {{--
            <flux:select label="Jenis Surat" placeholder="Jenis Surat" wire:model="jenisSurat">
                <option value="">Pilih Jenis Surat</option>
                @foreach($jenisSuratList as $jenis)
                    <option value="{{ $jenis }}">{{ $jenis }}</option>
                @endforeach
                <option value="__tambah_baru__">+ Tambah Jenis Baru</option>
            </flux:select>
            @if($jenisSurat === '__tambah_baru__')
                <div class="mt-2 flex items-center space-x-2">
                    <flux:input label="Jenis Surat Baru" wire:model.defer="jenisSuratBaru" placeholder="Masukkan jenis surat baru" />
                    <flux:button type="button" wire:click="tambahJenisSurat" variant="primary">Tambah</flux:button>
                </div>
            @endif
            --}}

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" color="green">Simpan</flux:button>
            </div>
        </div>
    </flux:modal>
    <div class="my-3"></div>
    <table class="table-fixed min-w-full border border-gray-300 text-sm">
        <thead class="bg-red-500 text-white text-left">
            <tr>
                <th class="border px-3 py-1">No</th>
                <th class="border px-3 py-1">Nomor Surat</th>
                <th class="border px-3 py-1">Asal Surat</th>
                <th class="border px-3 py-1">Tanggal Surat</th>
                <th class="border px-3 py-1">Perihal</th>
                <th class="border px-3 py-1">Disposisi</th>
                <th class="border px-3 py-1">Jenis Surat</th>
                <th class="border px-3 py-1 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border px-3 py-1 text-center">1</td>
                <td class="border px-3 py-1">XXX/AA/UDDPNK/MM/YYYY</td>
                <td class="border px-3 py-1">Universitas Tanjungpura</td>
                <td class="border px-3 py-1">12/12/2025</td>
                <td class="border px-3 py-1 break-words max-w-xs">Pembantuan di desa terkecil</td>
                <td class="border px-3 py-1">Keuangan</td>
                <td class="border px-3 py-1">Pemberitahuan</td>
                <td class="border px-3 py-1">
                    <flux:button.group>
                        <flux:button href="#" icon="edit" variant="subtle"></flux:button>
                        <flux:button href="#" icon="trash" variant="subtle"></flux:button>
                        <flux:button href="#" icon="receive" variant="subtle"></flux:button>
                    </flux:button.group>
                </td>
            </tr>

        </tbody>
    </table>
</div>

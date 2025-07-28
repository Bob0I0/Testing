<div>

    <flux:modal name="edit-{{ $suratId }}" class="md:w-130">
        <div class="space-y-6">
            <flux:heading size="lg">Edit Data Surat Masuk</flux:heading>
            
            <flux:input wire:model='nomor_surat' label="Nomor Surat" placeholder="XXX/AA/UDDPNK/MM/YYYY" />

            <flux:input wire:model='asal_surat' label="Asal Surat" placeholder="Instansi" />

            <flux:input wire:model='perihal' rows="2" label="Perihal" placeholder="Isi Perihal" />

            <div class="grid grid-cols-2 gap-4">

                <flux:input
                    datepicker
                    datepicker-autohide
                    id="tanggalmasuk-edit" {{-- Berikan ID unik untuk datepicker di modal edit --}}
                    type="text"
                    icon:trailing="calendar"
                    class="text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full z-auto
                            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="dd/mm/yyyy"
                    wire:model="tanggal_surat"
                    label="Tanggal Masuk"
                />

                <flux:input wire:model='jenis_surat' label="Jenis Surat" placeholder="Jenis Surat" />

            </div>

            {{-- Bagian Upload File --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">File Terlampir:</label>
                @if ($existingFile)
                    <div class="flex items-center space-x-2">
                        <a href="{{ Storage::url($existingFile) }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                            Lihat File Lama
                        </a>
                        {{-- Tombol untuk menghapus file lama --}}
                        <flux:button variant="danger" size="xs" wire:click="removeExistingFile" wire:loading.attr="disabled">Hapus File</flux:button>
                    </div>
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada file terlampir.</p>
                @endif

                <flux:input wire:model='file' type="file" label="Ganti File (Opsional)" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                <div wire:loading wire:target="file" class="text-sm text-blue-600 mt-2">
                    Mengunggah file... Mohon tunggu.
                </div>
            </div>

                {{-- Modal Konfirmasi Update --}}
                <flux:modal name="confirm-{{ $suratId }}" class="md:w-96">
                    <div class="space-y-6">
                        <flux:heading size="lg">Konfirmasi Perubahan Data</flux:heading>

                        <flux:text class="mt-2 mb-4">
                            <p>Apakah Anda yakin dengan perubahan data ini?</p>
                        </flux:text>

                        <div class="flex gap-2">
                            <flux:spacer />
                            <flux:button variant="primary" color="green" wire:click='update' wire:loading.attr="disabled" wire:target="update, file">Update</flux:button> {{-- Panggil metode 'update' --}}
                            <flux:modal.close>
                                <flux:button variant="danger" wire:click="$dispatch('close-modal', 'confirm-{{ $suratId }}')">Batal</flux:button> {{-- Tombol Batal --}}
                            </flux:modal.close>
                        </div>
                    </div>
                </flux:modal>
            </div>
        </div>
    </flux:modal>
</div>

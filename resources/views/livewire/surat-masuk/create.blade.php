<div>
    <flux:modal name="add-file" class="md:w-130">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Data</flux:heading>
            </div>

            <flux:input wire:model='nomor_surat' label="Nomor Surat" placeholder="XXX/AA/UDDPNK/MM/YYYY" />
            
            <flux:input wire:model='asal_surat' label="Asal Surat" placeholder="Instansi" />
            
            <flux:input wire:model='perihal' rows="2" label="Perihal" placeholder="Isi Perihal" />
            
            <div class="grid grid-cols-2 gap-4">
                
                <flux:input
                    datepicker
                    datepicker-autohide
                    id="tanggalmasuk" 
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
            
            <flux:input wire:model='file' type="file" label="Upload file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                <div wire:loading wire:target="file" class="text-sm text-blue-600 mt-2">
                    Mengunggah file... Mohon tunggu.
                </div>

            <div class="flex">
                <flux:modal.trigger name="confirm">
                    <flux:spacer />
                    <flux:button variant="primary" color="green">Simpan</flux:button>
                </flux:modal.trigger>
                
                <flux:modal name="confirm" class="md:w-96">
                    <div class="space-y-6">
                        <flux:heading size="lg">Apakah Data yang Anda Masukkan Sudah Benar?</flux:heading>

                        <flux:text class="mt-2 mb-4">
                            <p>Silakan periksa kembali sebelum menyimpan untuk menghindari kesalahan.</p>
                        </flux:text>

                        <div class="flex gap-2">
                            <flux:spacer />
                            <flux:button variant="primary" color="green" wire:click='save' wire:loading.attr="disabled"  wire:target="save, file">Simpan</flux:button>
                            <flux:modal.close>
                                <flux:button variant="danger" wire:close='confirm' >Batal</flux:button>
                            </flux:modal.close>
                        </div>
                    </div>
                </flux:modal>
            </div>
        </div>
    </flux:modal>
</div>

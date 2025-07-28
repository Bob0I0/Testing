<div>
    {{-- Pastikan nama modal unik berdasarkan $suratId --}}
    <flux:modal name="delete-{{ $suratId }}" class="md:w-150" title="Konfirmasi Hapus Data Surat Keluar">
        <flux:fieldset>
            <p class="text-lg text-gray-800 dark:text-gray-200">
                Apakah Anda yakin ingin menghapus surat dengan nomor: <strong>{{ $nomorSurat }}</strong>?
            </p>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                Tindakan ini tidak dapat dibatalkan.
            </p>

            <div class="flex justify-end gap-3 mt-6">
                <flux:modal.close>
                    <flux:button variant="danger" wire:close='delete' >Batal</flux:button>
                </flux:modal.close>
                
                <flux:button 
                    type="button" 
                    variant="danger" 
                    wire:click="delete" {{-- Ini memanggil metode delete() di komponen --}}
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove wire:target="delete">Hapus</span>
                    <span wire:loading wire:target="delete">Menghapus...</span>
                </flux:button>
            </div>
        </flux:fieldset>
    </flux:modal>
</div>
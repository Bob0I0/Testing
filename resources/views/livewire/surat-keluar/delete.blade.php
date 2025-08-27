<div>
    <flux:modal.trigger name="delete-{{ $suratId }}">
        <flux:button icon="trash" variant="subtle"></flux:button>
    </flux:modal.trigger>

    <flux:modal name="delete-{{ $suratId }}" class="md:w-100" title="Konfirmasi Hapus Data Surat Keluar">
        <div class="space-y-6">

            <flux:text variant="strong" class="mt-4 text-center text-base">
                <p><b class="font-extrabold">Apakah Anda Yakin Ingin</b></p> 
                <p><b class="font-extrabold">Menghapus Data Surat Ini?</b></p>
                <p class="text-sm mt-1">Surat dengan nomor <strong>{{ $nomorSurat }}</strong>
                <p class="text-sm">akan dihapus. Yakin melanjutkan?</p></p>
            </flux:text>

            <div class="grid grid-cols-2 gap-4">

                <flux:modal.close>  
                    <flux:button wire:click="delete" variant="primary" color="green" class="w-full">Hapus</flux:button>
                </flux:modal.close>
                <flux:modal.close>
                    <flux:button variant="primary" color="red" class="w-full">Batal</flux:button>
                </flux:modal.close>

            </div>
        </div>
    </flux:modal>
</div>
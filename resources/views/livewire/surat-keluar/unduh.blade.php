<div>
    <flux:modal name="download_SKeluar-{{ $suratId }}" class="min-w-[28rem]">
        <div class="space-y-4">
            <div>
                <flux:heading size="lg">    </flux:heading>

                <flux:text variant="strong" class="mt-6 text-center text-base">
                    <p><b class="font-extrabold">Apakah Anda Ingin</b></p>
                    <p><b class="font-extrabold">Mengunduh Surat Ini?</b></p> 
                </flux:text>
            </div>

            <div class="grid grid-cols-2 gap-4">

                <flux:button wire:click="download({{ $suratId }})" variant="primary" color="green" type="submit" class="w-full"> Unduh</flux:button>

                <flux:modal.close>
                    <flux:button variant="primary" color="red" class="w-full">Batal</flux:button>
                </flux:modal.close>

            </div>
        </div>
    </flux:modal>
</div>

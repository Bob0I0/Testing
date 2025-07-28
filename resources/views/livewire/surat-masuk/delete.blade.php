
{{-- Modal Konfirmasi Delete --}}
<flux:modal name="delete-{{ $suratKeluarId }}" class="md:w-96">
    <div class="space-y-6">
        <flux:heading size="lg" class="text-red-600">Konfirmasi Penghapusan</flux:heading>

        <flux:text class="mt-2 mb-4">
            <p>Apakah Anda yakin ingin menghapus surat dengan Nomor: {{ $nomorSurat }}? Tindakan ini tidak dapat dibatalkan.</p>
        </flux:text>

        <div class="grid grid-cols-2 items-end gap-4">
            {{-- Tombol "Hapus" yang memanggil metode delete di Livewire --}}
            {{-- Perhatikan tidak ada lagi ID yang dilewatkan ke wire:click karena ID sudah ada di $this->suratId --}}
            <flux:button variant="danger" wire:click="delete" wire:loading.attr="disabled" wire:target="delete">Hapus</flux:button>

            <flux:modal.close>
                <flux:button variant="danger" wire:close='delete' >Batal</flux:button>
            </flux:modal.close>
        </div>
    </div>
</flux:modal>
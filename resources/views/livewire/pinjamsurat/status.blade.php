<div x-data="{ showModal: false }">
    <!-- Tombol Pinjam / Selesai -->
    <flux:button 
        variant="primary"
        :color="$status == 'Pinjam' ? 'yellow' : 'emerald'"
        @click="if ('{{ $status }}' === 'Pinjam') showModal = true"
    >
        {{ $status }}
    </flux:button>

    <!-- Modal Confirm -->
    <div 
        x-show="showModal" 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        x-transition
    >
        <div class="bg-white p-6 rounded shadow-xl">
            <h2 class="text-lg font-semibold mb-4">Konfirmasi Peminjaman</h2>
            <p>Apakah Anda yakin ingin meminjam surat ini?</p>
            <div class="mt-4 flex gap-2">
                <button 
                    class="bg-green-500 text-white px-4 py-2 rounded"
                    wire:click="setStatusSelesai"
                    @click="showModal = false"
                >
                    Ya
                </button>
                <button 
                    class="bg-gray-400 text-white px-4 py-2 rounded"
                    @click="showModal = false"
                >
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

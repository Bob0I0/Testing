<div class="overflow-x-auto bg-white dark:bg-zinc-800 p-4 rounded-lg shadow-md">
    <flux:modal.trigger name="add-file">
        <flux:button variant="primary" color="cyan">Tambah Data</flux:button>
    </flux:modal.trigger>
    <livewire:surat-masuk.create />

    <div class="my-3"></div>
    <table class="table-fixed min-w-full border border-gray-300 text-sm">
        <thead class="bg-[#003634] text-white text-left">
            <tr>
                <th class="border px-3 py-1 w-12">No</th>
                <th class="border px-3 py-1 w-40">Nomor Surat</th>
                <th class="border px-3 py-1 w-48">Asal Surat</th>
                <th class="border px-3 py-1 w-32">Tanggal Surat</th>
                <th class="border px-3 py-1">Perihal</th>
                <th class="border px-3 py-1 w-36">Jenis Surat</th>
                <th class="border px-3 py-1 w-28 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suratMasuks as $surat)
                <tr>
                    <td class="border px-3 py-1 text-center">{{ $surat->id }}</td>
                    <td class="border px-3 py-1">{{ $surat->nomor_surat }}</td>
                    <td class="border px-3 py-1">{{ $surat->asal_surat }}</td>
                    <td class="border px-3 py-1">{{ $surat->tanggal_surat }}</td>
                    <td class="border px-3 py-1 break-words max-w-xs">{{ $surat->perihal }}</td>
                    <td class="border px-3 py-1">{{ $surat->jenis_surat }}</td>
                    <td class="border px-3 py-1">
                        <flux:button.group>
                                <flux:button icon="edit" variant="subtle" wire:click="$dispatch('openEditModal', { suratId: {{ $surat->id }} })"></flux:button>
                            <flux:modal.trigger name="delete-{{ $surat->id }}">
                                <flux:button icon="trash" variant="subtle"></flux:button>
                            </flux:modal.trigger>
                            <livewire:surat-masuk.delete :surat-id="$surat->id" :nomor-surat="$surat->nomor_surat" :key="$surat->id" />            
                            <flux:button href="#" icon="receive" variant="subtle"></flux:button>
                            
                        </flux:button.group>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-3 px-6 text-center">Tidak ada data surat masuk.</td>
                </tr>
            @endforelse
            @if ($editingSuratId)
                <livewire:surat-masuk.edit :id="$editingSuratId" :key="$editingSuratId" />
            @endif
            {{ $suratMasuks->links() }}
        </tbody>
    </table>
    <flux:spacer></flux:spacer>
    <nav aria-label="Page navigation example">
    <ul class="inline-flex -space-x-px text-sm">
        <li>
        <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
        </li>
        <li>
        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
        </li>
        <li>
        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
        </li>
    </ul>
    </nav>
</div>


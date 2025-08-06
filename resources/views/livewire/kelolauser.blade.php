
<x-layouts.app :title="__('Kelola User')">
    <flux:input placeholder="Cari Berdasarkan Username" icon="magnifying-glass" type="text" name="search" wire:model.live.debounc.450mse="#" class="w-full text-lg shadow-sm rounded-xl mb-4"/>
    <div class="card flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="card-header">
            <h1 class="text-2xl font-semibold">{{ __('Kelola User') }}</h1>
        </div>

        <div class="card-body my-3">
        <table class="table-fixed min-w-full border border-gray-300 text-sm">
            <thead class="bg-cyan-900 text-white text-left">
                <tr>
                    <th class="border px-3 py-1 w-12">No</th>
                    <th class="border px-3 py-1 w-80">Nama Lengkap</th>
                    <th class="border px-3 py-1 w-80">Username</th>
                    <th class="border px-3 py-1 w-60">Password</th>
                    <th class="border px-3 py-1 w-30">Level</th>
                    <th class="border px-3 py-1 w-28 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-3 py-4"></td>
                    <td class="border px-3 py-4"></td>
                    <td class="border px-3 py-4"></td>
                    <td class="border px-3 py-4"></td>
                    <td class="border px-3 py-4"></td>
                    <td class="border px-3 py-4"></td>
                    {{-- BUTTON 
                    <td class="border px-3 py-1">
                        <flux:button.group>
                            <flux:button icon="edit" variant="subtle"></flux:button>
                            <flux:modal.trigger name="delete">
                                <flux:button icon="trash" variant="subtle"></flux:button>
                            </flux:modal.trigger>
                        </flux:button.group>
                    </td> --}}
                </tr>
                
            </tbody>
        </table>
        <div class="mt-5">
            <p>#Pagi</p>{{-- {{ $this->datakeluar->links('vendor.pagination.custom-pagi') }} --}}
        </div>
    </div>
</x-layouts.app>

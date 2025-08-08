<div>
    
    <flux:input placeholder="Cari Berdasarkan Username" icon="magnifying-glass" type="text" name="search" wire:model.live.debounc.450mse="#" class="w-full text-lg shadow-sm rounded-xl mb-4"/>
    
    <div class="card flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        
        <div class="card-header">
            <h1 class="text-2xl font-semibold">{{ __('Kelola User') }}</h1>
        </div>
        
        <div class="overflow-x-auto bg-white dark:bg-zinc-800 p-4 rounded-xl shadow-sm border">
            <div class="card-body my-3">
                
                <livewire:kelolauser.create />

                <table class="table-fixed min-w-[2/3] border border-gray-300 text-sm my-3">
                    <thead class="bg-cyan-900 text-white text-left">
                        <tr>
                            <th class="border px-3 py-1 w-12">No</th>
                            <th class="border px-3 py-1 w-80">Nama Lengkap</th>
                            <th class="border px-3 py-1 w-80">Username</th>
                            <th class="border px-3 py-1 w-30">Level</th>
                            <th class="border px-3 py-1 w-28 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->datauser as $key => $user)
                        <tr>
                            <td class="border px-3 py-1 w-12">{{ $this->datauser->firstItem() + $key }}</td>
                            <td class="border px-3 py-1 w-80">{{ $user->name }}</td>
                            <td class="border px-3 py-1 w-80">{{ $user->username }}</td>
                            <td class="border px-3 py-1 w-30">Level</td>
                            <td class="border px-3 py-1">
                                <flux:button.group>
                                    <flux:button icon="edit" variant="subtle"></flux:button>

                                    <flux:modal.trigger name="delete">
                                        <flux:button icon="trash" variant="subtle"></flux:button>
                                    </flux:modal.trigger>
                                    
                                </flux:button.group>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="border px-3 py-4"></td>
                            <td class="border px-3 py-4"></td>
                            <td class="border px-3 py-4"></td>
                            <td class="border px-3 py-4"></td>
                            <td class="border px-3 py-4"></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-5">
                    {{ $this->datauser->links('vendor.pagination.custom-pagi') }}
                </div>
            </div>
        </div>
    </div>
</div>

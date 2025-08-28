<div>
    <div class="card-header">
        <h1 class="text-2xl font-semibold">{{ __('Kelola Perizinan Level') }}</h1>
    </div>
    <div class="overflow-x-auto bg-white dark:bg-zinc-700 p-4 rounded-xl shadow-sm my-6">
        <div class="card-body my-3">

            <livewire:izin.create />

            <table class="table-fixed min-w-[2/3] border border-gray-300 dark:bg-zinc-600 text-sm my-3">
                <thead class="bg-cyan-900 text-white text-left">
                    <tr class="text-zinc-50">
                        <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-12 text-center">No</th>
                        <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-30">Level</th>
                        <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-160">Perizinan</th>
                        <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-28 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $key => $role)
                    <tr class="text-zinc-900 dark:text-zinc-50" wire:key="user-{{ $role->id }}">
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-2 w-12 text-center">{{ $roles->firstItem() + $key }}</td>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-2 w-30">{{ $role->name }}</td>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-2 w-160">
                            @if ($role->permissions)
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($role->permissions as $permission)
                                        <flux:badge size='sm' color='lime'>{{$permission->name}}</flux:badge>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-28"> 
                            <flux:button.group>
                                <livewire:izin.edit :izin-id="$role->id" :key="'edit-form-'.$role->id" />
                                <livewire:izin.delete :izin-id="$role->id" :name="$role->name" :key="'delete-'.$role->id" />
                            </flux:button.group>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="border px-3 py-4"></td>
                        <td class="border px-3 py-4"></td>
                        <td class="border px-3 py-4"></td>
                        <td class="border px-3 py-4"></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-5">
                {{ $roles->links('vendor.pagination.custom-pagi') }}
            </div>
        </div>
    </div>
</div>

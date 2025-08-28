<div>
    <!-- Modal toggle -->
    <flux:button data-modal-target="createuser" data-modal-toggle="createuser" variant="primary" color="cyan">
    Tambah Data
    </flux:button>

    <!-- Main modal -->
    <div wire:ignore.self id="createuser" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5">
                    
                    <flux:heading size="xl" level="1" variant="strong">
                        <strong>{{ __('Tambah Data Pengguna') }}</strong>
                    </flux:heading>

                    <flux:button wire:click="resetForm" icon="X" variant="subtle" data-modal-toggle="createuser">
                    </flux:button>

                </div>

                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form wire:submit="createacc" class="flex flex-col gap-6">
                        <!-- Name -->
                        <flux:input
                            wire:model="name"
                            :label="__('Nama Lengkap')"
                            type="text"
                            required
                            autofocus
                            autocomplete="name"
                            :placeholder="__('Full name')"
                        />

                        <!-- Email Address -->
                        <flux:input
                            wire:model="username"
                            :label="__('Username')"
                            type="text"
                            required
                            autocomplete="username"
                            placeholder="Username"
                        />
                        
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Password -->
                            <flux:input
                                wire:model="password"
                                :label="__('Password')"
                                type="password"
                                required
                                autocomplete="new-password"
                                :placeholder="__('Password')"
                                viewable
                            />

                            <!-- Confirm Password -->
                            <flux:input
                                wire:model="password_confirmation"
                                :label="__('konfirmasi password')"
                                type="password"
                                required
                                autocomplete="new-password"
                                :placeholder="__('konfirmasi password')"
                                viewable
                            />
                        </div>
                        <flux:field>
                            <flux:label>Level</flux:label>
                            <flux:select wire:model="#" :chevron="false" placeholder="Choose industry...">
                                <flux:select.option>Photography</flux:select.option>
                                <flux:select.option>Design services</flux:select.option>
                                <flux:select.option>Web development</flux:select.option>
                            </flux:select>
                        </flux:field>

                        <!-- Confirmation -->
                        <div class="flex items-center justify-end">
                            <flux:modal.trigger name="persetujuanuser">
                                <flux:spacer />
                                <flux:button variant="primary" color="green" class="w-[50%]" type="button" >Simpan</flux:button>
                            </flux:modal.trigger>
                            
                            <flux:modal name="persetujuanuser" class="md:w-96">
                                <div class="space-y-6">
                                    <flux:text variant="strong" class="mt-4 text-center text-base">
                                        <p><b class="font-extrabold">Apakah Data yang Anda</b></p> 
                                        <p><b class="font-extrabold">Masukkan Sudah Benar?</b></p>
                                        <p class="text-sm">Silakan periksa kembali sebelum</p>
                                        <p class="text-sm">menyimpan untuk menghindari kesalahan.</p>
                                    </flux:text>

                                    <div class="grid grid-cols-2 gap-4">
                                        <flux:modal.close>
                                            <flux:button variant="primary" color="green" type="submit" class="w-full" data-modal-toggle="createuser">Simpan</flux:button>
                                        </flux:modal.close>    
                                        <flux:modal.close>                                    
                                            <flux:button variant="danger" wire:close="persetujuan" type="button" class="w-full">Batal</flux:button>
                                        </flux:modal.close>
                                    </div>
                                </div>
                            </flux:modal>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    @include("components.flash-messages")
</div>
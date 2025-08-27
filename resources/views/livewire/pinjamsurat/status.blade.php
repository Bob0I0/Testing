{{-- <div x-data="{ showModal: false }"> --}}
    <!-- Tombol Pinjam / Selesai -->
<div>
    <flux:button
        data-modal-target="status"
        data-modal-toggle="{{ $status == 'Pinjam' ? 'status' : '' }}"
        variant="primary" size="sm"
        :color="$status == 'Pinjam' ? 'yellow' : 'emerald'"
    >{{ $status }}
    </flux:button>

    <!-- Main modal -->
    <div wire:ignore.self id="status" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-800">
                
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5">
    
                    <flux:heading size="xl" level="1" variant="strong">
                        <strong>{{ __('Tanggal Pengambalian Surat') }}</strong>
                    </flux:heading>

                    <flux:button wire:click="resetForm" icon="X" variant="subtle" data-modal-toggle="status">
                    </flux:button>
                    
                </div>
                <div class="p-4 md:p-5">
                    <form wire:submit.prevent="updatekembali" class="space-y-4" method="POST">
                        @csrf
                        <flux:field>
                            <flux:label>Tanggal Kembali</flux:label>
                            <flux:input class:input="form-control dateee" icon:trailing="calendar" wire:model.blur="form.tanggal_kembali" type="text" placeholder="dd-mm-yyyy"/>
                            <flux:error name="form.tanggal_kembali" />
                        </flux:field>
                        <flux:modal.trigger name="delete-profile">
                            <flux:button variant="danger">Delete</flux:button>
                        </flux:modal.trigger>

                        <flux:modal name="delete-profile" class="min-w-[22rem]">
                            <div class="space-y-6">
                                <div>
                                    <flux:heading size="lg">Delete project?</flux:heading>

                                    <flux:text class="mt-2">
                                        <p>You're about to delete this project.</p>
                                        <p>This action cannot be reversed.</p>
                                    </flux:text>
                                </div>

                                <div class="flex gap-2">
                                    <flux:spacer />

                                    <flux:modal.close>
                                        <flux:button variant="ghost">Cancel</flux:button>
                                    </flux:modal.close>

                                    <flux:button type="submit" variant="danger">Delete project</flux:button>
                                </div>
                            </div>
                        </flux:modal>
                        <!-- Confirmation -->
                        <div class="flex items-center justify-end">
                            
                            <flux:modal.trigger name="persetujuankembali">
                                <flux:spacer />
                                <flux:button variant="primary" color="green" class="w-[40%]" type="button" >Simpan</flux:button>
                            </flux:modal.trigger>
                            
                            <flux:modal name="persetujuankembali" class="md:w-96">
                                <div class="space-y-6">
                                    <flux:text variant="strong" class="mt-4 text-center text-base">
                                        <p><b class="font-extrabold">Apakah Data yang Anda</b></p> 
                                        <p><b class="font-extrabold">Masukkan Sudah Benar?</b></p>
                                        <p class="text-sm">Silakan periksa kembali sebelum</p>
                                        <p class="text-sm">menyimpan untuk menghindari kesalahan.</p>
                                    </flux:text>

                                    <div class="grid grid-cols-2 gap-4">
                                        <flux:modal.close>
                                            <flux:button variant="primary" color="green" type="submit" class="w-full">Simpan</flux:button>
                                        </flux:modal.close>    
                                        <flux:modal.close>                                    
                                            <flux:button variant="danger" wire:close="persetujuankembali" type="button" class="w-full">Batal</flux:button>
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

    <!-- Modal Confirm -->
    {{-- <div 
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
    </div> --}}
</div>
@script
<script type="text/javascript">
    $('.dateee').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        // todayHighlight: true,
        language: 'id' 
    }).on('changeDate', function(e) {
        @this.set("form.tanggal_kembali", e.target.value);
    });
</script>
@endscript

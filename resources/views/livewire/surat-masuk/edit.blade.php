<div>
    <!-- Main modal -->
    <div wire:ignore.self name="editSM-{{ $suratMasukId }}" id="editSM-{{ $suratMasukId }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-500 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5">
                    
                    <flux:heading size="xl" level="1" variant="strong">
                        <strong>{{ __('Edit Data Surat Masuk') }}</strong>
                    </flux:heading>

                    <flux:button wire:click="form.resetForm" icon="X" variant="subtle" data-modal-toggle="editSM-{{ $suratMasukId }}">
                    </flux:button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form wire:submit.prevent="update" class="space-y-4" method="POST">
                        @csrf
                        <flux:input wire:model.blur='form.nomor_surat' label="Nomor Surat" placeholder="XXX/AA/UDDPNK/MM/YYYY" />
                        <div>@error('form.nomor_surat') <span class="error"></span> @enderror</div>
                        
                        <flux:input wire:model.blur='form.asal_surat' label="Asal Surat" placeholder="Instansi" />
                        <div>@error('form.asal_surat') <span class="error"></span> @enderror</div>

                        <flux:input wire:model.blur='form.perihal' rows="2" label="Perihal" placeholder="Isi Perihal" />
                        <div>@error('form.perihal') <span class="error"></span> @enderror</div>

                        <div class="grid grid-cols-2 gap-4">
                            
                            <flux:field >
                                <flux:label>Tanggal Masuk</flux:label>
                                <flux:input class:input="form-control dateee" icon:trailing="calendar" wire:model.blur="form.tanggal_surat" type="text" placeholder="dd-mm-yyyy"/>
                                <flux:error name="form.tanggal_surat" />
                            </flux:field>
                            
                            <flux:input wire:model.blur='form.jenis_surat' label="Jenis Surat" placeholder="Jenis Surat" />
                            <div>@error('form.jenis_surat') <span class="error"></span> @enderror</div>
                        </div>
                        <flux:field>
                            <flux:label>Upload File</flux:label>
                            <input wire:loading.class="opacity-50" wire:loading.attr="disabled" wire:model.live='form.file' class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file" type="file">
                            <flux:error name="form.file" />
                        </flux:field>
                        @if ($form->existing_file_path) {{-- Periksa properti existing_file_path --}}
                            <p class="text-sm text-gray-600 dark:text-gray-400">File saat ini: 
                                <a href="{{ Storage::url($form->existing_file_path) }}" target="_blank" class="text-blue-500 hover:underline">
                                    {{ $form->original_file_name ?? basename($form->existing_file_path) }} 
                                </a>
                            </p>
                        @endif
                        <!-- Modal Confirmation -->
                        <div class="flex">
                            <flux:modal.trigger name="persetujuan_editSM-{{ $suratMasukId }}">
                                <flux:spacer />
                                <flux:button variant="primary" color="green" type="button">Simpan</flux:button>
                            </flux:modal.trigger>
                            
                            <flux:modal name="persetujuan_editSM-{{ $suratMasukId }}" class="md:w-96">
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
                                            <flux:button variant="danger" wire:close="persetujuan_editSM-{{ $suratMasukId }}" class="w-full">Batal</flux:button>
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

</div>
@script
<script type="text/javascript">
    $('.dateee').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        // todayHighlight: true,
        language: 'id' 
    }).on('changeDate', function(e) {
        @this.set("form.tanggal_surat", e.target.value);
    });
</script>
@endscript
<div>
    <!-- Modal toggle -->
    <flux:button data-modal-target="create" data-modal-toggle="create" variant="primary" color="cyan">
    Tambah Data
    </flux:button>

    <!-- Main modal -->
    <div wire:ignore.self id="create" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5">
                    
                    <flux:heading size="xl" level="1" variant="strong">
                        <strong>{{ __('Tambah Data Surat Keluar') }}</strong>
                    </flux:heading>

                    <flux:button wire:click="resetForm" icon="X" variant="subtle" data-modal-toggle="create">
                    </flux:button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form wire:submit.prevent="simpan" class="space-y-4" method="POST">
                        @csrf
                        <flux:input wire:model.blur='form.nomor_surat' label="Nomor Surat" placeholder="XXX/AA/UDDPNK/MM/YYYY" />
                        <div>@error('form.nomor_surat') <span class="error"></span> @enderror</div>
                        
                        <flux:input wire:model.blur='form.tujuan_surat' label="Tujuan Surat" placeholder="Instansi" />
                        <div>@error('form.tujuan_surat') <span class="error"></span> @enderror</div>

                        <flux:input wire:model='form.perihal' rows="2" label="Perihal" placeholder="Isi Perihal" />
                        <div>@error('form.perihal') <span class="error"></span> @enderror</div>

                        <div class="grid grid-cols-2 gap-4">
                            
                            <flux:field >
                                <flux:label>Tanggal Masuk</flux:label>
                                <flux:input class:input="form-control dateee" icon:trailing="calendar" wire:model="form.tanggal_surat" type="text" placeholder="dd-mm-yyyy"/>
                                <flux:error name="form.tanggal_surat" />
                            </flux:field>
                            {{-- @error('form.tanggal_surat') <span class="error"></span> @enderror--}}
                            
                            <flux:input wire:model.blur='form.jenis_surat' label="Jenis Surat" placeholder="Jenis Surat" />
                            <div>@error('form.jenis_surat') <span class="error"></span> @enderror</div>
                        </div>
                        <flux:field>
                            <flux:label>Upload File</flux:label>        
                            {{-- <label class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white" for="file">Upload file</label> --}}
                            <input wire:loading.class="opacity-50" wire:loading.attr="disabled" wire:model.live='form.file' class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file" type="file">
                            <flux:error name="form.file" />
                            {{-- <div>@error('form.file') <span class="error"></span> @enderror</div> --}}
                        </flux:field>
                        <!-- Modal Confirmation -->
                        <div class="flex">
                            <flux:modal.trigger name="persetujuan">
                                <flux:spacer />
                                <flux:button variant="primary" color="green" type="button">Simpan</flux:button>
                            </flux:modal.trigger>
                            
                            <flux:modal name="persetujuan" class="md:w-96">
                                <div class="space-y-6">

                                    <flux:heading size="lg">Apakah Data yang Anda Masukkan Sudah Benar?</flux:heading>
                                    <flux:text class="mt-2 mb-4">
                                        <p>Silakan periksa kembali sebelum menyimpan untuk menghindari kesalahan.</p>
                                    </flux:text>

                                    <div class="flex gap-2">
                                        <flux:spacer />
                                        <flux:modal.close>
                                            <flux:button variant="primary" color="green" type='submit'>Simpan</flux:button>                                        
                                            <flux:button variant="danger" wire:close='persetujuan' >Batal</flux:button>
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
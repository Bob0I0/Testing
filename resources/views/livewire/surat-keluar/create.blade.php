<div>
    <!-- Modal toggle -->
    <flux:button data-modal-target="create" data-modal-toggle="create" variant="primary" color="cyan">
    Tambah Data
    </flux:button>

    <!-- Main modal -->
    <div wire:ignore.self id="create" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
                        <!-- Modal Confirmation -->
                        <div class="flex">
                            <flux:modal.trigger name="persetujuan">
                                <flux:spacer />
                                <flux:button variant="primary" color="green" type="button">Simpan</flux:button>
                            </flux:modal.trigger>
                            
                            <flux:modal name="persetujuan" class="md:w-96">
                                <div class="space-y-6">
                                    <flux:text variant="strong" class="mt-4 text-center text-base">
                                        <p><b class="font-extrabold">Apakah Data yang Anda</b></p> 
                                        <p><b class="font-extrabold">Masukkan Sudah Benar?</b></p>
                                        {{-- <p class="text-sm mt-1">Surat dengan nomor <strong>{{ $nomorSurat }}</strong> --}}
                                        <p class="text-sm">Silakan periksa kembali sebelum</p>
                                        <p class="text-sm">menyimpan untuk menghindari kesalahan.</p>
                                    </flux:text>

                                    <div class="grid grid-cols-2 gap-4">
                                        <flux:modal.close>
                                            <flux:button variant="primary" color="green" type="submit" class="w-full">Simpan</flux:button>
                                        </flux:modal.close>    
                                        <flux:modal.close>                                    
                                            <flux:button variant="danger" wire:close="persetujuan" type="button" class="w-full">Batal</flux:button>
                                        </flux:modal.close>
                                    </div>
                                </div>
                            </flux:modal>
                        </div>
                        {{-- @session('berhasil')
                            <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800" role="alert">
                                <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                    </svg>
                                    <span class="sr-only">Check icon</span>
                                </div>
                                <div class="ms-3 text-sm font-normal">Item moved successfully.</div>
                                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                </button>
                            </div>
                        @endsession --}}
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
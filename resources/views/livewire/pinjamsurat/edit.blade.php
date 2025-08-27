<div>
    <!-- Main modal -->
    <div wire:ignore.self name="editPS-{{ $pinjamSuratId }}" id="editPS-{{ $pinjamSuratId }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-500 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5">
                    
                    <flux:heading size="xl" level="1" variant="strong">
                        <strong>{{ __('Edit Data Surat Masuk') }}</strong>
                    </flux:heading>

                    <flux:button wire:click="form.resetForm" icon="X" variant="subtle" data-modal-toggle="editPS-{{ $pinjamSuratId }}">
                    </flux:button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form wire:submit.prevent="update" class="space-y-4" method="POST">
                        @csrf
                        <flux:input wire:model.blur='form.nomor_surat' label="Nomor Surat" placeholder="XXX/AA/UDDPNK/MM/YYYY" />
                        <div>@error('form.nomor_surat') <span class="error"></span> @enderror</div>
                        
                        <flux:input wire:model.blur='form.nama_peminjam' label="Nama Peminjam" placeholder="Instansi" />
                        <div>@error('form.nama_peminjam') <span class="error"></span> @enderror</div>

                        <flux:input wire:model.blur='form.perihal' rows="2" label="Perihal" placeholder="Isi Perihal" />
                        <div>@error('form.perihal') <span class="error"></span> @enderror</div>

                        <div class="grid grid-cols-2 gap-4">
                            
                            <flux:field >
                                <flux:label>Tanggal Pinjam</flux:label>
                                <flux:input class:input="form-control datepinjam" icon:trailing="calendar" wire:model.blur="form.tanggal_pinjam" type="text" placeholder="dd-mm-yyyy"/>
                                <flux:error name="form.tanggal_pinjam" />
                            </flux:field>

                            <flux:field >
                                <flux:label>Tanggal Kembali</flux:label>
                                <flux:input class:input="form-control datekembali" icon:trailing="calendar" wire:model.blur="form.tanggal_kembali" type="text" placeholder="dd-mm-yyyy"/>
                                <flux:error name="form.tanggal_kembali" />
                            </flux:field>
                        </div>
                        <!-- Modal Confirmation -->
                        <div class="flex">
                            <flux:modal.trigger name="persetujuan_editSM-{{ $pinjamSuratId }}">
                                <flux:spacer />
                                <flux:button variant="primary" color="green" type="button">Simpan</flux:button>
                            </flux:modal.trigger>
                            
                            <flux:modal name="persetujuan_editSM-{{ $pinjamSuratId }}" class="md:w-96">
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
                                            <flux:button variant="danger" wire:close="persetujuan_editSM-{{ $pinjamSuratId }}" class="w-full">Batal</flux:button>
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
    $('.datepinjam').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        // todayHighlight: true,
        language: 'id' 
    }).on('changeDate', function(e) {
        @this.set("form.tanggal_pinjam", e.target.value);
    });
    $('.datekembali').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        // todayHighlight: true,
        language: 'id' 
    }).on('changeDate', function(e) {
        @this.set("form.tanggal_kembali", e.target.value);
    });
</script>
@endscript
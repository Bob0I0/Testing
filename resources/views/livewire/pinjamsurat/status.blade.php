<div>
    <flux:button
        data-modal-target="status-{{ $pinjamSuratId }}"
        data-modal-toggle="{{ $status == 'Pinjam' ? 'status-'.$pinjamSuratId : 'null' }}"
        variant="primary" size="sm"
        :color="$status == 'Pinjam' ? 'yellow' : 'emerald'"
    >
        {{ $status }}
    </flux:button>


    <div wire:ignore.self id="status-{{ $pinjamSuratId }}" tabindex="-1" 
         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-800">
                
                <div class="flex items-center justify-between p-4 md:p-5">
                    <flux:heading size="xl" level="1" variant="strong">
                        <strong>{{ __('Tanggal Pengembalian Surat') }}</strong>
                    </flux:heading>

                    <flux:button wire:click="resetForm" icon="X" variant="subtle" 
                        data-modal-toggle="status-{{ $pinjamSuratId }}">
                    </flux:button>
                </div>

                <div class="p-4 md:p-5">
                    <form wire:submit.prevent="updateKembali" class="space-y-4">
                        <flux:field>
                            <flux:label>Tanggal Kembali</flux:label>
                            <flux:input class:input="form-control dateee" icon:trailing="calendar" 
                                wire:model="form.tanggal_kembali" type="text" placeholder="dd-mm-yyyy"/>
                            <flux:error name="form.tanggal_kembali" />
                        </flux:field>

                        <div class="flex items-center justify-end">
                            <flux:modal.trigger name="persetujuankembali-{{ $pinjamSuratId }}">
                                <flux:spacer />
                                <flux:button variant="primary" color="green" class="w-[40%]" type="button">Simpan</flux:button>
                            </flux:modal.trigger>

                            <flux:modal name="persetujuankembali-{{ $pinjamSuratId }}" class="md:w-96">
                                <div class="space-y-6">
                                    <flux:text variant="strong" class="mt-4 text-center text-base">
                                        <p><b class="font-extrabold">Apakah Data yang Anda</b></p> 
                                        <p><b class="font-extrabold">Masukkan Sudah Benar?</b></p>
                                        <p class="text-sm">Silakan periksa kembali sebelum</p>
                                        <p class="text-sm">menyimpan untuk menghindari kesalahan.</p>
                                    </flux:text>

                                    <div class="grid grid-cols-2 gap-4">
                                        <flux:modal.close>
                                            <flux:button variant="primary" color="green" type="submit" class="w-full" data-modal-toggle="persetujuankembali-{{ $pinjamSuratId }}">Simpan</flux:button>
                                        </flux:modal.close>    
                                        <flux:modal.close>                                    
                                            <flux:button variant="danger" type="button" class="w-full">Batal</flux:button>
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
        language: 'id' 
    }).on('changeDate', function(e) {
        @this.set("form.tanggal_kembali", e.target.value);
    });
</script>
@endscript

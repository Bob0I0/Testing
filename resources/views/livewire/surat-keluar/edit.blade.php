<div>
    <flux:modal name="edit-{{ $suratKeluarId }}" class="md:w-150" title="Edit Data Surat Keluar">
        <flux:fieldset>
            {{-- wire:submit.prevent menunjuk ke metode update di komponen Edit.php --}}
            <form wire:submit.prevent="update">
                <div class="space-y-4">
                    <flux:heading size="xl" level="2" variant="strong">
                        <strong>{{ __('Edit Data Surat Keluar') }}</strong>
                    </flux:heading>

                    {{-- Ubah wire:model='nomor_surat' menjadi wire:model='form.nomor_surat' --}}
                    <flux:input wire:model='form.nomor_surat' label="Nomor Surat" placeholder="XXX/AA/UDDPNK/MM/YYYY" />
                    <div>
                        @error('form.nomor_surat') <span class="text-red-500 text-xs"></span> @enderror
                    </div>

                    <flux:input wire:model='form.tujuan_surat' label="Tujuan Surat" placeholder="Instansi" />
                    <div>
                        @error('form.tujuan_surat') <span class="text-red-500 text-xs"></span> @enderror
                    </div>

                    <flux:input wire:model='form.perihal' rows="2" label="Perihal" placeholder="Isi Perihal" />
                    <div>
                        @error('form.perihal') <span class="text-red-500 text-xs"></span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <flux:input
                            datepicker
                            datepicker-autohide
                            datepicker-orientation="top right"
                            id="tanggal_surat-{{ $suratKeluarId }}"
                            type="text"
                            icon:trailing="calendar"
                            class="inline-block"
                            placeholder="dd/mm/yyyy"
                            wire:model="form.tanggal_surat" {{-- Ubah ke form.tanggal_surat --}}
                            label="Tanggal Surat"
                        />
                        

                        <flux:input wire:model='form.jenis_surat' label="Jenis Surat" placeholder="Jenis Surat" />
                        <div>
                            @error('form.jenis_surat') <span class="text-red-500 text-xs"></span> @enderror
                        </div>
                    </div>

                    <flux:input wire:model='form.file' type="file" label="Upload file baru (kosongkan jika tidak diubah)" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                    @if ($form->existing_file) {{-- Akses existing_file dari form object --}}
                        <p class="text-sm text-gray-600 dark:text-gray-400">File saat ini: <a href="{{ Storage::url(str_replace('public/', '', $form->existing_file)) }}" target="_blank" class="text-blue-500 hover:underline">{{ basename($form->existing_file) }}</a></p>
                    @endif
                    <div wire:loading wire:target="form.file" class="text-sm text-blue-600 mt-2">
                        Mengunggah file... Mohon tunggu.
                    </div>
                    <div>
                        @error('form.file') <span class="text-red-500 text-xs"></span> @enderror
                    </div>

                    <div class="flex">
                        <flux:spacer />
                        <flux:button type="submit" variant="primary" color="green">Simpan Perubahan</flux:button>
                        <flux:button variant="danger" wire:close='edit-{{ $suratKeluarId }}'>Batal</flux:button>
                    </div>
                </div>
            </form>
        </flux:fieldset>
    </flux:modal>
</div>
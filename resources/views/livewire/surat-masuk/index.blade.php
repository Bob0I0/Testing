<div>
    <!-- Searchbar -->
    <flux:input placeholder="Cari Berdasarkan Nomor Surat" icon="magnifying-glass" type="text" name="search" wire:model.live.debounce.300ms="search" class="w-full text-lg shadow-sm rounded-xl mb-4"/>
    
    <!-- Heading -->
    <div class="relative mb-4 w-full">
        <flux:heading size="xl" level="1" variant="strong">
            <strong>{{ __('Data Surat Masuk') }}</strong>
        </flux:heading>
    </div>

    <!-- Filter Tanggal -->
    <div class="card">
        <div class="card-header">
            <div class="rounded-xl bg-white dark:bg-zinc-700 p-4 shadow-sm">
                <div class="grid grid-cols-7 items-end gap-4">
                    {{-- Kolom 1-2: Tanggal Awal (mengambil 2 kolom dari 6) --}}
                    <div class="col-span-2 flex items-center gap-2">
                        <label for="tanggal_awal" class="font-medium">Tanggal Awal</label>
                        <flux:field>
                            <flux:input 
                                icon:trailing="calendar"
                                id="tanggal_awal" 
                                type="text" 
                                placeholder="dd-mm-yyyy"
                                wire:model="tanggalAwal"
                                class="dark:bg-zinc-600 rounded"
                                class:input="dateAwal"
                            />
                            <flux:error name="tanggalAwal" />
                        </flux:field>
                    </div>

                    <div class="col-span-1"></div>
                    {{-- Kolom 3-4: Tanggal Akhir (mengambil 2 kolom dari 6) --}}
                    <div class="col-span-2 flex items-center gap-2">
                        <label for="tanggal_akhir" class="font-medium">Tanggal Akhir</label>
                        <flux:field>
                            <flux:input 
                                icon:trailing="calendar"
                                id="tanggal_akhir" 
                                type="text" 
                                placeholder="dd-mm-yyyy"
                                wire:model="tanggalAkhir"
                                class="dark:bg-zinc-600 rounded"
                                class:input="dateAkhir"
                            />
                            <flux:error name="tanggalAkhir" />
                        </flux:field>
                    </div>
                    
                    {{-- Kolom 6: Tombol Cari Surat (mengambil 1 kolom dari 6) --}}
                    <div class="col-span-1 flex justify-end">
                        <flux:button 
                            variant="danger"
                            class="w-full h-auto py-2.5" 
                            wire:click="resetFilter"
                        >
                            Reset
                        </flux:button>
                    </div>
                    {{-- Kolom 6: Tombol Cari Surat (mengambil 1 kolom dari 6) --}}
                    <div class="col-span-1 flex justify-end">
                        <flux:button 
                            variant="primary" color="cyan"
                            class="w-full h-auto py-2.5" 
                            wire:click="cariSurat"
                        >
                            Cari Surat
                        </flux:button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <!-- Table Index -->
    <div class="overflow-x-auto my-3 bg-white dark:bg-zinc-700 p-4 rounded-xl shadow-sm">
        <livewire:surat-masuk.create />
        <table class="table-fixed min-w-full my-3 border border-gray-300 dark:bg-zinc-600 text-sm">
            <thead class="bg-cyan-900 text-white text-left">
                <tr class="text-zinc-50">
                    <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-12">No</th>
                    <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-40">Nomor Surat</th>
                    <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-48">Tujuan Surat</th>
                    <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-32">Tanggal Surat</th>
                    <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1">Perihal</th>
                    <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-36">Jenis Surat</th>
                    <th class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 w-28 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($this->SuratMasukIndex as $key => $surat)
                    <tr class="text-zinc-900 dark:text-zinc-50" wire:key="surat-{{ $surat->id }}">
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 text-center">{{ $this->SuratMasukIndex->firstItem() + $key }}</td>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1">{{ $surat->nomor_surat }}</td>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1">{{ $surat->asal_surat }}</td>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1">{{ $surat->tanggal_surat->format('d-m-Y') }}</td>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1 break-words max-w-xs">{{ $surat->perihal }}</td>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1">{{ $surat->jenis_surat }}</td>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-1">
                            <flux:button.group>
                                    <livewire:surat-masuk.edit :surat-id="$surat->id" :key="'edit-form-'.$surat->id" />
                                    <livewire:surat-masuk.delete :surat-id="$surat->id" :nomor-surat="$surat->nomor_surat" :key="'delete-'.$surat->id" />
                                    <livewire:surat-masuk.unduh :surat-id="$surat->id" :nomor-surat="$surat->nomor_surat" :key="'unduh-'.$surat->id"/>
                            </flux:button.group>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-4"></td>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-4"></td>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-4"></td>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-4"></td>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-4"></td>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-4"></td>
                        <td class="border border-zinc-300 dark:border-zinc-400 px-3 py-4"></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-5">
            {{ $this->SuratMasukIndex->links('vendor.pagination.custom-pagi') }}
        </div>
    </div> 

</div>
@script
<script type="text/javascript">
    $('.dateAwal').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        // todayHighlight: true,
        language: 'id' 
    }).on('changeDate', function(e) {
        @this.set("tanggalAwal", e.target.value);
    });
    $('.dateAkhir').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        // todayHighlight: true,
        language: 'id' 
    }).on('changeDate', function(e) {
        @this.set("tanggalAkhir", e.target.value);
    });
</script>
@endscript
<div>
    <flux:field>
        <flux:label>{{ $label }}</flux:label>
        <flux:input
            class:input="form-control datepicker-input" {{-- Beri kelas unik di sini --}}
            icon:trailing="calendar"
            wire:model.blur="{{ $model }}" {{-- Binding ke properti model --}}
            type="text"
            placeholder="{{ $placeholder }}"
            x-data="{}" {{-- Tambahkan x-data untuk Alpine.js --}}
            x-init="
                // Inisialisasi datepicker di sini
                // Pastikan jQuery dan Bootstrap Datepicker dimuat secara global
                $nextTick(() => {
                    $('.datepicker-input').datepicker({
                        format: 'dd-mm-yyyy',
                        autoclose: true,
                        language: 'id' 
                    }).on('changeDate', function(e) {
                        // Dispatch event Livewire ke komponen ini
                        $wire.set('{{ $model }}', e.target.value);
                    });
                });
            "
        />
        <flux:error name="{{ str_replace('.', '_', $model) }}" /> {{-- Sesuaikan validasi error jika perlu --}}
    </flux:field>
</div>
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
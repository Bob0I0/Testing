<div>
    <flux:modal.trigger name="edit-profile">
        <flux:button>Edit profile</flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-profile" class="md:w-96" x-on:close.camel="$wire.resetForm()">

        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>

                <flux:input
                    id="tanggal_awal"
                    type="text"
                    placeholder="dd/mm/yyyy"
                    icon:trailing="calendar"
                    datepicker
                    datepicker-autohide
                    datepicker-format="dd-mm-yyyy"
                    datepicker-orientation="top"
                    data-dropdown-parent="body"
                />
            
            <flux:input label="Date of birth" type="date" />
            

            <div class="flex">
                <flux:spacer />
                <flux:modal.trigger name="confirm-edit">
                    <flux:button type="button">Edit profile</flux:button>
                </flux:modal.trigger>
            </div>
        </div>
    </flux:modal>
        <flux:modal name="confirm-edit" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Confirm</flux:heading>
                <flux:text class="mt-2">sure?</flux:text>
            </div>
        </div>
    </flux:modal>
    <flux:field >
        <flux:label>Tanggal Masuk</flux:label>
        <flux:input class:input="form-control dateee" icon:trailing="calendar" wire:model.blur="form.tanggal_surat" type="text" placeholder="dd-mm-yyyy"/>
        <flux:error name="form.tanggal_surat" />
    </flux:field>

    
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
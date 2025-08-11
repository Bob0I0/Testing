<div>
    <flux:modal.trigger name="edit-profile">
        <flux:button>Edit profile</flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-profile" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>

            <flux:input label="Name" placeholder="Your name" />

            <flux:input label="Date of birth" type="date" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Save changes</flux:button>
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
</div>

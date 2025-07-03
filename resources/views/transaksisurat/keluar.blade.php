<x-layouts.app :title="__('Surat Keluar')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Kelola Akun') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage all account settings') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <flux:button href="#" icon="edit" variant="subtle">edit</flux:button>
    <flux:button href="#" icon="trash" variant="subtle">trash</flux:button>
    <flux:button href="#" icon="receive" variant="subtle">receive</flux:button>
    <flux:button href="#" icon="dotoff" variant="subtle">dotoff</flux:button>
    <flux:button href="#" icon="doton" variant="subtle">doton</flux:button>
    <flux:button href="#" icon="edituser" variant="subtle">edituser</flux:button>
    <flux:button href="#" icon="home" variant="subtle">home</flux:button>
    <flux:button href="#" icon="arrow-left" variant="subtle">arrow-left</flux:button>
    <flux:button href="#" icon="arrow-right" variant="subtle">arrow-right</flux:button>
    <flux:button href="#" icon="sms" variant="subtle">sms</flux:button>
    <flux:button href="#" icon="smsfast" variant="subtle">smsfast</flux:button>
    <flux:button href="#" icon="chevrons-up-down" variant="subtle">chevrons-up-down</flux:button>
    <flux:button href="#" icon="boxsend" variant="subtle">boxsend</flux:button>
    <flux:button href="#" icon="boxreceive" variant="subtle">boxreceive</flux:button>
    <flux:button href="#" icon="peoples" variant="subtle">peoples</flux:button>
    
</x-layouts.app>

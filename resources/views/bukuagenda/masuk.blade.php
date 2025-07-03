<x-layouts.app :title="__('Agenda Masuk')">
    <div class="card flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="card-header">
            <h1 class="text-2xl font-semibold">{{ __('Agenda Masuk') }}</h1>
            <p class="text-sm text-gray-500">{{ __('Manage your incoming agenda here.') }}</p>
        </div>
        <div class="card-body">
            <!-- Content for Agenda Keluar will go here -->
            <p>{{ __('This is where you can manage your incoming agenda.') }}</p>
        </div>
        <flux:button.group>
            <flux:button href="#" icon="edit" variant="subtle">edit</flux:button>
            <flux:button href="#" icon="trash" variant="subtle">trash</flux:button>
            <flux:button href="#" icon="print" variant="subtle">print</flux:button>
            <flux:button href="#" icon="book-open-text" variant="subtle">plus</flux:button>
            <flux:button href="#" icon="doc" variant="subtle">minus</flux:button>
            <flux:button href="#" icon="dotoff" variant="subtle">check</flux:button>
            <flux:button href="#" icon="doton" variant="subtle">x</flux:button>
            <flux:button href="#" icon="edituser" variant="subtle">search</flux:button>
            <flux:button href="#" icon="folder-git-2" variant="subtle">download</flux:button>
            <flux:button href="#" icon="home" variant="subtle">upload</flux:button>
            <flux:button href="#" icon="arrow-left" variant="subtle">arrow-left</flux:button>
            <flux:button href="#" icon="arrow-right" variant="subtle">arrow-right</flux:button>
            <flux:button href="#" icon="layout-grid" variant="subtle">search</flux:button>
            <flux:button href="#" icon="sms" variant="subtle">download</flux:button>
            <flux:button href="#" icon="smsfast" variant="subtle">upload</flux:button>

        </flux:button.group>
    </div>
</x-layouts.app>
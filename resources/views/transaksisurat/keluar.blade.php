<x-layouts.app :title="__('Surat Keluar')">
    <div class="card flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="card-header">
            <h1 class="text-2xl font-semibold">{{ __('Surat Keluar') }}</h1>
            <p class="text-sm text-gray-500">{{ __('Manage your outgoing letters here.') }}</p>
        </div>
        <div class="card-body">
            <!-- Content for Surat Keluar will go here -->
            <p>{{ __('This is where you can manage your outgoing letters.') }}</p>
        </div>
    </div>
</x-layouts.app>
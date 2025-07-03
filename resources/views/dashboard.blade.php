<x-layouts.app :title="__('Dashboard')">
    <div class="card flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="card-header">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex flex-col justify-between p-4 md:col-span-2">
                    <div class="flex items-center justify-between h-full">
                        <div class="flex flex-col justify-start h-full">
                            <h1 class="text-2xl font-semibold">{{ __('Selamat') }}</h1>
                            <p class="text-sm text-gray-500">{{ __('Tanggal') }}</p>
                        </div>
                        <img src="{{ asset('images/Person.png') }}" alt="Dashboard Image" class="h-full w-auto object-contain rounded-lg ml-4">
                    </div>
                </div>
                <div class="grid auto-rows-min gap-4 md:grid-cols-2 md:col-span-1">
                    <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex flex-col items-center justify-center">
                        <h1 class="text-2xl font-semibold text-center">{{ __('Surat Masuk') }}</h1>
                        <p class="text-xl text-center">{{ __('0') }}</p>
                    </div>
                    <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex flex-col items-center justify-center">
                        <h1 class="text-2xl font-semibold text-center">{{ __('Surat Keluar') }}</h1>
                        <p class="text-xl text-center">{{ __('0') }}</p>
                    </div>
                    <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex flex-col items-center justify-center">
                        <h1 class="text-2xl font-semibold text-center">{{ __('Pengguna Aktif') }}</h1>
                        <p class="text-xl text-center">{{ __('0') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
            <div class="text-center ">
                <img src="{{ asset('images/LOGO-PMI-png-1 2.png') }}" alt="Logo" style="width: 190px; height: 132px; object-fit: contain;">
                <flux:separator class="my-0"/>
            </div>
            <flux:navlist class="w-55">
                
                <flux:navlist.item href="/dashboard" icon="home">Dashboard</flux:navlist.item>
                <flux:separator class="my-1"/>
                
                <flux:navlist.group class="my-1" icon="smsfast" heading="Transaksi Surat" expandable :expanded="request()->routeIs('suratmasuk') || request()->routeIs('suratkeluar')">
                    <flux:navlist.item
                        href="/suratmasuk"
                        :icon="request()->routeIs('suratmasuk') ? 'doton' : 'dotoff'"
                        :dot-icon="true"
                    >
                        Surat Masuk
                    </flux:navlist.item>
                    <flux:navlist.item
                        href="/suratkeluar"
                        :icon="request()->routeIs('suratkeluar') ? 'doton' : 'dotoff'"
                        :dot-icon="true"
                    >
                        Surat Keluar
                    </flux:navlist.item>
                </flux:navlist.group>
                
                <flux:separator class="my-1"/>
                <flux:navlist.group class="my-1" icon="sms" heading="Surat" expandable :expanded="request()->routeIs('peminjaman') || request()->routeIs('pengembalian')">
                    <flux:navlist.item
                        href="/peminjaman"
                        :icon="request()->routeIs('peminjaman') ? 'doton' : 'dotoff'"
                        :dot-icon="true"
                    >
                        Peminjaman
                    </flux:navlist.item>
                    <flux:navlist.item
                        href="/pengembalian"
                        :icon="request()->routeIs('pengembalian') ? 'doton' : 'dotoff'"
                        :dot-icon="true"
                    >
                        Pengembalian
                    </flux:navlist.item>
                </flux:navlist.group>
                <flux:separator class="my-1"/>
                
                <flux:navlist.item href="/kelola" icon="edituser">Kelola Pengguna</flux:navlist.item>
                <flux:separator class="my-2"/>
            </flux:navlist>

            <flux:spacer />

            {{-- 
            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>
            --}}
            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
            
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <x:searchbar />
        </flux:header>
        <div class="hidden lg:flex w-full px-6 py-4 items-center justify-end bg-white dark:bg-zinc-800">
            <x:searchbar />
        </div>
        
        {{ $slot }}
        `<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
        @fluxScripts
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-[#EEF9F9] dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
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
                        href="{{ route('suratmasuk') }}"
                        :icon="request()->routeIs('suratmasuk') ? 'doton' : 'dotoff'"
                        :dot-icon="true"
                    >
                        Surat Masuk
                    </flux:navlist.item>
                    <flux:navlist.item
                        href="{{ route('suratkeluar') }}"
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
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <x:searchbar />
        </flux:header>
        <div class="hidden lg:flex w-full px-6 py-4 items-center justify-end bg-[#EEF9F9] dark:bg-zinc-800">
            <x:searchbar />
        </div>
        
        {{ $slot }}
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
        @fluxScripts
    </body>
</html>

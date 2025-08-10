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
                <flux:navlist.item icon="sms" :href="route('pinjamsurat')" :current="request()->routeIs('pinjamsurat')" wire:navigate>{{ __('Surat') }}</flux:navlist.item>
                <flux:separator class="my-1"/>

                <flux:navlist.item icon="edituser" :href="route('kelola')" :current="request()->routeIs('kelola')" wire:navigate>{{ __('Kelola User') }}</flux:navlist.item>
                <flux:separator class="my-2"/>
            </flux:navlist>

            <flux:spacer />
            
            <flux:separator />
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    name="Pengguna"
                    :initials="auth()->user()->initials()"
                    avatar:badge 
                    avatar:badge:circle
                    avatar:badge:color="green"
                    avatar:color="cyan"
                    :chevron="false"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->username }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.appearance')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
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
            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    name="Pengguna"
                    :initials="auth()->user()->initials()"
                    avatar:badge 
                    avatar:badge:circle
                    avatar:badge:color="green"
                    avatar:color="cyan"
                    :chevron="false"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

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
        </flux:header>
        
        {{ $slot }}
        {{-- @stack('scripts') --}}
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
        @fluxScripts
    </body>
</html>

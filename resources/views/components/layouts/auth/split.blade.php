<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <div class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-e dark:border-neutral-800">
                <div class="absolute inset-0 bg-neutral-900" style="background: linear-gradient(to right, #4B0B0B, #B31313);"></div>
                <div class="relative z-20 mt-0 flex-1">
                    <h1 class="font-bold text-5xl leading-tight">Sistem</h1>
                    <h1 class="font-bold text-5xl leading-tight">Informasi</h1>
                    <h1 class="font-bold text-5xl leading-tight">Pengarsipan Surat</h1>
                </div>
            </div>
            <div class="flex flex-col items-center justify-center w-full h-dvh p-6 bg-white text-gray-900 lg:p-8">
                {{ $slot }}
            </div>
        </div>
        @fluxScripts
    </body>
</html>

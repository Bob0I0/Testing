
<div class="card flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="card-header">
        <div class="grid gap-8 md:grid-cols-3 items-stretch bg-[#EEF9F9] dark:bg-zinc-800">
            <div class="relative overflow-hidden rounded-xl shadow-sm border border-neutral-200 bg-white dark:bg-zinc-700 dark:border-neutral-700 flex flex-col justify-between p-4 md:col-span-2">
                <div class="flex items-center justify-between h-75">
                    <div class="flex flex-col justify-start h-full">
                        <h1 class="truncate text-2xl font-semibold text-zinc-800 dark:text-zinc-200">{{ $greeting }} {{ auth()->user()->name }}</h1>
                        <p class="truncate text-sm text-gray-500 dark:text-zinc-300">{{ $formattedDate }}</p>
                    </div>
                    <img src="{{ asset('images/Person.png') }}" alt="Dashboard Image" class="h-full w-auto object-contain rounded-lg ml-4">
                </div>
            </div>

            <div class="flex flex-col gap-8 md:col-span-1">
                <div class="grid grid-cols-2 gap-8">
                    <div class="relative overflow-hidden rounded-xl shadow-sm border border-neutral-200 bg-white dark:bg-zinc-700 dark:border-neutral-700 flex flex-col items-center justify-center py-7 px-3">
                        <div class="absolute top-3 left-3 p-2 rounded-xl shadow-sm flex items-center justify-center dark:bg-zinc-600">
                            <flux:icon.boxreceive variant="custom" class="w-5 h-5 " /> 
                        </div>
                        <div class="flex flex-col items-center justify-center mt-8">
                            <h1 class="text-lg font-semibold text-center text-zinc-800 dark:text-zinc-200">{{ 'Surat Masuk' }}</h1>
                            <p class="text-3xl font-bold text-center text-zinc-800 dark:text-zinc-200">{{ $totalSuratMasuk }}</p>
                        </div>
                    </div>

                    <div class="relative overflow-hidden rounded-xl shadow-sm border border-neutral-200 bg-white dark:bg-zinc-700 dark:border-neutral-700 flex flex-col items-center justify-center py-7 px-3">
                        <div class="absolute top-3 left-3 p-2 rounded-xl shadow-sm flex items-center justify-center dark:bg-zinc-600">
                            <flux:icon.boxsend variant="custom" class="w-5 h-5" /> 
                        </div>
                        <div class="flex flex-col items-center justify-center mt-8">
                            <h1 class="text-lg font-semibold text-center text-zinc-800 dark:text-zinc-200">{{ 'Surat Keluar' }}</h1>
                            <p class="text-3xl font-bold text-center text-zinc-800 dark:text-zinc-200">{{ $totalSuratKeluar }}</p>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-xl shadow-sm border border-neutral-200 bg-white dark:bg-zinc-700 dark:border-neutral-700 flex flex-col items-center justify-center p-4 flex-grow">
                        <div class="absolute top-3 left-3 p-2 rounded-xl shadow-sm flex items-center justify-center dark:bg-zinc-600">
                        <flux:icon.peoples variant="custom" class="w-5 h-5" /> 
                    </div>
                    <div class="flex flex-col items-center justify-center mt-8">
                        <h1 class="text-lg font-semibold text-center text-zinc-800 dark:text-zinc-200">{{ 'Pengguna Aktif' }}</h1>
                        <p class="text-3xl font-bold text-center text-zinc-800 dark:text-zinc-200">{{ $jumlahPenggunaAktif }}</p>
                    </div>
                </div>
            </div>
        </div>
        <livewire:komponen.chart lazy />
    </div>
</div>
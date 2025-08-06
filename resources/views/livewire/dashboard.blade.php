<x-layouts.app :title="__('Dashboard')">
    <div class="card flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="card-header">
            <div class="grid gap-8 md:grid-cols-3 items-stretch bg-[#EEF9F9] dark:bg-zinc-800">
                <div class="relative overflow-hidden rounded-xl shadow-sm border border-neutral-200 bg-white dark:border-neutral-700 flex flex-col justify-between p-4 md:col-span-2">
                    <div class="flex items-center justify-between h-75">
                        <div class="flex flex-col justify-start h-full">
                            <?php
                                date_default_timezone_set('Asia/Jakarta');
                                $hour = date('H');
                                $greeting = '';
                                if ($hour >= 5 && $hour < 12) {
                                    $greeting = 'Selamat Pagi';
                                } elseif ($hour >= 12 && $hour < 17) {
                                    $greeting = 'Selamat Siang';
                                } elseif ($hour >= 17 && $hour < 20) {
                                    $greeting = 'Selamat Sore';
                                } else {
                                    $greeting = 'Selamat Malam';
                                }
                                // Translate day and month names to Indonesian
                                $dayNames = [
                                    'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu',
                                    'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
                                ];
                                $monthNames = [
                                    'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret', 'April' => 'April',
                                    'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli', 'August' => 'Agustus',
                                    'September' => 'September', 'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'
                                ];

                                $currentDay = $dayNames[date('l')];
                                $currentDate = date('d');
                                $currentMonth = $monthNames[date('F')];
                                $currentYear = date('Y');

                                $formattedDate = "$currentDay, $currentDate $currentMonth $currentYear";
                            ?>
                            <h1 class="truncate text-2xl font-semibold">{{ $greeting }} Administrator!</h1>
                            <p class="truncate text-sm text-gray-500">{{ $formattedDate }}</p>
                        </div>
                        <img src="{{ asset('images/Person.png') }}" alt="Dashboard Image" class="h-full w-auto object-contain rounded-lg ml-4">
                    </div>
                </div>

                <div class="flex flex-col gap-8 md:col-span-1">
                    <div class="grid grid-cols-2 gap-8">
                        <div class="relative overflow-hidden rounded-xl shadow-sm border border-neutral-200 bg-white dark:border-neutral-700 flex flex-col items-center justify-center py-7 px-3">
                            <div class="absolute top-3 left-3 p-2 rounded-xl shadow-sm flex items-center justify-center">
                                <flux:icon.boxreceive class="w-5 h-5" /> 
                            </div>
                            <div class="flex flex-col items-center justify-center mt-8">
                                <h1 class="text-lg font-semibold text-center">{{ 'Surat Masuk' }}</h1>
                                <p class="text-3xl font-bold text-center">{{ '0' }}</p>
                            </div>
                        </div>

                        <div class="relative overflow-hidden rounded-xl shadow-sm border border-neutral-200 bg-white dark:border-neutral-700 flex flex-col items-center justify-center py-7 px-3">
                            <div class="absolute top-3 left-3 p-2 rounded-xl shadow-sm flex items-center justify-center">
                                <flux:icon.boxsend class="w-5 h-5" /> 
                            </div>
                            <div class="flex flex-col items-center justify-center mt-8">
                                <h1 class="text-lg font-semibold text-center">{{ 'Surat Keluar' }}</h1>
                                <p class="text-3xl font-bold text-center">{{ '0' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative overflow-hidden rounded-xl shadow-sm border border-neutral-200 bg-white dark:border-neutral-700 flex flex-col items-center justify-center p-4 flex-grow">
                         <div class="absolute top-3 left-3 p-2 rounded-xl shadow-sm flex items-center justify-center">
                            <flux:icon.peoples class="w-5 h-5" /> 
                        </div>
                        <div class="flex flex-col items-center justify-center mt-8">
                            <h1 class="text-lg font-semibold text-center">{{ 'Pengguna Aktif' }}</h1>
                            <p class="text-3xl font-bold text-center">{{ '0' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <livewire:komponen.chart />
        </div>
    </div>
</x-layouts.app>
<x-layouts.app :title="__('Dashboard')">
    <div class="card flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="card-header">
            {{-- Main grid container for the two columns (left large card, right three small cards) --}}
            {{-- `items-stretch` ensures grid items stretch to fill the height of the row --}}
            <div class="grid gap-4 md:grid-cols-3 items-stretch">
                {{-- Left Card (Greeting and Image) --}}
                {{-- This card spans 2 columns on medium screens and up --}}
                <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex flex-col justify-between p-4 md:col-span-2">
                    <div class="flex items-center justify-between h-75">
                        <div class="flex flex-col justify-start h-full">
                            <?php
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
                            <h1 class="text-2xl font-semibold">{{ $greeting }} Administrator!</h1>
                            <p class="text-sm text-gray-500">{{ $formattedDate }}</p>
                        </div>
                        <img src="{{ asset('images/Person.png') }}" alt="Dashboard Image" class="h-full w-auto object-contain rounded-lg ml-4">
                    </div>
                </div>

                {{-- Right Cards Container --}}
                {{-- This div is a flex column to stack the two rows of cards vertically --}}
                {{-- It spans 1 column on medium screens and up --}}
                <div class="flex flex-col gap-4 md:col-span-1">
                    {{-- Container for "Surat Masuk" and "Surat Keluar" --}}
                    {{-- This is a grid with 2 columns to place them side-by-side --}}
                    <div class="grid grid-cols-2 gap-4">
                        {{-- Surat Masuk Card --}}
                        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex flex-col items-center justify-center p-4">
                            <div class="flex items-center gap-2 mb-2">
                                <flux:icon.academic-cap />
                                <h1 class="text-lg font-semibold text-center">{{ __('Surat Masuk') }}</h1>
                            </div>
                            <p class="text-3xl font-bold text-center">{{ __('0') }}</p>
                        </div>

                        {{-- Surat Keluar Card --}}
                        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex flex-col items-center justify-center p-4">
                            <div class="flex items-center gap-2 mb-2">
                                <flux:icon.academic-cap />
                                <h1 class="text-lg font-semibold text-center">{{ __('Surat Keluar') }}</h1>
                            </div>
                            <p class="text-3xl font-bold text-center">{{ __('0') }}</p>
                        </div>
                    </div>

                    {{-- Pengguna Aktif Card --}}
                    {{-- `flex-grow` makes this card expand to fill the remaining vertical space --}}
                    {{-- `aspect-video` has been removed to allow it to stretch vertically --}}
                    <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex flex-col items-center justify-center p-4 flex-grow">
                        <div class="flex items-center gap-2 mb-2">
                            <flux:icon.academic-cap />
                            <h1 class="text-lg font-semibold text-center">{{ __('Pengguna Aktif') }}</h1>
                        </div>
                        <p class="text-3xl font-bold text-center">{{ __('0') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

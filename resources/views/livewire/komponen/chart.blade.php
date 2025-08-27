<div class="col-span-2 rounded-xl shadow-sm border border-neutral-200 bg-white dark:bg-zinc-200 dark:border-neutral-700 p-4 my-3">
    <div class="flex flex-col items-center gap-2 mb-2">
        <p class="text-center dark:text-zinc-900">
            Total Surat Masuk dan Keluar Periode Tahun
            <strong>
                <flux:select wire:model="tahunRange" class="rounded px-8 py-1">
                    @foreach($tahunRangeList as $range)
                        <flux:select.option value="{{ $range }}">{{ $range }}</flux:select.option>
                    @endforeach
                </flux:select>
            </strong>
        </p>
        
    </div>

    <div 
        x-data="{ chart: null }" x-init="
        chart = new Chart(document.getElementById('myChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: $wire.labels, 
            datasets: [
            {
                label: $wire.name1, 
                data: $wire.dataPoint1, 
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: $wire.name2, 
                data: $wire.dataPoint2,
                backgroundColor: 'rgba(54, 162, 235, 0.2)', 
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }
            ]
        },
        options: {
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    stacked: true
                }
            }
        }
        });
    ">
        <canvas id="myChart" width="full" height="70"></canvas>
    </div>
</div>

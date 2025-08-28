<div class="col-span-2 rounded-xl shadow-sm border border-neutral-200 bg-white dark:bg-zinc-200 dark:border-neutral-700 p-4 my-3">
    <p class="text-center dark:text-zinc-900">
        Total Surat Masuk dan Keluar Pada Tahun <strong>{{ $tahun }}</strong>
    </p>

    <div 
        x-data="{
            chart: null,
            initChart() {
                let ctx = document.getElementById('myChart').getContext('2d');
                this.chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @js($labels),
                        datasets: [
                            {
                                label: @js($name1),
                                data: @js($dataPoint1),
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: @js($name2),
                                data: @js($dataPoint2),
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: { stacked: true },
                            y: { stacked: true }
                        }
                    }
                });
            }
        }"
        x-init="initChart()"
        wire:ignore
    >
        <canvas id="myChart" width='full' height='70'></canvas>
    </div>
</div>

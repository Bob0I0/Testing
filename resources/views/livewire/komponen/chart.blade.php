<div class="col-span-2 rounded-xl shadow-sm border border-neutral-200 bg-white dark:bg-zinc-200 dark:border-neutral-700 p-4 my-3">
    <p class="text-center dark:text-zinc-900">Total Surat Masuk dan Keluar Periode Tahun<strong> xxxx - xxxx</strong></p>
    <div 
        x-data="{ chart: null }" x-init="
        chart = new Chart(document.getElementById('myChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: $wire.labels, // This should be your month labels, e.g., ['Jan', 'Feb', 'Mar']
            datasets: [
            {
                label: $wire.name1, // First dataset's label, e.g., 'Penjualan'
                data: $wire.dataPoint1, // First set of data points, corresponding to labels
                backgroundColor: 'rgba(255, 99, 132, 0.2)', // Color for the first dataset
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: $wire.name2, // Second dataset's label, e.g., 'Pengeluaran'
                data: $wire.dataPoint2, // Second set of data points
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color for the second dataset
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }
            ]
        },
        options: {
            // You might want to add options here, e.g., for responsiveness or scales
            responsive: true,
            scales: {
                x: {
                    stacked: true // Set to true if you want the bars to stack
                },
                y: {
                    stacked: true // Set to true if you want the bars to stack
                }
            }
        }
        });
    ">
        <canvas id="myChart" width="full" height="70"></canvas>
    </div>
</div>
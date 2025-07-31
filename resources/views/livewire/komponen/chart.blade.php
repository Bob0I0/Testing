{{-- <div class="grid grid-cols-3 gap-4"> --}}
<div 
    class="col-span-2" 
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
    {{-- <div x-data="{ chart: null }" x-init="
        chart = new Chart(document.getElementById('myPieChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: [$wire.label1, $wire.label2], // Misal: ['Pemasukan', 'Pengeluaran']
                datasets: [{
                    label: $wire.chartTitle, // Judul keseluruhan pie chart, misal: 'Proporsi Keuangan Bulan Ini'
                    data: [$wire.dataPointp1, $wire.dataPointp2], // Misal: [5000000, 2000000]
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)', // Warna untuk data pertama
                        'rgba(255, 99, 132, 0.6)'  // Warna untuk data kedua
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: $wire.chartTitle // Menggunakan judul dari Livewire
                    }
                }
            }
        });
    ">
        <canvas id="myPieChart" class="w-full" height="h-full"></canvas>
    </div> --}}
{{-- </div> --}}
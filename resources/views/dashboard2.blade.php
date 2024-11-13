@extends('layout.main')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<!-- Memasukkan jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<!-- Memasukkan jsPDF AutoTable Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.22/jspdf.plugin.autotable.min.js"></script>

<style>
    .custom-dropdown-btn {
    padding: 10px 15px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease;
}

.custom-dropdown-btn:hover {
    background-color: #f0f0f5;
}

.calendar-icon {
    margin-right: 5px;
}

.custom-dropdown-menu {
    background-color: #f9f9fb;
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border-radius: 8px;
}

.custom-dropdown-item {
    padding: 10px 20px;
    color: #555;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.custom-dropdown-item:hover {
    background-color: #eceff1;
    color: #333;
}

</style>
<div class="col-12 col-xl-4 mb-4">
    <div class="justify-content-end d-flex">
        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
            <button class="btn btn-sm btn-light bg-white dropdown-toggle custom-dropdown-btn" type="button" id="dropdownMenuDate2"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="mdi mdi-calendar calendar-icon"></i> Today (10 November 2024)
            </button>
            <div class="dropdown-menu dropdown-menu-right custom-dropdown-menu" aria-labelledby="dropdownMenuDate2">
                <a class="dropdown-item custom-dropdown-item" href="#">January - March</a>
                <a class="dropdown-item custom-dropdown-item" href="#">March - June</a>
                <a class="dropdown-item custom-dropdown-item" href="#">June - August</a>
                <a class="dropdown-item custom-dropdown-item" href="#">August - November</a>
            </div>
        </div>
    </div>
</div>


    <div class="col-md-12 grid-margin transparent">
        <div class="row">
            <div class="col-md-3 mb-4 stretch-card transparent">
                <div class="card card-tale" style="background-color: #ffccbc;">
                    <div class="card-body">
                        <p class="mb-4">Emiten</p>
                        <p class="fs-30 mb-2">{{ $emitenCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 stretch-card transparent">
                <div class="card card-dark-blue" style="background-color: #bbdefb;">
                    <div class="card-body">
                        <p class="mb-4">Volume Transaksi</p>
                        <p class="fs-30 mb-2">{{ $transaksiVolume }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 stretch-card transparent">
                <div class="card card-light-blue" style="background-color: #c8e6c9;">
                    <div class="card-body">
                        <p class="mb-4">Value Transaksi</p>
                        <p class="fs-30 mb-2">{{ $transaksiValue }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 stretch-card transparent">
                <div class="card card-light-danger" style="background-color: #ffebee;">
                    <div class="card-body">
                        <p class="mb-4">Jumlah Frequensi</p>
                        <p class="fs-30 mb-2">{{ $transaksiFrequency }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan tabel untuk menampilkan data transaksi harian -->
    <div class="col-md-12 grid-margin transparent">
        <div class="row">
            <!-- Kolom untuk tabel -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Transaksi Harian</h4>

                        <!-- Dropdown untuk memilih bulan -->
                        <label for="filterMonth">Pilih Bulan:</label>
                        <select id="filterMonth" class="form-select mb-3">
                            <option value="all">Semua Bulan</option>
                            @foreach ($availableMonths as $month)
                                <option value="{{ $month }}">{{ $month }}</option>
                            @endforeach
                        </select>

                        <button id="downloadPDF" class="btn btn-primary mb-4">Unduh PDF</button>

                        <div class="table-responsive">
                            <table class="table table-bordered" style="width: 100%; max-width: 600px;">
                                <thead>
                                    <tr>
                                        <th>Stock Code</th>
                                        <th>Bulan</th>
                                        <th>Total Volume</th>
                                        <th>Total Value</th>
                                        <th>Total Frequency</th>
                                        <th>Harga Close</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $transaction)
                                        <tr data-month="{{ $transaction->bulan }}">
                                            <td>{{ $transaction->STOCK_CODE }}</td>
                                            <td>{{ $transaction->bulan }}</td>
                                            <td>{{ $transaction->total_volume }}</td>
                                            <td>{{ $transaction->total_value }}</td>
                                            <td>{{ $transaction->frequency }}</td>
                                            <td>{{ $transaction->harga_close }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Paginasi -->
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom untuk pie chart -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pie Chart Total Value Transaksi</h4>
                        <!-- Tempat untuk pie chart -->
                        <div id="chartContainer" style="height: 400px; width: 100%;">
                            <canvas id="transactionPieChart"></canvas> <!-- Elemen canvas untuk Chart.js -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row"> <!-- Menggunakan row untuk kolom dalam kontainer -->
        <div class="col-6 mb-4"> <!-- Kolom untuk bar chart -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Frekuensi Bulanan</h4>
                    <div id="frequencyBarChart" style="height: 400px; width: 100%;">
                        <canvas id="frequencyBarChartCanvas"></canvas> <!-- Elemen canvas untuk Bar Chart -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4"> <!-- Kolom untuk line chart harga close -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Grafik Harga Close</h4>
                    <div id="closePriceLineChart" style="height: 400px; width: 100%;">
                        <canvas id="closePriceChartCanvas"></canvas> <!-- Elemen canvas untuk Line Chart -->
                    </div>
                </div>
            </div>
        </div>



        <!-- Sertakan Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Sertakan Chart.js Data Labels Plugin -->
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

        <script>
            // Ambil data dari controller
            const stockCodes = @json($data->pluck('STOCK_CODE')); // Stock codes dari controller
            const totalValues = @json($data->pluck('total_value')); // Total values dari controller
            const frequencies = @json($data->pluck('frequency')); // Frekuensi dari controller
            const closePrices = @json($data->pluck('harga_close')); // Harga close dari controller

            // Buat pie chart
            const ctx = document.getElementById('transactionPieChart').getContext('2d');
            const transactionPieChart = new Chart(ctx, {
                type: 'pie', // Tipe chart: 'pie'
                data: {
                    labels: stockCodes, // Label untuk stock codes
                    datasets: [{
                        label: 'Total Value', // Label untuk dataset
                        data: totalValues, // Data untuk total value
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)', // Warna untuk setiap bagian pie
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)', // Warna border untuk setiap bagian pie
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(201, 203, 207, 1)'
                        ],
                        borderWidth: 1 // Ketebalan border
                    }]
                },
                options: {
                    responsive: true, // Responsif
                    plugins: {
                        legend: {
                            position: 'top', // Posisi legend
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    const value = context.raw; // Total value
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += value.toLocaleString(); // Menampilkan nilai dengan format ribuan
                                    return label;
                                }
                            }
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                            formatter: function(value, context) {
                                const total = totalValues.reduce((acc, val) => acc + val, 0); // Total keseluruhan
                                const percentage = ((value / total) * 100).toFixed(2) +
                                '%'; // Menghitung persentase
                                return `${value.toLocaleString()} (${percentage})`; // Menampilkan angka dan persen
                            },
                            color: '#36A2EB',
                        }
                    }
                }
            });

            // Buat bar chart untuk frekuensi bulanan
            const freqCtx = document.getElementById('frequencyBarChartCanvas').getContext('2d');
            const frequencyBarChart = new Chart(freqCtx, {
                type: 'bar', // Tipe chart: 'bar'
                data: {
                    labels: stockCodes, // Label untuk stock codes
                    datasets: [{
                        label: 'Total Frequency', // Label untuk dataset
                        data: frequencies, // Data untuk frekuensi
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna untuk bar
                        borderColor: 'rgba(75, 192, 192, 1)', // Warna border untuk bar
                        borderWidth: 1 // Ketebalan border
                    }]
                },
                options: {
                    responsive: true, // Responsif
                    scales: {
                        y: {
                            beginAtZero: true // Memastikan sumbu Y mulai dari nol
                        }
                    },
                    plugins: {
                        legend: {
                            display: true, // Tampilkan legend
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    const value = context.raw; // Total frequency
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += value.toLocaleString(); // Menampilkan nilai dengan format ribuan
                                    return label;
                                }
                            }
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                            formatter: function(value) {
                                return value.toLocaleString(); // Menampilkan angka dengan format ribuan
                            },
                            color: '#36A2EB',
                        }
                    }
                }
            });

            // Buat line chart untuk harga close

            // Data harga close
            // Menggunakan data dari controller

            const closeCtx = document.getElementById('closePriceChartCanvas').getContext('2d');
            const closePriceChart = new Chart(closeCtx, {
                type: 'line',
                data: {
                    labels: stockCodes, // Menggunakan label bulan
                    datasets: [{
                        label: 'Harga Close',
                        data: closePrices, // Menggunakan data harga close
                        fill: false,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    const value = context.raw;
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += value.toLocaleString();
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            document.getElementById('downloadPDF').addEventListener('click', function () {
                // Ambil nilai bulan yang dipilih
                const selectedMonth = document.getElementById('filterMonth').value;

                // Sembunyikan baris yang tidak sesuai bulan yang dipilih
                document.querySelectorAll('tbody tr').forEach(row => {
                    if (selectedMonth === 'all' || row.getAttribute('data-month') === selectedMonth) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Mengambil data tabel dan menyusunnya ke dalam array
                const rows = document.querySelectorAll('.table-responsive tbody tr');
                const data = [];

                // Ambil data dari setiap baris tabel
                rows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    const rowData = [];
                    cells.forEach(cell => rowData.push(cell.textContent.trim()));
                    data.push(rowData);
                });

                // Membuat instance jsPDF
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Menambahkan judul
                doc.setFontSize(18);
                doc.text('Laporan Transaksi Harian', 14, 20);

                // Menambahkan header tabel
                const header = ['Stock Code', 'Bulan', 'Total Volume', 'Total Value', 'Total Frequency', 'Harga Close'];

                // Menambahkan tabel ke PDF dengan autoTable
                doc.autoTable({
                    head: [header],
                    body: data,
                    startY: 30,
                    margin: { left: 10, right: 10 },
                    theme: 'grid',  // Menambahkan grid pada tabel
                });

                // Menyimpan dan mengunduh PDF
                const filename = `data_transaksi_harian_${selectedMonth}.pdf`;
                doc.save(filename);

                // Kembalikan tampilan semua baris setelah download selesai
                document.querySelectorAll('tbody tr').forEach(row => row.style.display = '');
            });



        </script>
    @endsection

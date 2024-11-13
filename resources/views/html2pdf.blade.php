@extends('layout.main')

@section('title', 'Halo Data Table')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan - Oktober 2024</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Gaya Umum */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        #content {
            margin: 20px auto;
            padding: 20px;
            max-width: 900px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 2.2rem;
        }

        p {
            font-size: 1.1rem;
            color: #666;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-container {
            text-align: center;
            margin-bottom: 20px;
        }

        #download {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #download:hover {
            background-color: #45a049;
        }

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }

        td {
            background-color: #fff;
        }

        /* Ikon untuk tabel */
        .icon {
            color: #4CAF50;
            font-size: 1.2rem;
        }
    </style>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<body>
<div id="content">
    <h1><i class="fas fa-chart-line"></i> Laporan Bulanan - Oktober 2024</h1>
    <p>Ini adalah laporan bulanan yang menampilkan performa dan statistik penting untuk bulan Oktober 2024.</p>

    <!-- Tabel Data Laporan -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1.</td>
                <td>Pendapatan</td>
                <td>Peningkatan 10% dibanding bulan sebelumnya</td>
                <td><i class="fas fa-check-circle icon"></i></td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Pengeluaran</td>
                <td>Penurunan 5% dibanding bulan sebelumnya</td>
                <td><i class="fas fa-check-circle icon"></i></td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Proyek Baru</td>
                <td>Proyek pengembangan aplikasi mobile</td>
                <td><i class="fas fa-spinner icon" style="color: orange;"></i></td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Target</td>
                <td>80% target tahunan tercapai</td>
                <td><i class="fas fa-check-circle icon"></i></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Tombol download PDF -->
<div class="btn-container">
    <button id="download"><i class="fas fa-file-pdf"></i> Download PDF</button>
</div>

<script>
    document.getElementById('download').addEventListener('click', function() {
        var element = document.getElementById('content');
        html2pdf()
        .from(element)
        .save('Laporan_Oktober_2024.pdf');
    });
</script>

</body>
</html>
@endsection

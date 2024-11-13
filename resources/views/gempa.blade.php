@extends('layout.main')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Tambahkan referensi jQuery -->
    <script>
        $(document).ready(function() {
            // Contoh data gempa yang diperoleh dari API
            var gempaData = {
                "tanggal": "10 Sep 2024",
                "jam": "12:11:07 WIB",
                "coordinates": "8.74 LS",
                "bujur": "124.26 BT",
                "magnitude": "5.2",
                "kedalaman": "97 KM",
                "wilayah": "Pusat gempa berada di laut 59 km barat daya Alor",
                "potensi": "Gempa ini dirasakan untuk diteruskan pada masyarakat",
                "dirasakan": "II-III Soe",
                "shakemap": "https://data.bmkg.go.id/DataMKG/TEWS/20240910121107"
            };

            // Menampilkan data ke elemen HTML
            $("#tanggal").text(gempaData.tanggal);
            $("#jam").text(gempaData.jam);
            $("#coordinates").text(gempaData.coordinates);
            $("#bujur").text(gempaData.bujur);
            $("#magnitude").text(gempaData.magnitude);
            $("#kedalaman").text(gempaData.kedalaman);
            $("#wilayah").text(gempaData.wilayah);
            $("#potensi").text(gempaData.potensi);
            $("#dirasakan").text(gempaData.dirasakan);
            $("#shakemap").attr("href", gempaData.shakemap).text("Lihat Peta Guncangan");

            // Jika ingin mengambil data dari API langsung
            $.ajax({
                url: 'https://jatimprov.go.id/api/bmkg/gempa',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Gunakan data dari API di sini, contoh:
                    // $("#tanggal").text(data.tanggal);
                },
                error: function(error) {
                    console.error('Terjadi kesalahan:', error);
                }
            });
        });
    </script>
</head>
<body>
    <h1>Informasi Gempa Terkini</h1>
    <p><strong>Tanggal:</strong> <span id="tanggal"></span></p>
    <p><strong>Jam:</strong> <span id="jam"></span></p>
    <p><strong>Koordinat:</strong> <span id="coordinates"></span></p>
    <p><strong>Bujur:</strong> <span id="bujur"></span></p>
    <p><strong>Magnitudo:</strong> <span id="magnitude"></span></p>
    <p><strong>Kedalaman:</strong> <span id="kedalaman"></span></p>
    <p><strong>Wilayah:</strong> <span id="wilayah"></span></p>
    <p><strong>Potensi:</strong> <span id="potensi"></span></p>
    <p><strong>Dirasakan:</strong> <span id="dirasakan"></span></p>
    <p><a id="shakemap" href="" target="_blank">Lihat Peta Guncangan</a></p>
</body>
</html>
@endsection

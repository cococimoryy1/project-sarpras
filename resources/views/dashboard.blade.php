@extends('layouts.main')

@section('content')

<div class="dashboard">
    <!-- Header -->
    <header class="header">
        <h1>Selamat Datang di Sistem Peminjaman Barang</h1>
        <div class="header-info">
            <div class="weather">
                <img id="weather-icon" src="" alt="Cuaca" />
                <span id="weather-description">Loading...</span>
            </div>
            <div class="date">
                <span id="current-date"></span>
            </div>
        </div>
    </header>

    <!-- Katalog Barang -->
    <section class="catalog">
        <h2>Katalog Barang</h2>

        <!-- Peralatan IT -->
        <div class="category">
            <h3>Peralatan IT</h3>
            <div class="item-slider">
                <div class="item-container">
                    <div class="item-card">
                        <img src="{{ asset('assets/images/barang/printer.jpeg') }}" alt="Printer" class="item-img" />
                        <div class="item-details">
                            <h4>Printer</h4>
                        </div>
                    </div>
                    <div class="item-card">
                        <img src="{{ asset('assets/images/barang/proyektor.jpeg') }}" alt="Proyektor" class="item-img" />
                        <div class="item-details">
                            <h4>Proyektor</h4>
                        </div>
                    </div>
                    <div class="item-card">
                        <img src="{{ asset('assets/images/barang/speaker.jpeg') }}" alt="Speaker" class="item-img" />
                        <div class="item-details">
                            <h4>Speaker</h4>
                        </div>
                    </div>
                    <div class="item-card">
                        <img src="{{ asset('assets/images/barang/usb.jpeg') }}" alt="USB" class="item-img" />
                        <div class="item-details">
                            <h4>USB</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peralatan Kebersihan -->
        <div class="category">
            <h3>Peralatan Kebersihan</h3>
            <div class="item-slider">
                <div class="item-container">
                    <div class="item-card">
                        <img src="{{ asset('assets/images/barang/vacum.jpeg') }}" alt="Vacuum" class="item-img" />
                        <div class="item-details">
                            <h4>Vacuum</h4>
                        </div>
                    </div>
                    <div class="item-card">
                        <img src="{{ asset('assets/images/barang/airpurifier.jpeg') }}" alt="Air Purifier" class="item-img" />
                        <div class="item-details">
                            <h4>Air Purifier</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peralatan Kelas -->
        <div class="category">
            <h3>Peralatan Kelas</h3>
            <div class="item-slider">
                <div class="item-container">
                    <div class="item-card">
                        <img src="{{ asset('assets/images/barang/kursi.jpeg') }}" alt="Kursi" class="item-img" />
                        <div class="item-details">
                            <h4>Kursi</h4>
                        </div>
                    </div>
                    <div class="item-card">
                        <img src="{{ asset('assets/images/barang/mejapanjang.jpeg') }}" alt="Meja Panjang" class="item-img" />
                        <div class="item-details">
                            <h4>Meja Panjang</h4>
                        </div>
                    </div>
                    <div class="item-card">
                        <img src="{{ asset('assets/images/barang/smarttv.jpeg') }}" alt="Smart TV" class="item-img" />
                        <div class="item-details">
                            <h4>Smart TV</h4>
                        </div>
                    </div>
                    <div class="item-card">
                        <img src="{{ asset('assets/images/barang/microphone.jpeg') }}" alt="Microphone" class="item-img" />
                        <div class="item-details">
                            <h4>Microphone</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Menampilkan tanggal saat ini
    document.getElementById('current-date').textContent = new Date().toLocaleDateString();

    // Mendapatkan data cuaca dari API BMKG
    const weatherUrl = "/getWeather";

    fetch(weatherUrl)
        .then((response) => response.text())
        .then((xmlText) => {
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(xmlText, "text/xml");

            const city = xmlDoc.querySelector("area[name='Surabaya']");
            const weather = city.querySelector("parameter[id='weather'] timerange[value='2024-11-29T06:00:00+07:00']");
            const weatherDesc = weather.querySelector("value").textContent;
            const tempMin = city.querySelector("parameter[id='tmin'] value").textContent;
            const tempMax = city.querySelector("parameter[id='tmax'] value").textContent;

            document.getElementById('weather-description').textContent = `Cuaca: ${weatherDesc}, Suhu: ${tempMin}°C - ${tempMax}°C`;
            document.getElementById('weather-icon').src = "/path-to-your-icons-folder/default-icon.png";
        })
        .catch((error) => {
            console.error('Error fetching weather data:', error);
            document.getElementById('weather-description').textContent = 'Gagal memuat cuaca';
        });
</script>

@endsection

<style>
    /* Header */
    .header {
        background-color: #3498db;
        padding: 20px;
        color: white;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .header-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }

    .weather img {
        width: 30px;
        height: 30px;
    }

    .date {
        font-size: 16px;
    }

    /* Katalog Barang */
    .catalog {
        margin-top: 30px;
        padding: 0 20px;
    }

    .category {
        margin-bottom: 20px;
    }

    .category h3 {
        font-size: 1.5em;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .item-slider {
        overflow-x: auto;
        display: flex;
    }

    .item-container {
        display: flex;
        gap: 10px;
    }

    .item-card {
        background-color: #ecf0f1;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 150px;
        flex-shrink: 0;
        text-align: center;
        transition: transform 0.3s ease-in-out;
    }

    .item-card:hover {
        transform: translateY(-5px);
    }

    .item-img {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }

    .item-details h4 {
        font-size: 1em;
        color: #2c3e50;
        margin-top: 10px;
    }
</style>

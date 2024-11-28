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

      <!-- Meja Kursi -->
      <div class="category">
        <h3>Meja Kursi</h3>
        <div class="item-card">
          <img src="meja-kursi.jpg" alt="Meja Kursi" class="item-img" />
          <div class="item-details">
            <h4>Meja Kursi</h4>
            <p>Jumlah: 5</p>
            <button class="btn btn-primary">Pinjam</button>
          </div>
        </div>
      </div>

      <!-- Operator -->
      <div class="category">
        <h3>Operator</h3>
        <div class="item-card">
          <img src="operator.jpg" alt="Operator" class="item-img" />
          <div class="item-details">
            <h4>Operator</h4>
            <p>Jumlah: 3</p>
            <button class="btn btn-primary">Pinjam</button>
          </div>
        </div>
      </div>

      <!-- Pel -->
      <div class="category">
        <h3>Pel</h3>
        <div class="item-card">
          <img src="pel.jpg" alt="Pel" class="item-img" />
          <div class="item-details">
            <h4>Pel</h4>
            <p>Jumlah: 7</p>
            <button class="btn btn-primary">Pinjam</button>
          </div>
        </div>
      </div>
    </section>
</div>

<script>
  // Menampilkan tanggal saat ini
  document.getElementById('current-date').textContent = new Date().toLocaleDateString();

  // Mendapatkan Cuaca dari OpenWeatherMap API
  const apiKey = 'YOUR_API_KEY'; // Ganti dengan API Key Anda
  const city = 'Jakarta'; // Ganti dengan nama kota yang Anda inginkan
  const weatherUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric&lang=id`;

  fetch(weatherUrl)
    .then(response => response.json())
    .then(data => {
      const weather = data.weather[0]; // Ambil deskripsi cuaca
      const temperature = data.main.temp; // Ambil suhu
      const iconCode = weather.icon; // Ambil kode ikon cuaca
      const iconUrl = `https://openweathermap.org/img/wn/${iconCode}.png`;

      // Tampilkan cuaca dan ikon
      document.getElementById('weather-description').textContent = `Cuaca: ${weather.description}, ${temperature}°C`;
      document.getElementById('weather-icon').src = iconUrl;
    })
    .catch(error => {
      console.error('Error fetching weather data:', error);
      document.getElementById('weather-description').textContent = 'Gagal memuat cuaca';
    });
</script>

@endsection

<!-- Tambahkan CSS di dalam file blade atau link ke file CSS -->
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
  .item-card {
    display: flex;
    align-items: center;
    background-color: #ecf0f1;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
  }
  .item-card:hover {
    transform: translateY(-5px);
  }
  .item-img {
    width: 100px;
    height: 100px;
    border-radius: 8px;
    object-fit: cover;
    margin-right: 20px;
  }
  .item-details h4 {
    font-size: 1.2em;
    color: #2c3e50;
  }
  .item-details p {
    font-size: 1em;
    color: #7f8c8d;
  }
  .btn {
    background-color: #3498db;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  .btn:hover {
    background-color: #2980b9;
  }
</style>

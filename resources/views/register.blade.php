<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun - Peminjaman Barang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo_project.jpg') }}" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            height: 100vh;
            background: url('../../assets/images/baground3.jpeg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            display: flex;
            width: 100%;
        }

        .left-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            color: #003366;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        .left-section h1 {
            font-size: 3rem;
            font-weight: 600;
            color: #003366;
        }

        .left-section p {
            font-size: 1.2rem;
            margin-top: 1rem;
            text-align: center;
            line-height: 1.5;
            color: #003366;
        }

        .right-section {
            flex: 0.5;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1.5rem; /* Mengurangi padding */
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .login-container {
            width: 100%;
            max-width: 350px;
            text-align: center;
        }

        .login-container img {
            width: 80px;
            margin-bottom: 1rem;
        }

        .login-container h2 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 0.5rem; /* Mengurangi margin bawah */
        }

        .login-container p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 1rem; /* Mengurangi margin bawah */
        }

        .form-group {
            margin-bottom: 1rem; /* Mengurangi jarak antar form group */
        }

        .form-group label {
            display: block;
            font-weight: 400;
            margin-bottom: 0.25rem; /* Mengurangi jarak antara label dan input */
            text-align: left;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #5a9bd6;
        }

        .btn {
            width: 100%;
            padding: 0.75rem;
            background: #5a9bd6;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 1rem; /* Menambahkan margin top agar tombol tidak terlalu rapat */
        }

        .btn:hover {
            background: #4a89c4;
        }

        .register-link {
            margin-top: 1rem;
            font-size: 14px;
        }

        .register-link a {
            color: #5a9bd6;
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .right-section {
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-section">
            <h1>Peminjaman Barang</h1>
            <p>Selamat datang di aplikasi peminjaman barang.<br>Daftarkan akun Anda untuk mengakses fitur kami.</p>
        </div>
        <div class="right-section">
            <div class="login-container">
                <img src="{{ asset('assets/images/logo_project.jpg') }}" alt="Logo Project">
                <h2>Registrasi Akun Baru</h2>
                <p>Masukkan data Anda untuk membuat akun baru</p>
                <form action="{{ route('register.post') }}" method="post">

                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Masukkan username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukkan email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password" required>
                    </div>
                    <button type="submit" class="btn">Daftar</button>
                    <div class="register-link">
                        Sudah punya akun? <a href="/">Login sekarang</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php

// Koneksi ke database menggunakan PDO
$host = '127.0.0.1';
$db = 'pengadaan';
$user = 'root';
$pass = 'password_db';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Ambil data dari form POST
$username = $_POST['username'];
$password = $_POST['password'];
$idrole = $_POST['idrole'];

// Meng-hash password menggunakan bcrypt
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Query manual untuk memasukkan data user
$sql = "INSERT INTO users (username, password, idrole) VALUES (:username, :password, :idrole)";
$stmt = $pdo->prepare($sql);

// Eksekusi query dengan data yang disiapkan
$stmt->execute([
    ':username' => $username,
    ':password' => $hashedPassword,
    ':idrole'   => $idrole
]);

echo "User successfully added!";
?>

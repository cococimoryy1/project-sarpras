<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
// use App\Models\User;
class UserSeeder extends Seeder
{

    public function run(): void
    {
        $data = array(
            [
                'nama_user' => 'administrator',
                'username' => 'admin',
                'id_jenis_user' => 1,
                'password' => bcrypt(12345678),
                'email' => 'admin@gmail.com'
            ],
            [
                'nama_user' => 'mahasiswa',
                'username' => 'mahasiswa',
                'id_jenis_user' => 2,
                'password' => bcrypt(12345678),
                'email' => 'student@gmail.com'
            ],
            [
                'nama_user' => 'dosen',
                'username' => 'dosen',
                'id_jenis_user' => 3,
                'password' => bcrypt(12345678),
                'email' => 'dosen@gmail.com'
            ]
        );

        DB::table('users')->insert($data);

        // DB::table('users')->insert([
        //     'nama_user' => 'Admin User',
        //     'username' => 'admin',
        //     'email' => 'admin@example.com',
        //     'password' => Hash::make('password'), // Be sure to hash the password
        //     'role_id' => 1,
        // ]);
    }
}

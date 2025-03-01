<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Role;
use Database\Seeders\RoleSeeder;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class); // Jalankan seeder agar role tersedia sebelum pengujian
    }

    public function test_pengguna_dapat_mendaftar()
    {
        $response = $this->post('/proses-register', [
            'username' => 'testing',
            'email' => 'testing@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $response->assertRedirect('/'); // Sesuaikan dengan hasil aktual
        $this->assertDatabaseHas('users', ['email' => 'testing@gmail.com']);
    }

    public function test_pengguna_dapat_login()
    {
        $role = Role::where('name', 'User')->first();

        if (!$role) {
            $role = Role::create(['name' => 'User', 'description' => 'Pengguna biasa dengan izin terbatas']);
        }

        User::factory()->create([
            'username' => 'testing',
            'email' => 'testing@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => $role->id,
        ]);

        $response = $this->post('/authenticate', [
            'email' => 'testing@gmail.com',
            'password' => '12345678',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    public function test_pengguna_dapat_logout()
    {
        $role = Role::where('name', 'User')->firstOrFail();

        $user = User::factory()->create([
            'username' => 'testing',
            'email' => 'testing@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => $role->id,
        ]);

        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_pengguna_dapat_login_setelah_logout()
    {
        $role = Role::where('name', 'User')->firstOrFail();

        $user = User::factory()->create([
            'username' => 'testing',
            'email' => 'testing@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => $role->id,
        ]);

        // Login pertama
        $this->post('/authenticate', [
            'email' => 'testing@gmail.com',
            'password' => '12345678',
        ])->assertRedirect('/dashboard');

        $this->assertAuthenticated();

        // Logout
        $this->post('/logout')->assertRedirect('/');
        $this->assertGuest();

        // Login kembali
        $this->post('/authenticate', [
            'email' => 'testing@gmail.com',
            'password' => '12345678',
        ])->assertRedirect('/dashboard');

        $this->assertAuthenticated();
    }

    public function test_admin_dapat_mengakses_dashboard()
    {
        $adminRole = Role::where('name', 'Admin')->firstOrFail();

        $admin = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role_id' => $adminRole->id,
        ]);

        $this->actingAs($admin);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_admin_dapat_mengelola_pengguna()
    {
        $adminRole = Role::where('name', 'Admin')->firstOrFail();
        $admin = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role_id' => $adminRole->id,
        ]);

        $this->actingAs($admin);

        $response = $this->get('/users');

        $response->assertStatus(200);
    }

    public function test_pengguna_tidak_dapat_mengelola_manajemen_menu()
    {
        $userRole = Role::where('name', 'User')->firstOrFail();
        $user = User::factory()->create([
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123'),
            'role_id' => $userRole->id,
        ]);

        $this->actingAs($user);

        $response = $this->get('/users');

        $response->assertRedirect('/'); // Pengguna biasa tidak boleh mengakses halaman ini
    }
    public function test_admin_dapat_menambahkan_role()
{
    $adminRole = Role::where('name', 'Admin')->firstOrFail();
    $admin = User::factory()->create([
        'username' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('admin123'),
        'role_id' => $adminRole->id,
    ]);

    $this->actingAs($admin);

    $response = $this->post('/roles', [
        'name' => 'Manager',
        'description' => 'Mengelola tim dan tugas',
    ]);

    $response->assertRedirect('/roles'); // Sesuaikan dengan redirect setelah sukses
    $this->assertDatabaseHas('roles', ['name' => 'Manager']);
}
    public function test_admin_dapat_mengedit_role()
    {
        $adminRole = Role::where('name', 'Admin')->firstOrFail();
        $admin = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role_id' => $adminRole->id,
        ]);

        $this->actingAs($admin);

        $role = Role::factory()->create(['name' => 'Supervisor']);

        $response = $this->put("/roles/{$role->id}", [
            'name' => 'Supervisor Senior',
            'description' => 'Mengelola proyek dengan tingkat lanjut',
        ]);

        $response->assertRedirect('/roles');
        $this->assertDatabaseHas('roles', ['name' => 'Supervisor Senior']);
    }
    public function test_admin_dapat_menghapus_role()
    {
        $adminRole = Role::where('name', 'Admin')->firstOrFail();
        $admin = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role_id' => $adminRole->id,
        ]);

        $this->actingAs($admin);

        $role = Role::factory()->create(['name' => 'Staff']);

        $response = $this->delete("/roles/{$role->id}");

        $response->assertRedirect('/roles');
        $this->assertDatabaseMissing('roles', ['name' => 'Staff']);
    }
    public function test_admin_dapat_menambahkan_user()
    {
        $adminRole = Role::where('name', 'Admin')->firstOrFail();
        $admin = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role_id' => $adminRole->id,
        ]);

        $this->actingAs($admin);

        $response = $this->post('/users', [
            'username' => 'karyawan1',
            'email' => 'karyawan1@gmail.com',
            'password' => 'password123',
            'role_id' => 2,
        ]);

        $response->assertRedirect('/users');
        $this->assertDatabaseHas('users', ['email' => 'karyawan1@gmail.com']);
    }
    public function test_admin_dapat_mengedit_user()
    {
        $adminRole = Role::where('name', 'Admin')->firstOrFail();
        $admin = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role_id' => $adminRole->id,
        ]);

        $this->actingAs($admin);

        $user = User::factory()->create(['username' => 'user1']);

        $response = $this->post("/users/{$user->id}", [
            'username' => 'user1update',
            'email' => 'user1@gmail.com',
            'role_id' => 2,
            'password' => 'passwordbaru', // Tambahkan password agar validasi tidak gagal
        ]);

        $response->assertRedirect('/users');
        $this->assertDatabaseHas('users', ['username' => 'user1update']);
    }

    public function test_admin_dapat_menghapus_user()
    {
        $adminRole = Role::where('name', 'Admin')->firstOrFail();
        $admin = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role_id' => $adminRole->id,
        ]);

        $this->actingAs($admin);

        $user = User::factory()->create(['username' => 'user2']);

        $response = $this->post("/users/{$user->iduser}/delete");


        $response->assertRedirect('/users');
        $this->assertDatabaseMissing('users', ['username' => 'user2']);
    }
    public function test_user_tidak_dapat_menambahkan_role()
    {
        $userRole = Role::where('name', 'User')->firstOrFail();
        $user = User::factory()->create([
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123'),
            'role_id' => $userRole->id,
        ]);

        $this->actingAs($user);

        $response = $this->post('/roles', [
            'name' => 'Manager',
            'description' => 'Mengelola tim',
        ]);

        $response->assertRedirect('/'); // User biasa diarahkan ke halaman utama
        $this->assertDatabaseMissing('roles', ['name' => 'Manager']);
    }

}

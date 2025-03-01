<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Barang;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BarangTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_barang()
    {
        $barang = Barang::factory()->create([
            'nama_barang' => 'Kursi',
            'deskripsi_barang' => 'Kursi kayu',
            'kategori_barang_id' => 1,
            'jumlah_total' => 40,
            'status' => 'tersedia',
        ]);

        $this->assertDatabaseHas('barangs', [
            'nama_barang' => 'Kursi',
            'deskripsi_barang' => 'Kursi kayu',
        ]);
    }

    public function test_read_barang()
    {
        $barang = Barang::factory()->create();

        $found = Barang::find($barang->id); // Menggunakan 'id', bukan 'barang_id'

        $this->assertNotNull($found);
        $this->assertEquals($barang->nama_barang, $found->nama_barang);
    }

    public function test_update_barang()
    {
        $barang = Barang::factory()->create();

        $barang->update(['nama_barang' => 'Meja Besar']);

        $this->assertDatabaseHas('barangs', ['nama_barang' => 'Meja Besar']);
    }

    public function test_delete_barang()
    {
        $barang = Barang::factory()->create();

        $barang->delete();

        $this->assertDatabaseMissing('barangs', ['id' => $barang->id]); // Menggunakan 'id', bukan 'barang_id'
    }
}

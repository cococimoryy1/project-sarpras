<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase; // Membersihkan database setelah setiap test

    /** @test */
    public function it_can_create_a_category()
    {
        $category = Category::create([
            'nama_kategori' => 'Elektronik',
            'deskripsi' => 'Kategori untuk barang elektronik',
        ]);

        $this->assertDatabaseHas('kategori', [
            'nama_kategori' => 'Elektronik'
        ]);
    }

    /** @test */
    public function it_can_read_category()
    {
        $category = Category::create([
            'nama_kategori' => 'Pakaian',
            'deskripsi' => 'Kategori untuk pakaian',
        ]);

        $found = Category::find($category->id_kategori);
        $this->assertEquals('Pakaian', $found->nama_kategori);
    }

    /** @test */
    public function it_can_update_category()
    {
        $category = Category::create([
            'nama_kategori' => 'Mebel',
            'deskripsi' => 'Kategori untuk furniture',
        ]);

        $category->update(['nama_kategori' => 'Furniture']);
        $this->assertDatabaseHas('kategori', ['nama_kategori' => 'Furniture']);
    }

    /** @test */
    public function it_can_delete_category()
    {
        $category = Category::create([
            'nama_kategori' => 'Alat Rumah Tangga',
            'deskripsi' => 'Kategori peralatan rumah tangga',
        ]);

        $category->delete();
        $this->assertDatabaseMissing('kategori', ['nama_kategori' => 'Alat Rumah Tangga']);
    }
}

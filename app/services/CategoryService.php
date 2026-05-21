<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService {
    // Mengambil semua data kategori
    public function all(): Collection {
        return Category::all(); // [cite: 151]
    }

    // Mencari satu data kategori berdasarkan ID
    public function find(int $id): Category {
        return Category::findOrFail($id); // [cite: 155]
    }

    // Membuat data kategori baru
    public function create(array $data): Category {
        return Category::create($data); // [cite: 158]
    }

    // Memperbarui data kategori
    public function update(int $id, array $data): Category {
        $cat = Category::findOrFail($id); // [cite: 160]
        $cat->update($data); // [cite: 161]
        return $cat; // [cite: 163]
    }

    // Menghapus data kategori
    public function delete(int $id): void {
        Category::destroy($id); // [cite: 165]
    }
}
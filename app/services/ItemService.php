<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;

class ItemService {
    // Mengambil semua data item beserta kategorinya
    public function all(): Collection {
        return Item::with('category')->get(); // [cite: 130]
    }

    // Mencari satu data item berdasarkan ID
    public function find(int $id): Item {
        return Item::with('category')->findOrFail($id); // [cite: 133]
    }

    // Membuat data item baru
    public function create(array $data): Item {
        return Item::create($data); // [cite: 136]
    }

    // Memperbarui data item
    public function update(int $id, array $data): Item {
        $item = Item::findOrFail($id); // [cite: 138]
        $item->update($data); // [cite: 139]
        return $item; // [cite: 141]
    }

    // Menghapus data item
    public function delete(int $id): void {
        Item::destroy($id); // [cite: 143]
    }
}   
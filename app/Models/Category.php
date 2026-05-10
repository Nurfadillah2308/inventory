<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Menentukan kolom mana saja yang boleh diisi manual
    protected $fillable = ['name'];

    // Relasi: Satu kategori punya banyak item
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
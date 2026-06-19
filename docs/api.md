```markdown
# Dokumentasi API Inventory - v1

Dokumentasi ini berisi daftar endpoint API untuk Modul Inventory (Versi 1), lengkap dengan spesifikasi request, sanitasi input, dan format response JSON yang konsisten menggunakan BaseController wrapper.

---
### Filter Items by Category
- Endpoint: `GET /api/v1/items?category_id={id}`
- Description: Filter items by category, optional.

## Format Response Konsisten (BaseController Wrapper)

Semua endpoint pada API ini mengembalikan struktur data JSON yang seragam untuk memudahkan integrasi client-side.

### 1. Struktur Response Sukses
```json
{
  "success": true,
  "message": "Pesan keberhasilan operasi",
  "data": { ... }
}

```

### 2. Struktur Response Gagal / Error

```json
{
  "success": false,
  "message": "Pesan detail error atau alasan kegagalan"
}

```

---

## Kumpulan Endpoint API (Skenario Pengujian Postman)

### Skenario A: Register User Baru

Mendaftarkan akun pengguna baru ke dalam sistem aplikasi.

* **URL:** `/api/v1/register`
* **Method:** `POST`
* **Headers:**
* `Accept: application/json`
* `Content-Type: application/json`


* **Body Request (JSON):**

```json
{
  "name": "Dila",
  "email": "dila@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}

```

* **Response Sukses (201 Created):**

```json
{
  "success": true,
  "message": "User registered successfully.",
  "data": {
    "name": "Dila",
    "email": "dila@example.com"
  }
}

```

### Skenario B: Login User

Melakukan autentikasi untuk mendapatkan Bearer Token.

* **URL:** `/api/v1/login`
* **Method:** `POST`
* **Headers:**
* `Accept: application/json`
* `Content-Type: application/json`


* **Body Request (JSON):**

```json
{
  "email": "dila@example.com",
  "password": "password123"
}

```

* **Response Sukses (200 OK):**

```json
{
  "success": true,
  "message": "Login successful.",
  "data": {
    "token": "1|sanctum_token_kamu_di_sini_xyz..."
  }
}

```

---

## Endpoint Terproteksi (Harus Menggunakan Token)

*Gunakan token dari Skenario B ke dalam Header:* `Authorization: Bearer {token}`

### Skenario C: Mengambil Semua Data Items (GET /api/v1/items)

Melihat seluruh daftar barang yang tersimpan di dalam database menggunakan response wrapper.

* **URL:** `/api/v1/items`
* **Method:** `GET`
* **Headers:**
* `Accept: application/json`
* `Authorization: Bearer 1|sanctum_token_kamu...`


* **Response Sukses (200 OK):**

```json
{
  "success": true,
  "message": "Items retrieved successfully.",
  "data": [
    {
      "id": 1,
      "name": "Laptop",
      "category_id": 1,
      "price": 15000000,
      "stock": 10,
      "description": "Laptop kuliah Dila",
      "category": {
        "id": 1,
        "name": "Elektronik"
      }
    }
  ]
}

```

### Skenario D: Menambah Item dengan Tag HTML (Sanitasi Input)

Menguji pengamanan input teks pada field `name` menggunakan method `prepareForValidation()`. Jika dikirimkan tag HTML seperi `<script>`, sistem akan otomatis membersihkannya.

* **URL:** `/api/v1/items`
* **Method:** `POST`
* **Headers:**
* `Accept: application/json`
* `Content-Type: application/json`
* `Authorization: Bearer 1|sanctum_token_kamu...`


* **Body Request (JSON):**

```json
{
  "name": "<script>Laptop</script>",
  "category_id": 1,
  "price": 15000000,
  "stock": 10,
  "description": "Laptop kuliah Dila"
}

```

* **Response Sukses (201 Created - Terbaca Bersih):**

```json
{
  "success": true,
  "message": "Item created successfully.",
  "data": {
    "id": 2,
    "name": "Laptop",
    "category_id": 1,
    "price": 15000000,
    "stock": 10,
    "description": "Laptop kuliah Dila"
  }
}

```

### Skenario E: Mengakses Data Berdasarkan ID yang Tidak Ada

Menguji penanganan error (`ModelNotFoundException`) jika ID yang diminta tidak terdaftar di database.

* **URL:** `/api/v1/items/999` *(ID acak)*
* **Method:** `GET`
* **Headers:**
* `Accept: application/json`
* `Authorization: Bearer 1|sanctum_token_kamu...`


* **Response Gagal (404 Not Found):**

```json
{
  "success": false,
  "message": "Item not found."
}

```

```

```
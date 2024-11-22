# Website Brand & UI/UX Studio (Trianto Studio)

Trianto Studio adalah website portofolio yang menampilkan layanan desain UI/UX dan branding digital. Website ini mencakup fitur portofolio, testimoni klien, manajemen tim, dan formulir kontak.

---

## **Fitur Utama**
1. **Manajemen Portofolio**: 
   - Tambah, edit, lihat, dan hapus proyek portofolio.
2. **Manajemen Testimoni**:
   - Menampilkan ulasan klien yang puas dengan layanan studio.
3. **Manajemen Tim**:
   - Menampilkan informasi anggota tim, posisi, dan keahlian mereka.
4. **Formulir Kontak**:
   - Formulir untuk menghubungi studio secara langsung.
5. **API CRUD**:
   - Backend mendukung operasi CRUD untuk portofolio, testimoni, kontak, dan tim.

---

## **Struktur Proyek**
frontend/ 
├── assets/ 
│ ├── css/ (File CSS) 
│ ├── js/ (File JS untuk interaksi) 
│ └── img/ (Gambar untuk website) 
├── index.html (Halaman utama) 
├── portfolio.html (Halaman portofolio) 
├── contact.html (Halaman kontak) 
└── testimonials.html (Halaman testimoni)

backend/ 
├── app/ 
│ ├── Config/ (Konfigurasi database) 
│ ├── Controllers/ (Logika CRUD untuk setiap fitur) 
│ ├── Models/ (Model untuk database) 
│ └── Routes/ (Rute API) ├── public/ (Entry point backend) 
├── migrations/ (Script SQL untuk tabel database) 
└── tests/ (Koleksi Postman untuk uji API)


---

## **Persyaratan Sistem**
- PHP >= 7.4
- MySQL >= 5.7
- Web server (XAMPP, Laragon, atau PHP Built-in Server)
- Postman (untuk pengujian API)

---

## **Cara Instalasi**

### **1. Setup Backend**
1. Clone repository ini.
2. Masuk ke folder backend:
   ```bash
   cd backend

Buat file .env berdasarkan contoh berikut
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=
DB_NAME=trianto_studio
DB_PORT=3306
APP_ENV=development
APP_DEBUG=true
APP_URL=http://localhost/backend/public

Jalankan script SQL di migrations/create_tables.sql untuk membuat database.
Jalankan server backend

php -S localhost:8181 -t public

Backend akan berjalan di http://localhost:8181.

2. Setup Frontend
Masuk ke folder frontend:

cd frontend

Jalankan server frontend (opsional)
php -S localhost:8080

Frontend akan berjalan di http://localhost:8080.

API Endpoint
Method	Endpoint	Deskripsi
GET	/api/portfolio	Ambil semua portofolio
GET	/api/portfolio/{id}	Ambil portofolio tertentu
POST	/api/portfolio	Tambah portofolio baru
PUT	/api/portfolio/{id}	Perbarui portofolio
DELETE	/api/portfolio/{id}	Hapus portofolio tertentu
GET	/api/contact	Ambil semua pesan kontak
POST	/api/contact	Kirim pesan kontak baru
GET	/api/testimonials	Ambil semua testimoni
POST	/api/testimonials	Tambah testimoni baru
DELETE	/api/testimonials/{id}	Hapus testimoni tertentu
GET	/api/team	Ambil semua anggota tim
POST	/api/team	Tambah anggota tim baru
DELETE	/api/team/{id}	Hapus anggota tim tertentu
Pengujian API
Gunakan file Postman Collection di backend/tests/postman_collection.json untuk menguji semua endpoint.
Pastikan server backend berjalan sebelum melakukan pengujian.
Kontribusi
Fork repository ini.
Buat branch baru untuk fitur atau bugfix.
Kirim Pull Request dengan deskripsi perubahan.
Lisensi
Proyek ini dilisensikan di bawah MIT License.

Selamat menggunakan Trianto Studio! 🎉


---

### **Penjelasan**
- File ini mencakup semua informasi yang dibutuhkan, dari deskripsi fitur, struktur proyek, cara instalasi, hingga pengujian API.
- Ditulis sepenuhnya dalam format Markdown dan rapi untuk digunakan di repository.

Jika ada tambahan atau revisi yang kamu butuhkan, beri tahu saya ya! 😊
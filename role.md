ini project web untuk booking lapangan dengan nama "Arena Sehat Sport"

Role yang ada adalah
- Admin
- User  

dengan rest API dan menggunakan Laravel 11

dengan ada fitur pada user : 
- register
- login
- lupa password
- ganti password
- booking lapangan
- pembayaran
- notifikasi
- history booking

fitur pada admin adalah :
- manage user
- manage lapangan
- manage foto lapangan
- manage pembayaran
- manage notifikasi
- manage hisotory booking
- manage kategori
- manage jadwal
- manage jam oprational


BACKEND

Buat desain arsitektur backend yang clean dan scalable dengan ketentuan:

1. Gunakan separation of concern:
- Controller (hanya handle request/response)
- Service layer (business logic)
- Form Request (validation)
- Model (Eloquent + relasi)

2. Sertakan:
a. Struktur folder lengkap (best practice Laravel)
b. Contoh implementasi:
    - Controller (clean & tipis)
    - Service (logic utama)
    - Form Request
    - Model dengan relasi
c. Contoh flow request dari client sampai database
3. Tambahkan best practice:
- Pagination
- Filtering & search
- File upload (storage)
- Slug handling
- Error handling
4. (Opsional tapi diutamakan):
- Tambahkan API Resource untuk response
- Tambahkan contoh penggunaan queue (jika relevan)
- Jelaskan bagian mana yang termasuk infrastructure

Buat dengan standar backend engineer (production-ready), bukan sekadar contoh sederhana.


1. Controller: mengurus penerimaan HTTP Request dan pengembalian HTTP Response.
2. Service: Menangani murni business logic (upload file, proses perhitungan, query kompleks, dll).
3. Form Request: Memisahkan logika validasi input dan pengecekan otorisasi (Form Request Class).
4. API Resource: Memformat (transform) struktur data dari Model agar lebih rapi saat diubah ke JSON.
5. Error Handling & Pagination: Diterapkan secara rapi di tingkat Service dan direspons seragam di Controller.



FRONT END

tailwind css + laravel

ada 2 mode : 
- Light
- Dark

pemilihan mode ada di header

color palette
- Primary : #D32F2F
- Secondary : #FFCDD2
- Tertiary : #00799c
- neutral : #212121

font type
- Headline : Lexend Bold
- Body : Inter
- label : Inter
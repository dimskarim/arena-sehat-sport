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
- hisotory booking

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








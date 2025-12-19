# 🍎 Clasification-Apple — README

> Micro-app: Laravel frontend + Flask ML backend

## ✨ Ringkasan Aplikasi

Aplikasi ini adalah prototype sistem klasifikasi kualitas apel:

* **Frontend**: Laravel (PHP) — tampilan, form input, menyimpan hasil ke DB.
* **Backend ML**: Flask (Python) — memuat model `model_apel.joblib` dan memberikan endpoint `/prediksi` untuk menerima fitur apel dan mengembalikan hasil prediksi.
* **Database**: MySQL (db_apel) — menyimpan hasil prediksi di tabel `hasil_prediksi`.

## 🔎 Fitur Utama

* Form input data apel pada Laravel
* Laravel memanggil Flask API untuk prediksi
* Hasil prediksi disimpan ke tabel `hasil_prediksi`
* Metrik model (akurasi, precision, recall) dihitung oleh Flask

---

## 📦 Prasyarat

* PHP 8.5 dengan ekstensi `pdo_mysql` (untuk MySQL) aktif
* Composer
* MySQL / MariaDB
* Python 3.10+ (direkomendasikan sama versi saat model dibuat)
* `virtualenv` atau `venv` untuk Python
* Node & npm (opsional untuk assets Laravel)

---

## 🚀 Instalasi & Menjalankan (Windows - PowerShell)

### 1. Laravel (frontend)

1. Masuk folder frontend Laravel:

```powershell
cd path\to\clasification-apple\frontend
```

2. Install dependency PHP:

```powershell
composer install
```

3. Copy `.env` dan atur database:

```powershell
ubah .env.example menjadi .env
# edit .env menjadi: 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_apel
DB_USERNAME=root
DB_PASSWORD=
```

4. Clear config & cache:

```powershell
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

5. Jalankan server Laravel:

```powershell
php artisan serve
# default: http://127.0.0.1:8000
```

### 2. Python / Flask (backend)

1. Masuk folder backend Flask:

```powershell
cd path\to\clasification-apple\backend
```

2. Buat & aktifkan virtualenv (PowerShell):

```powershell
python -m venv .venv
.\.venv\Scripts\Activate.ps1
```

3. Install dependency Python:

```powershell
pip install -r requirements.txt

# atau install manual dengan cara: 
pip install flask pandas scikit-learn joblib python-dotenv
```

4. Pastikan `.env` Flask berisi (atau set env manual):

```
FLASK_APP=main.py
FLASK_ENV=development
FLASK_RUN_PORT=5000
```

5. Jalankan Flask:

```powershell
python main.py
# atau: 
flask run  
# (butuh python-dotenv to auto load .env)
```

* Flask akan berjalan di [http://127.0.0.1:5000](http://127.0.0.1:5000)

---

## 🔗 Menghubungkan Laravel -> Flask

Di controller Laravel (contoh: `DatasetController`), pastikan memanggil endpoint yang benar:

```php
use Illuminate\Support\Facades\Http;

$response = Http::timeout(60)->asForm()->post('http://127.0.0.1:5000/prediksi', $request->all());
```

Sesuaikan port (`5000`) dengan Flask yang berjalan.

Jalankan:

```bash
php artisan migrate
```

---

## 🛠️ Troubleshooting Cepat

* **cURL error 7**: berarti Flask tidak berjalan pada port yang diminta. Jalankan Flask dan samakan port.
* **could not find driver (sqlite)**: PHP belum mengaktifkan `pdo_sqlite` atau `pdo_mysql`. Aktifkan di `php.ini`.
* **Database connection [mysqli] not configured**: gunakan `DB_CONNECTION=mysql` di `.env` (bukan `mysqli`).
* **Unknown column 'updated_at'**: tambahkan timestamps di tabel atau set `public $timestamps = false;` di model.
* **Import "flask" could not be resolved**: pilih interpreter virtualenv di VS Code (Python: Select Interpreter).
* **Intelephense "Unexpected 'class'"**: hapus BOM, pastikan `<?php` paling atas, dan clear Intelephense cache.
* **sklearn InconsistentVersionWarning**: model dibuat di scikit-learn 1.7.2, sedangkan environment 1.8.0 — disarankan pakai versi sama jika khawatir reproduktibilitas.

---

## ✅ Testing API (curl)

Contoh request ke Flask (POST JSON):

```bash
curl -X POST http://127.0.0.1:5000/prediksi \
-H "Content-Type: application/json" \
-d '{"diameter":7.5,"berat":150,"kadar_gula":12,"warna":"merah","asal_daerah":"Malang","musim_panen":"musim panas"}'
```

---

## 📚 Catatan

* Untuk development: jalankan **dua terminal** terpisah — satu `php artisan serve` untuk Laravel, satu lagi `python main.py` untuk Flask.
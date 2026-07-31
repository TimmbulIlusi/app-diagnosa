<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Cerdas Diagnosa Medis</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f4f7f6; color: #334155; line-height: 1.6; }
        .hero { background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%); color: white; padding: 60px 20px; text-align: center; }
        .hero h1 { font-size: 34px; margin-bottom: 15px; font-weight: 700; }
        .hero p { font-size: 17px; max-width: 700px; margin: 0 auto 25px auto; opacity: 0.9; }
        .btn-cta { background: #f59e0b; color: #fff; padding: 14px 28px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 16px; display: inline-block; box-shadow: 0 4px 12px rgba(0,0,0,0.15); transition: 0.3s; }
        .btn-cta:hover { background: #d97706; }
        
        .container { max-width: 1000px; margin: -40px auto 40px auto; padding: 0 20px; position: relative; }
        .card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border-top: 4px solid #1d4ed8; }
        .card h3 { color: #1e3a8a; margin-bottom: 12px; font-size: 18px; display: flex; align-items: center; gap: 10px; }
        .card p { color: #64748b; font-size: 14px; margin-bottom: 20px; }
        .card a { color: #1d4ed8; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; }
        .card a:hover { text-decoration: underline; }
        .footer { text-align: center; padding: 30px; color: #94a3b8; font-size: 14px; }
    </style>
</head>
<body>
    <div class="hero">
        <h1><i class="fa-solid fa-notes-medical"></i> Sistem Cerdas Diagnosa Medis & Penanganan Penyakit</h1>
        <p>Sistem cerdas berbasis kecerdasan buatan untuk membantu melakukan analisis awal gejala klinis, menyediakan panduan penyakit umum, serta rujukan penanganan medis.</p>
        <a href="/diagnosa" class="btn-cta"><i class="fa-solid fa-stethoscope"></i> Mulai Diagnosa Penyakit Sekarang</a>
    </div>

    <div class="container">
        <div class="card-grid">
            <div class="card">
                <h3><i class="fa-solid fa-stethoscope" style="color: #1d4ed8;"></i> Menu Diagnosa AI</h3>
                <p>Masukkan keluhan gejala Anda. Sistem akan mendiagnosis probabilitas penyakit.</p>
                <a href="/diagnosa">Buka Menu Diagnosa &rarr;</a>
            </div>

            <div class="card">
                <h3><i class="fa-solid fa-book-medical" style="color: #1d4ed8;"></i> Penyakit & First Aid</h3>
                <p>Pelajari berbagai informasi penyakit umum beserta panduan penanganan pertama (*First Aid*) dan rujukan obat medisnya.</p>
                <a href="/informasi/penyakit">Lihat Penyakit Umum &rarr;</a>
            </div>

            <div class="card">
                <h3><i class="fa-solid fa-table" style="color: #1d4ed8;"></i> Informasi Dataset</h3>
                <p>Menampilkan sampel data rekam medis dan rujukan obat yang digunakan dalam basis data (*Knowledge Base*) sistem.</p>
                <a href="/informasi/dataset">Lihat Sampel Dataset &rarr;</a>
            </div>

            <div class="card">
                <h3><i class="fa-solid fa-users" style="color: #1d4ed8;"></i> Informasi Pengembang</h3>
                <p>Menampilkan profil kelompok mahasiswa pengembang mini project tugas mata kuliah.</p>
                <a href="/informasi/pengembang">Lihat Pengembang &rarr;</a>
            </div>
        </div>
    </div>

    <div class="footer">
        &copy; 2026 Mini Project Tugas Kuliah | Sistem Cerdas Diagnosa Medis Berbasis AI
    </div>
</body>
</html>
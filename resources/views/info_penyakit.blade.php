<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <title>Penyakit Umum & First Aid</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f4f7f6; color: #333; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); }
        .nav-bar { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #f1f5f9; padding-bottom: 15px; margin-bottom: 25px; }
        .btn-home { background: #64748b; color: white; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px; }
        .btn-diag { background: #1d4ed8; color: white; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px; margin-left: 10px;}
        
        .disease-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 15px; }
        .disease-box { background: white; border: 1px solid #cbd5e1; padding: 18px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
        .disease-box h4 { color: #1e40af; margin-bottom: 8px; font-size: 16px; border-bottom: 1px dashed #cbd5e1; padding-bottom: 8px;}
        .disease-box p { font-size: 13.5px; color: #475569; margin-bottom: 6px; line-height: 1.5; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav-bar">
            <h2><i class="fa-solid fa-notes-medical" style="color: #1d4ed8;"></i> Informasi Penyakit & First Aid</h2>
            <div>
                <a href="/" class="btn-home"><i class="fa-solid fa-house"></i> Dashboard</a>
                <a href="/diagnosa" class="btn-diag"><i class="fa-solid fa-stethoscope"></i> Diagnosa</a>
            </div>
        </div>

        <p style="color: #64748b; font-size: 15px; margin-bottom: 20px;">Panduan keluhan umum yang sering dialami masyarakat beserta rujukan penanganan awal (First Aid):</p>
        
        <div class="disease-grid">
            <div class="disease-box">
                <h4><i class="fa-solid fa-temperature-high" style="color: #e11d48;"></i> Demam / Flu Biasa</h4>
                <p><strong>Penyebab:</strong> Infeksi virus pada saluran pernapasan atas.</p>
                <p><strong>Penanganan:</strong> Istirahat total, perbanyak minum air hangat, jaga suhu tubuh.</p>
                <p><strong>Rujukan Obat:</strong> Paracetamol / Ibuprofen.</p>
            </div>
            <div class="disease-box">
                <h4><i class="fa-solid fa-face-flushed" style="color: #d97706;"></i> Alergi & Gatal</h4>
                <p><strong>Penyebab:</strong> Reaksi sistem imun terhadap debu, cuaca, atau makanan.</p>
                <p><strong>Penanganan:</strong> Jauhi pemicu alergi, gunakan kompres dingin, jangan digaruk.</p>
                <p><strong>Rujukan Obat:</strong> Cetirizine / Loratadine / Bedak Salicyl.</p>
            </div>
            <div class="disease-box">
                <h4><i class="fa-solid fa-head-side-cough" style="color: #0d9488;"></i> Asam Lambung / GERD</h4>
                <p><strong>Penyebab:</strong> Pola makan tidak teratur, stres, makanan pedas/asam.</p>
                <p><strong>Penanganan:</strong> Makan porsi kecil tapi sering, jangan berbaring setelah makan.</p>
                <p><strong>Rujukan Obat:</strong> Antasida / Omeprazole.</p>
            </div>
            <div class="disease-box">
                <h4><i class="fa-solid fa-toilet" style="color: #8b5cf6;"></i> Diare</h4>
                <p><strong>Penyebab:</strong> Infeksi bakteri dari makanan/air yang kurang higienis.</p>
                <p><strong>Penanganan:</strong> Minum oralit untuk cegah dehidrasi, hindari makanan berserat tinggi sementara waktu.</p>
                <p><strong>Rujukan Obat:</strong> Loperamide / Attapulgite / Oralit.</p>
            </div>
            <div class="disease-box">
                <h4><i class="fa-solid fa-head-side-virus" style="color: #be123c;"></i> Sakit Kepala / Migrain</h4>
                <p><strong>Penyebab:</strong> Ketegangan otot, kurang tidur, dehidrasi, atau stres.</p>
                <p><strong>Penanganan:</strong> Istirahat di ruangan gelap dan tenang, minum air putih cukup.</p>
                <p><strong>Rujukan Obat:</strong> Aspirin / Paracetamol.</p>
            </div>
            <div class="disease-box">
                <h4><i class="fa-solid fa-teeth" style="color: #0369a1;"></i> Sariawan (Stomatitis)</h4>
                <p><strong>Penyebab:</strong> Kurang vitamin C, daya tahan tubuh turun, trauma gigitan.</p>
                <p><strong>Penanganan:</strong> Kumur air garam hangat, perbanyak konsumsi buah.</p>
                <p><strong>Rujukan Obat:</strong> Obat kumur antiseptik / Suplemen Vitamin C.</p>
            </div>
        </div>
    </div>
</body>
</html>
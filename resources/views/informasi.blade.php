<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Informasi & Dataset - Sistem Medis</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f7f6; color: #333; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); border-top: 5px solid #1d4ed8; }
        .nav-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 2px solid #f1f5f9; padding-bottom: 15px; }
        .btn-home { background: #64748b; color: white; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; }
        .btn-home:hover { background: #475569; }
        .btn-diag { background: #1d4ed8; color: white; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; }
        .btn-diag:hover { background: #1e40af; }
        
        .section-title { color: #1e3a8a; font-size: 20px; font-weight: bold; margin-top: 25px; margin-bottom: 15px; display: flex; align-items: center; gap: 8px; border-bottom: 1.5px solid #e2e8f0; padding-bottom: 8px; }
        .card { background: #f8fafc; border: 1.5px solid #e2e8f0; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        
        .disease-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 15px; margin-bottom: 25px; }
        .disease-box { background: white; border: 1px solid #cbd5e1; padding: 15px; border-radius: 8px; }
        .disease-box h4 { color: #1e40af; margin-bottom: 6px; font-size: 16px; }
        .disease-box p { font-size: 13.5px; color: #475569; margin-bottom: 4px; }

        .dev-list { list-style: none; padding: 0; margin-top: 10px; }
        .dev-list li { background: white; padding: 10px 15px; border: 1px solid #cbd5e1; border-radius: 6px; margin-bottom: 8px; font-weight: 600; color: #1e3a8a; display: flex; align-items: center; gap: 10px; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 13px; }
        th, td { border: 1px solid #cbd5e1; padding: 10px 12px; text-align: left; vertical-align: top; }
        th { background: #0f172a; color: white; font-weight: 600; }
        tr:nth-child(even) { background-color: #f8fafc; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav-bar">
            <h2><i class="fa-solid fa-circle-info" style="color: #1d4ed8;"></i> Pusat Informasi Sistem Medis</h2>
            <div style="display: flex; gap: 10px;">
                <a href="/" class="btn-home"><i class="fa-solid fa-house"></i> Dashboard</a>
                <a href="/diagnosa" class="btn-diag"><i class="fa-solid fa-stethoscope"></i> Menu Diagnosa</a>
            </div>
        </div>

        <!-- 1. Informasi Penyakit Umum & Penanganan -->
        <div class="section-title"><i class="fa-solid fa-notes-medical"></i> Informasi Penyakit Umum & Penanganan Pertama (First Aid)</div>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 15px;">Berikut adalah beberapa keluhan atau penyakit umum yang sering dialami beserta rujukan penanganan awal:</p>
        
        <div class="disease-grid">
            <div class="disease-box">
                <h4><i class="fa-solid fa-temperature-high" style="color: #e11d48;"></i> Demam / Flu Biasa (Common Cold)</h4>
                <p><strong>Penyebab:</strong> Infeksi virus saluran pernapasan atas.</p>
                <p><strong>Penanganan:</strong> Istirahat total, perbanyak minum air hangat, konsumsi vitamin C.</p>
                <p><strong>Rujukan Obat:</strong> Paracetamol / Ibuprofen.</p>
            </div>
            <div class="disease-box">
                <h4><i class="fa-solid fa-face-flushed" style="color: #d97706;"></i> Alergi & Gatal (Allergy)</h4>
                <p><strong>Penyebab:</strong> Reaksi imun terhadap debu, makanan, atau cuaca.</p>
                <p><strong>Penanganan:</strong> Hindari pemicu, kompres dingin pada area gatal, hindari menggaruk.</p>
                <p><strong>Rujukan Obat:</strong> Cetirizine / Loratadine.</p>
            </div>
            <div class="disease-box">
                <h4><i class="fa-solid fa-head-side-cough" style="color: #0d9488;"></i> Asam Lambung / GERD</h4>
                <p><strong>Penyebab:</strong> Melemahnya klep kerongkongan bawah, pola makan tidak teratur.</p>
                <p><strong>Penanganan:</strong> Makan porsi kecil tapi sering, hindari makanan pedas dan asam, jangan langsung berbaring setelah makan.</p>
                <p><strong>Rujukan Obat:</strong> Antasida / Omeprazole.</p>
            </div>
        </div>

        <!-- 2. Informasi Dataset -->
        <div class="section-title"><i class="fa-solid fa-table"></i> Informasi Dataset</div>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 15px;">Berikut adalah cuplikan data rekam medis dan rujukan penanganan obat yang digunakan dalam sistem:</p>
        
        <div style="overflow-x: auto; max-height: 400px; border: 1px solid #cbd5e1; border-radius: 6px;">
            <table>
                <thead>
                    <tr>
                        <th width="25%">Nama Obat</th>
                        <th width="30%">Komposisi Aktif</th>
                        <th width="45%">Kegunaan / Indikasi (Uses)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicineRows as $row)
                    <tr>
                        <td><strong>{{ $row['Medicine Name'] ?? '-' }}</strong></td>
                        <td>{{ $row['Composition'] ?? '-' }}</td>
                        <td>{{ $row['Uses'] ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- 3. Informasi Pengembang -->
        <div class="section-title" style="margin-top: 30px;"><i class="fa-solid fa-users"></i> Informasi Pengembang</div>
        <div class="card">
            <p style="margin-bottom: 10px; color: #475569;">Aplikasi Sistem Cerdas Diagnosa Medis & Rujukan Obat ini dikembangkan oleh:</p>
            <ul class="dev-list">
                <li><i class="fa-solid fa-user-graduate" style="color: #1d4ed8;"></i> Hasto Timbul Wawandono</li>
                <li><i class="fa-solid fa-user-graduate" style="color: #1d4ed8;"></i> Ridwan Hidayatullah</li>
                <li><i class="fa-solid fa-user-graduate" style="color: #1d4ed8;"></i> Mohammad Zacky Baihaqie</li>
            </ul>
        </div>
    </div>
</body>
</html>
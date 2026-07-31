<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <title>Informasi Pengembang</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f4f7f6; color: #333; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); text-align: center; }
        .nav-bar { display: flex; justify-content: flex-start; border-bottom: 2px solid #f1f5f9; padding-bottom: 15px; margin-bottom: 25px; }
        .btn-home { background: #64748b; color: white; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px; }
        
        .avatar-icon { font-size: 60px; color: #1d4ed8; margin-bottom: 20px; }
        .dev-list { list-style: none; padding: 0; margin-top: 20px; display: flex; flex-direction: column; gap: 15px; }
        .dev-list li { background: #f8fafc; padding: 15px 20px; border: 1px solid #cbd5e1; border-radius: 8px; font-weight: 600; color: #1e3a8a; font-size: 18px; display: flex; align-items: center; justify-content: center; gap: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav-bar">
            <a href="/" class="btn-home"><i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard</a>
        </div>

        <i class="fa-solid fa-users-gear avatar-icon"></i>
        <h2 style="color: #1e3a8a; margin-bottom: 10px;">Tim Pengembang</h2>
        <p style="color: #64748b; font-size: 15px;">Sistem Cerdas Diagnosa Medis & Rujukan Obat ini dikembangkan sebagai Mini Project Tugas Kuliah oleh:</p>
        
        <ul class="dev-list">
            <li><i class="fa-solid fa-user-graduate" style="color: #1d4ed8;"></i> Hasto Timbul Wawandono</li>
            <li><i class="fa-solid fa-user-graduate" style="color: #1d4ed8;"></i> Ridwan Hidayatullah</li>
            <li><i class="fa-solid fa-user-graduate" style="color: #1d4ed8;"></i> Mohammad Zacky Baihaqie</li>
        </ul>
    </div>
</body>
</html>
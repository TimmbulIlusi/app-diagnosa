<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Diagnosa Medis</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 950px; margin: auto; background: white; padding: 30px; border-radius: 12px; }
        .search-box { width: 100%; padding: 15px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        .symptom-container { height: 350px; overflow-y: auto; border: 1px solid #ddd; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 10px; }
        @media (max-width: 600px) { .grid { grid-template-columns: 1fr; } }
        .submit-btn { width: 100%; padding: 16px; background: #1d4ed8; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; }
        .symptom-item { display: flex; align-items: center; padding: 8px; border: 1px solid #eee; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pilih Gejala</h2>
        <input type="text" id="searchInput" class="search-box" onkeyup="filterGejala()" placeholder="Cari gejala...">
        <form action="/predict" method="POST">
            @csrf
            <div class="symptom-container">
                <div class="grid" id="symptomGrid"></div>
            </div>
            <button type="submit" class="submit-btn">Diagnosa</button>
        </form>
    </div>

    <script>
        const gejala = [
            {"id": "itching", "label": "Gatal-gatal", "en": "Itching"},
            {"id": "skin_rash", "label": "Ruam Kulit", "en": "Skin rash"},
            // ... (Pastikan semua data gejala kamu yang panjang tadi ada di sini) ...
            {"id": "yellow_crust_ooze", "label": "Keropeng Kuning Berair", "en": "Yellow crust ooze"}
        ];

        const grid = document.getElementById('symptomGrid');
        const lang = "{{ $lang }}";

        gejala.forEach(g => {
            let labelEl = document.createElement('label');
            labelEl.className = 'symptom-item';
            labelEl.innerHTML = `<input type="checkbox" name="symptoms[]" value="${g.id}"> <span>${lang === 'id' ? g.label : g.en}</span>`;
            grid.appendChild(labelEl);
        });

        function filterGejala() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let items = document.getElementsByClassName('symptom-item');
            for (let i = 0; i < items.length; i++) {
                items[i].style.display = items[i].innerText.toLowerCase().includes(input) ? "flex" : "none";
            }
        }
    </script>
</body>
</html>
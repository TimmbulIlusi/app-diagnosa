<!DOCTYPE html>
<html lang="{{ $lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if($lang == 'id') Sistem Cerdas Diagnosa Medis @else Smart Medical Diagnosis @endif</title>
    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%); 
            color: #334155; 
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container { 
            width: 100%; 
            max-width: 950px; 
            background: #ffffff; 
            padding: 40px; 
            border-radius: 16px; 
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08); 
            border-top: 6px solid #1d4ed8;
        }
        .header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-bottom: 2px solid #f1f5f9; 
            padding-bottom: 20px; 
            margin-bottom: 20px; 
        }
        .header h2 {
            color: #1e3a8a;
            font-size: 26px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .dashboard-btn {
            background: #f1f5f9;
            color: #334155;
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            border: 1px solid #e2e8f0;
        }
        .dashboard-btn:hover {
            background: #e2e8f0;
            color: #1e3a8a;
        }
        .lang-switcher {
            display: flex;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 30px;
        }
        .lang-btn { 
            text-decoration: none; 
            padding: 6px 16px; 
            color: #64748b; 
            border-radius: 20px; 
            font-size: 14px; 
            font-weight: 600; 
            transition: all 0.3s ease;
        }
        .active-lang { 
            background: #1d4ed8; 
            color: white; 
            box-shadow: 0 2px 8px rgba(29, 78, 216, 0.3);
        }
        
        p.subtitle {
            color: #64748b;
            font-size: 15px;
            margin-bottom: 20px;
        }

        .search-box-wrapper {
            position: relative;
            margin-bottom: 25px;
        }
        .search-box-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
        }
        .search-box { 
            width: 100%; 
            padding: 14px 16px 14px 48px; 
            border: 1.5px solid #cbd5e1; 
            border-radius: 10px; 
            font-size: 15px; 
            outline: none;
            transition: all 0.3s;
            background-color: #fafbfc;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .search-box:focus { 
            border-color: #1d4ed8; 
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(29, 78, 216, 0.1); 
        }

        .symptom-container { 
            height: 380px; 
            overflow-y: auto; 
            border: 1.5px solid #e2e8f0; 
            padding: 20px; 
            border-radius: 10px; 
            background: #f8fafc; 
        }
        .symptom-container::-webkit-scrollbar {
            width: 8px;
        }
        .symptom-container::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); 
            gap: 12px; 
        }
        
        label { 
            display: flex; 
            align-items: center; 
            cursor: pointer; 
            font-size: 14.5px; 
            padding: 10px 14px; 
            border-radius: 8px; 
            background: #ffffff;
            transition: all 0.2s; 
            border: 1px solid #e2e8f0; 
            color: #334155;
            font-weight: 500;
        }
        label:hover { 
            background: #eff6ff; 
            border-color: #bfdbfe; 
            color: #1d4ed8;
        }
        input[type="checkbox"] { 
            margin-right: 12px; 
            cursor: pointer; 
            width: 18px;
            height: 18px;
            accent-color: #1d4ed8;
        }

        .submit-btn { 
            width: 100%; 
            margin-top: 25px; 
            padding: 16px; 
            background-color: #1d4ed8; 
            color: white; 
            border: none; 
            border-radius: 10px; 
            font-size: 16px; 
            font-weight: 700; 
            cursor: pointer; 
            transition: background 0.3s, transform 0.1s;
            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.25);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .submit-btn:hover { 
            background-color: #1e40af; 
        }
        .submit-btn:active {
            transform: scale(0.99);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>
                <i class="fa-solid fa-notes-medical" style="color: #1d4ed8;"></i>
                @if($lang == 'id') Sistem Cerdas Diagnosa Medis @else Smart Medical Diagnosis @endif
            </h2>
            <div class="header-actions">
                <a href="/?lang={{ $lang }}" class="dashboard-btn">
                    <i class="fa-solid fa-house"></i> @if($lang == 'id') Dashboard @else Dashboard @endif
                </a>
                <div class="lang-switcher">
                    <a href="/diagnosa?lang=id" class="lang-btn {{ $lang == 'id' ? 'active-lang' : '' }}">ID</a>
                    <a href="/diagnosa?lang=en" class="lang-btn {{ $lang == 'en' ? 'active-lang' : '' }}">EN</a>
                </div>
            </div>
        </div>

        <p class="subtitle">
            @if($lang == 'id')
                Silakan centang gejala yang Anda rasakan di bawah ini, atau gunakan kolom pencarian untuk menemukannya dengan cepat:
            @else
                Please check the symptoms you are experiencing below, or use the search bar to find them quickly:
            @endif
        </p>
        
        <div class="search-box-wrapper">
            <i class="fa-solid fa-magnifying-glass"></i>
            @if($lang == 'id')
                <input type="text" id="searchInput" class="search-box" onkeyup="filterGejala()" placeholder="Cari keluhan atau gejala (contoh: gatal, demam, pusing)...">
            @else
                <input type="text" id="searchInput" class="search-box" onkeyup="filterGejala()" placeholder="Search symptoms (e.g., itching, fever, headache)...">
            @endif
        </div>

        <form action="/predict" method="POST" id="diagnosisForm">
            @csrf
            <input type="hidden" name="lang" value="{{ $lang }}">
            <input type="hidden" id="errorMsg" value="@if($lang == 'id') Harap centang minimal 1 gejala sebelum mendiagnosis! @else Please select at least 1 symptom before diagnosing! @endif">
            
            <div class="symptom-container">
                <!-- GRID INI DIKOSONGKAN DARI @FOREACH KARENA KITA PAKAI JAVASCRIPT -->
                <div class="grid" id="symptomGrid">
                    <!-- Gejala akan di-render otomatis oleh JavaScript di bawah -->
                </div>
            </div>
            
            <button type="submit" class="submit-btn">
                <i class="fa-solid fa-stethoscope" style="margin-right: 8px;"></i>
                @if($lang == 'id') Mulai Proses Diagnosis AI @else Start AI Diagnosis Process @endif
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DATA GEJALA DI-HARDCODE AGAR TIDAK ERROR MESKIPUN SERVER PYTHON MATI
            const currentLang = '{{ $lang }}';
            const gejala = [
                {"id": "itching", "label": "Gatal-gatal", "en": "Itching"},
                {"id": "skin_rash", "label": "Ruam Kulit", "en": "Skin rash"},
                {"id": "nodal_skin_eruptions", "label": "Benjolan Kulit", "en": "Nodal skin eruptions"},
                {"id": "continuous_sneezing", "label": "Bersin Terus-menerus", "en": "Continuous sneezing"},
                {"id": "shivering", "label": "Menggigil", "en": "Shivering"},
                {"id": "chills", "label": "Panas Dingin", "en": "Chills"},
                {"id": "joint_pain", "label": "Nyeri Sendi", "en": "Joint pain"},
                {"id": "stomach_pain", "label": "Sakit Perut", "en": "Stomach pain"},
                {"id": "acidity", "label": "Asam Lambung", "en": "Acidity"},
                {"id": "ulcers_on_tongue", "label": "Sariawan", "en": "Ulcers on tongue"},
                {"id": "muscle_wasting", "label": "Otot Mengecil", "en": "Muscle wasting"},
                {"id": "vomiting", "label": "Muntah", "en": "Vomiting"},
                {"id": "burning_micturition", "label": "Urin Terasa Panas", "en": "Burning micturition"},
                {"id": "spotting_ urination", "label": "Urin Bercak Darah", "en": "Spotting urination"},
                {"id": "fatigue", "label": "Kelelahan", "en": "Fatigue"},
                {"id": "weight_gain", "label": "Berat Badan Naik", "en": "Weight gain"},
                {"id": "anxiety", "label": "Kecemasan", "en": "Anxiety"},
                {"id": "cold_hands_and_feets", "label": "Tangan dan Kaki Dingin", "en": "Cold hands and feets"},
                {"id": "mood_swings", "label": "Perubahan Mood", "en": "Mood swings"},
                {"id": "weight_loss", "label": "Berat Badan Turun", "en": "Weight loss"},
                {"id": "restlessness", "label": "Gelisah", "en": "Restlessness"},
                {"id": "lethargy", "label": "Lesu", "en": "Lethargy"},
                {"id": "patches_in_throat", "label": "Bercak di Tenggorokan", "en": "Patches in throat"},
                {"id": "irregular_sugar_level", "label": "Gula Darah Tidak Teratur", "en": "Irregular sugar level"},
                {"id": "cough", "label": "Batuk", "en": "Cough"},
                {"id": "high_fever", "label": "Demam Tinggi", "en": "High fever"},
                {"id": "sunken_eyes", "label": "Mata Cekung", "en": "Sunken eyes"},
                {"id": "breathlessness", "label": "Sesak Napas", "en": "Breathlessness"},
                {"id": "sweating", "label": "Berkeringat Berlebih", "en": "Sweating"},
                {"id": "dehydration", "label": "Dehidrasi", "en": "Dehydration"},
                {"id": "indigestion", "label": "Gangguan Pencernaan", "en": "Indigestion"},
                {"id": "headache", "label": "Sakit Kepala", "en": "Headache"},
                {"id": "yellowish_skin", "label": "Kulit Menguning", "en": "Yellowish skin"},
                {"id": "dark_urine", "label": "Urin Gelap", "en": "Dark urine"},
                {"id": "nausea", "label": "Mual", "en": "Nausea"},
                {"id": "loss_of_appetite", "label": "Hilang Nafsu Makan", "en": "Loss of appetite"},
                {"id": "pain_behind_the_eyes", "label": "Nyeri Belakang Mata", "en": "Pain behind the eyes"},
                {"id": "back_pain", "label": "Nyeri Punggung", "en": "Back pain"},
                {"id": "constipation", "label": "Sembelit", "en": "Constipation"},
                {"id": "abdominal_pain", "label": "Nyeri Perut", "en": "Abdominal pain"},
                {"id": "diarrhoea", "label": "Diare", "en": "Diarrhoea"},
                {"id": "mild_fever", "label": "Demam Ringan", "en": "Mild fever"},
                {"id": "yellow_urine", "label": "Urin Kuning", "en": "Yellow urine"},
                {"id": "yellowing_of_eyes", "label": "Mata Menguning", "en": "Yellowing of eyes"},
                {"id": "acute_liver_failure", "label": "Gagal Hati Akut", "en": "Acute liver failure"},
                {"id": "fluid_overload", "label": "Kelebihan Cairan", "en": "Fluid overload"},
                {"id": "swelling_of_stomach", "label": "Perut Membengkak", "en": "Swelling of stomach"},
                {"id": "swelled_lymph_nodes", "label": "Kelenjar Getah Bening Bengkak", "en": "Swelled lymph nodes"},
                {"id": "malaise", "label": "Tidak Enak Badan", "en": "Malaise"},
                {"id": "blurred_and_distorted_vision", "label": "Penglihatan Kabur", "en": "Blurred and distorted vision"},
                {"id": "phlegm", "label": "Dahak", "en": "Phlegm"},
                {"id": "throat_irritation", "label": "Iritasi Tenggorokan", "en": "Throat irritation"},
                {"id": "redness_of_eyes", "label": "Mata Merah", "en": "Redness of eyes"},
                {"id": "sinus_pressure", "label": "Tekanan Sinus", "en": "Sinus pressure"},
                {"id": "runny_nose", "label": "Hidung Meler", "en": "Runny nose"},
                {"id": "congestion", "label": "Hidung Tersumbat", "en": "Congestion"},
                {"id": "chest_pain", "label": "Nyeri Dada", "en": "Chest pain"},
                {"id": "weakness_in_limbs", "label": "Lemah Anggota Gerak", "en": "Weakness in limbs"},
                {"id": "fast_heart_rate", "label": "Detak Jantung Cepat", "en": "Fast heart rate"},
                {"id": "pain_during_bowel_movements", "label": "Nyeri Saat BAB", "en": "Pain during bowel movements"},
                {"id": "pain_in_anal_region", "label": "Nyeri Area Anus", "en": "Pain in anal region"},
                {"id": "bloody_stool", "label": "BAB Berdarah", "en": "Bloody stool"},
                {"id": "irritation_in_anus", "label": "Iritasi Anus", "en": "Irritation in anus"},
                {"id": "neck_pain", "label": "Nyeri Leher", "en": "Neck pain"},
                {"id": "dizziness", "label": "Pusing Berputar", "en": "Dizziness"},
                {"id": "cramps", "label": "Kram", "en": "Cramps"},
                {"id": "bruising", "label": "Memar", "en": "Bruising"},
                {"id": "obesity", "label": "Obesitas", "en": "Obesity"},
                {"id": "swollen_legs", "label": "Kaki Bengkak", "en": "Swollen legs"},
                {"id": "swollen_blood_vessels", "label": "Pembuluh Darah Bengkak", "en": "Swollen blood vessels"},
                {"id": "puffy_face_and_eyes", "label": "Wajah & Mata Bengkak", "en": "Puffy face and eyes"},
                {"id": "enlarged_thyroid", "label": "Tiroid Membesar", "en": "Enlarged thyroid"},
                {"id": "brittle_nails", "label": "Kuku Rapuh", "en": "Brittle nails"},
                {"id": "swollen_extremeties", "label": "Ujung Gerak Bengkak", "en": "Swollen extremeties"},
                {"id": "excessive_hunger", "label": "Sangat Lapar", "en": "Excessive hunger"},
                {"id": "extra_marital_contacts", "label": "Riwayat Kontak Seksual", "en": "Extra marital contacts"},
                {"id": "drying_and_tingling_lips", "label": "Bibir Kering Kesemutan", "en": "Drying and tingling lips"},
                {"id": "slurred_speech", "label": "Bicara Cadel", "en": "Slurred speech"},
                {"id": "knee_pain", "label": "Nyeri Lutut", "en": "Knee pain"},
                {"id": "hip_joint_pain", "label": "Nyeri Sendi Panggul", "en": "Hip joint pain"},
                {"id": "muscle_weakness", "label": "Kelemahan Otot", "en": "Muscle weakness"},
                {"id": "stiff_neck", "label": "Leher Kaku", "en": "Stiff neck"},
                {"id": "swelling_joints", "label": "Sendi Bengkak", "en": "Swelling joints"},
                {"id": "movement_stiffness", "label": "Kaku Bergerak", "en": "Movement stiffness"},
                {"id": "spinning_movements", "label": "Gerakan Berputar", "en": "Spinning movements"},
                {"id": "loss_of_balance", "label": "Hilang Keseimbangan", "en": "Loss of balance"},
                {"id": "unsteadiness", "label": "Goyah / Sempoyongan", "en": "Unsteadiness"},
                {"id": "weakness_of_one_body_side", "label": "Lemah Tubuh Sebelah", "en": "Weakness of one body side"},
                {"id": "loss_of_smell", "label": "Hilang Penciuman", "en": "Loss of smell"},
                {"id": "bladder_discomfort", "label": "Tidak Nyaman Kandung Kemih", "en": "Bladder discomfort"},
                {"id": "foul_smell_of urine", "label": "Urin Berbau Menyengat", "en": "Foul smell of urine"},
                {"id": "continuous_feel_of_urine", "label": "Terus Ingin BAK", "en": "Continuous feel of urine"},
                {"id": "passage_of_gases", "label": "Sering Buang Gas", "en": "Passage of gases"},
                {"id": "internal_itching", "label": "Gatal Internal", "en": "Internal itching"},
                {"id": "toxic_look_(typhos)", "label": "Tampak Sangat Sakit (Tifus)", "en": "Toxic look (typhos)"},
                {"id": "depression", "label": "Depresi", "en": "Depression"},
                {"id": "irritability", "label": "Mudah Marah", "en": "Irritability"},
                {"id": "muscle_pain", "label": "Nyeri Otot", "en": "Muscle pain"},
                {"id": "altered_sensorium", "label": "Kesadaran Menurun", "en": "Altered sensorium"},
                {"id": "red_spots_over_body", "label": "Bintik Merah di Tubuh", "en": "Red spots over body"},
                {"id": "belly_pain", "label": "Sakit Perut Bawah", "en": "Belly pain"},
                {"id": "abnormal_menstruation", "label": "Menstruasi Tidak Normal", "en": "Abnormal menstruation"},
                {"id": "dischromic _patches", "label": "Bercak Warna Kulit", "en": "Dischromic patches"},
                {"id": "watering_from_eyes", "label": "Mata Berair", "en": "Watering from eyes"},
                {"id": "increased_appetite", "label": "Nafsu Makan Bertambah", "en": "Increased appetite"},
                {"id": "polyuria", "label": "Banyak Buang Air Kecil", "en": "Polyuria"},
                {"id": "family_history", "label": "Riwayat Keluarga", "en": "Family history"},
                {"id": "mucoid_sputum", "label": "Dahak Lendir", "en": "Mucoid sputum"},
                {"id": "rusty_sputum", "label": "Dahak Berkarat/Berdarah", "en": "Rusty sputum"},
                {"id": "lack_of_concentration", "label": "Kurang Konsentrasi", "en": "Lack of concentration"},
                {"id": "visual_disturbances", "label": "Gangguan Penglihatan", "en": "Visual disturbances"},
                {"id": "receiving_blood_transfusion", "label": "Menerima Transfusi Darah", "en": "Receiving blood transfusion"},
                {"id": "receiving_unsterile_injections", "label": "Menerima Suntikan Tidak Steril", "en": "Receiving unsterile injections"},
                {"id": "coma", "label": "Koma", "en": "Coma"},
                {"id": "stomach_bleeding", "label": "Pendarahan Lambung", "en": "Stomach bleeding"},
                {"id": "distention_of_abdomen", "label": "Perut Kembung", "en": "Distention of abdomen"},
                {"id": "history_of_alcohol_consumption", "label": "Riwayat Konsumsi Alkohol", "en": "History of alcohol consumption"},
                {"id": "fluid_overload.1", "label": "Kelebihan Cairan Berlebih", "en": "Fluid overload.1"},
                {"id": "blood_in_sputum", "label": "Darah Pada Dahak", "en": "Blood in sputum"},
                {"id": "prominent_veins_on_calf", "label": "Urat Menonjol di Betis", "en": "Prominent veins on calf"},
                {"id": "palpitations", "label": "Jantung Berdebar", "en": "Palpitations"},
                {"id": "painful_walking", "label": "Nyeri Saat Berjalan", "en": "Painful walking"},
                {"id": "pus_filled_pimples", "label": "Jerawat Bernanah", "en": "Pus filled pimples"},
                {"id": "blackheads", "label": "Komedo Hitam", "en": "Blackheads"},
                {"id": "scurring", "label": "Bopeng/Bekas Luka", "en": "Scurring"},
                {"id": "skin_peeling", "label": "Kulit Mengelupas", "en": "Skin peeling"},
                {"id": "silver_like_dusting", "label": "Serbuk Putih di Kulit", "en": "Silver like dusting"},
                {"id": "small_dents_in_nails", "label": "Penyok Kecil di Kuku", "en": "Small dents in nails"},
                {"id": "inflammatory_nails", "label": "Kuku Meradang", "en": "Inflammatory nails"},
                {"id": "blister", "label": "Lepuh", "en": "Blister"},
                {"id": "red_sore_around_nose", "label": "Luka Merah Sekitar Hidung", "en": "Red sore around nose"},
                {"id": "yellow_crust_ooze", "label": "Keropeng Kuning Berair", "en": "Yellow crust ooze"}
            ];

            const grid = document.getElementById('symptomGrid');
            
            // Masukkan semua gejala ke dalam HTML secara instan
            gejala.forEach(g => {
                let textLabel = currentLang === 'id' ? g.label : g.en;
                let labelEl = document.createElement('label');
                labelEl.className = 'symptom-item';
                labelEl.innerHTML = `
                    <input type="checkbox" name="symptoms[]" value="${g.id}">
                    <span class="symptom-text">${textLabel}</span>
                `;
                grid.appendChild(labelEl);
            });
        });

        function filterGejala() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let labels = document.getElementsByClassName('symptom-item');
            
            for (let i = 0; i < labels.length; i++) {
                let text = labels[i].getElementsByClassName('symptom-text')[0].innerText.toLowerCase();
                if (text.includes(input)) {
                    labels[i].style.display = "flex";
                } else {
                    labels[i].style.display = "none";
                }
            }
        }

        document.getElementById('diagnosisForm').addEventListener('submit', function(e) {
            let checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            if (checkboxes.length === 0) {
                e.preventDefault(); 
                let msg = document.getElementById('errorMsg').value;
                alert(msg);
            }
        });
    </script>
</body>
</html>
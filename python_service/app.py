from flask import Flask, request, jsonify
import pandas as pd
import pickle
import numpy as np
import re

app = Flask(__name__)

# Load Model AI, Daftar Gejala, dan Kamus Gejala dari file pickle
with open('model.pkl', 'rb') as f:
    data = pickle.load(f)
    model = data['model']
    symptoms_list = data['symptoms']
    kamus_gejala = data['dictionary']

# Load Knowledge Base Obat dari CSV
medicine_df = pd.read_csv('datasets/Medicine_Details.csv')
medicine_df['Uses'] = medicine_df['Uses'].fillna('') 

# Kamus Pemetaan Penyakit & Rujukan Dokter Spesialis (Lengkap)
kamus_penyakit = {
    'Acne': {'id': 'Jerawat (Acne)', 'dokter': 'Dokter Spesialis Kulit (Dermatolog)', 'keyword': 'acne'},
    'Fungal infection': {'id': 'Infeksi Jamur', 'dokter': 'Dokter Spesialis Kulit (Dermatolog)', 'keyword': 'fungal|fungi|skin|antifungal'},
    'Allergy': {'id': 'Alergi', 'dokter': 'Dokter Spesialis Alergi dan Imunologi', 'keyword': 'allerg'},
    'GERD': {'id': 'Asam Lambung (GERD)', 'dokter': 'Dokter Spesialis Penyakit Dalam (Gastroenterologi)', 'keyword': 'gerd|acid|stomach'},
    'Chronic cholestasis': {'id': 'Kolestasis Kronis (Masalah Empedu)', 'dokter': 'Dokter Spesialis Penyakit Dalam (Hepatologi)', 'keyword': 'liver|bile'},
    'Drug Reaction': {'id': 'Reaksi Obat', 'dokter': 'Dokter Umum / IGD', 'keyword': 'allerg|reaction'},
    'Peptic ulcer diseae': {'id': 'Tukak Lambung', 'dokter': 'Dokter Spesialis Penyakit Dalam (Gastroenterologi)', 'keyword': 'ulcer|stomach'},
    'AIDS': {'id': 'HIV / AIDS', 'dokter': 'Dokter Spesialis Penyakit Dalam (Tropis & Infeksi)', 'keyword': 'hiv|immun'},
    'Diabetes ': {'id': 'Diabetes Mellitus', 'dokter': 'Dokter Spesialis Penyakit Dalam (Endokrinologi)', 'keyword': 'diabet|sugar'},
    'Gastroenteritis': {'id': 'Muntaber (Gastroenteritis)', 'dokter': 'Dokter Umum / Penyakit Dalam', 'keyword': 'gastro|diarrh'},
    'Bronchial Asthma': {'id': 'Asma Bronkial', 'dokter': 'Dokter Spesialis Paru (Pulmonologi)', 'keyword': 'asthma|bronch'},
    'Hypertension ': {'id': 'Hipertensi (Darah Tinggi)', 'dokter': 'Dokter Spesialis Jantung atau Penyakit Dalam', 'keyword': 'hypertens|pressure'},
    'Migraine': {'id': 'Migrain / Sakit Kepala Sebelah', 'dokter': 'Dokter Spesialis Saraf (Neurologi)', 'keyword': 'migrain|headache'},
    'Cervical spondylosis': {'id': 'Spondilosis Servikal (Pengapuran Leher)', 'dokter': 'Dokter Spesialis Saraf / Ortopedi', 'keyword': 'spondyl|cervical|pain'},
    'Paralysis (brain hemorrhage)': {'id': 'Lumpuh (Pendarahan Otak)', 'dokter': 'Dokter Spesialis Saraf / Bedah Saraf (IGD)', 'keyword': 'brain|paraly'},
    'Jaundice': {'id': 'Penyakit Kuning', 'dokter': 'Dokter Spesialis Penyakit Dalam (Hepatologi)', 'keyword': 'jaundice|liver'},
    'Malaria': {'id': 'Malaria', 'dokter': 'Dokter Spesialis Penyakit Dalam (Tropis & Infeksi)', 'keyword': 'malaria|fever'},
    'Chicken pox': {'id': 'Cacar Air', 'dokter': 'Dokter Spesialis Kulit (Dermatolog) / Umum', 'keyword': 'pox|chicken'},
    'Dengue': {'id': 'Demam Berdarah Dengue (DBD)', 'dokter': 'Dokter Spesialis Penyakit Dalam / IGD', 'keyword': 'dengue|fever'},
    'Typhoid': {'id': 'Tifus (Tipes)', 'dokter': 'Dokter Spesialis Penyakit Dalam', 'keyword': 'typhoid|fever'},
    'hepatitis A': {'id': 'Hepatitis A', 'dokter': 'Dokter Spesialis Penyakit Dalam (Hepatologi)', 'keyword': 'hepatitis|liver'},
    'Hepatitis B': {'id': 'Hepatitis B', 'dokter': 'Dokter Spesialis Penyakit Dalam (Hepatologi)', 'keyword': 'hepatitis|liver'},
    'Hepatitis C': {'id': 'Hepatitis C', 'dokter': 'Dokter Spesialis Penyakit Dalam (Hepatologi)', 'keyword': 'hepatitis|liver'},
    'Hepatitis D': {'id': 'Hepatitis D', 'dokter': 'Dokter Spesialis Penyakit Dalam (Hepatologi)', 'keyword': 'hepatitis|liver'},
    'Hepatitis E': {'id': 'Hepatitis E', 'dokter': 'Dokter Spesialis Penyakit Dalam (Hepatologi)', 'keyword': 'hepatitis|liver'},
    'Alcoholic hepatitis': {'id': 'Hepatitis Alkoholik', 'dokter': 'Dokter Spesialis Penyakit Dalam (Hepatologi)', 'keyword': 'hepatitis|liver'},
    'Tuberculosis': {'id': 'Tuberkulosis (TBC)', 'dokter': 'Dokter Spesialis Paru (Pulmonologi)', 'keyword': 'tubercul|tb'},
    'Common Cold': {'id': 'Flu Biasa', 'dokter': 'Dokter Umum', 'keyword': 'cold|cough|fever'},
    'Pneumonia': {'id': 'Pneumonia (Paru-Paru Basah)', 'dokter': 'Dokter Spesialis Paru (Pulmonologi)', 'keyword': 'pneumon|lung'},
    'Dimorphic hemmorhoids(piles)': {'id': 'Ambeien / Wasir', 'dokter': 'Dokter Spesialis Bedah (Digestif)', 'keyword': 'piles|hemmor'},
    'Heart attack': {'id': 'Serangan Jantung', 'dokter': 'Dokter Spesialis Jantung (Kardiologi) - Segera ke IGD!', 'keyword': 'heart|cardiac'},
    'Varicose veins': {'id': 'Varises', 'dokter': 'Dokter Spesialis Bedah Vaskuler', 'keyword': 'varicose|vein'},
    'Hypothyroidism': {'id': 'Hipotiroidisme', 'dokter': 'Dokter Spesialis Penyakit Dalam (Endokrinologi)', 'keyword': 'thyroid'},
    'Hyperthyroidism': {'id': 'Hipertiroidisme', 'dokter': 'Dokter Spesialis Penyakit Dalam (Endokrinologi)', 'keyword': 'thyroid'},
    'Hypoglycemia': {'id': 'Gula Darah Rendah (Hipoglikemia)', 'dokter': 'Dokter Spesialis Penyakit Dalam / IGD', 'keyword': 'sugar|hypoglyc'},
    'Osteoarthristis': {'id': 'Osteoartritis (Pengapuran Sendi)', 'dokter': 'Dokter Spesialis Ortopedi atau Reumatologi', 'keyword': 'arthrit|joint'},
    'Arthritis': {'id': 'Radang Sendi (Artritis)', 'dokter': 'Dokter Spesialis Penyakit Dalam (Reumatologi)', 'keyword': 'arthrit|joint'},
    '(vertigo) Paroymsal  Positional Vertigo': {'id': 'Vertigo Posisi (BPPV)', 'dokter': 'Dokter Spesialis Saraf (Neurologi) atau THT', 'keyword': 'vertigo|dizzin'},
    'Urinary tract infection': {'id': 'Infeksi Saluran Kemih (ISK)', 'dokter': 'Dokter Spesialis Urologi', 'keyword': 'urin|infect'},
    'Psoriasis': {'id': 'Psoriasis (Penyakit Kulit Autoimun)', 'dokter': 'Dokter Spesialis Kulit (Dermatolog)', 'keyword': 'psoriasis|skin'},
    'Impetigo': {'id': 'Impetigo (Infeksi Bakteri Kulit)', 'dokter': 'Dokter Spesialis Kulit (Dermatolog)', 'keyword': 'impetigo|skin'}
}

def terjemahkan_efek_samping(teks, lang):
    if pd.isna(teks) or not str(teks).strip():
        return "-"
    
    teks_str = str(teks).strip()
    
    if ',' not in teks_str:
        teks_str = re.sub(r'(?<=[a-z])\s+(?=[A-Z])', ', ', teks_str)
        teks_str = re.sub(r'(?<=[a-z])(?=[A-Z])', ', ', teks_str)

    if lang == 'id':
        kamus_frasa = {
            'rectal bleeding': 'Pendarahan rektum', 'taste change': 'Perubahan rasa',
            'headache': 'Sakit kepala', 'nosebleeds': 'Mimisan', 'back pain': 'Nyeri punggung',
            'dry skin': 'Kulit kering', 'high blood pressure': 'Tekanan darah tinggi',
            'protein in urine': 'Protein dalam urin', 'inflammation of the nose': 'Peradangan hidung',
            'vomiting': 'Muntah', 'nausea': 'Mual', 'diarrhea': 'Diare',
            'abdominal pain': 'Sakit perut', 'upset stomach': 'Gangguan lambung',
            'dizziness': 'Pusing', 'rash': 'Ruam kulit', 'fatigue': 'Kelelahan',
            'drowsiness': 'Mengantuk', 'pain': 'Nyeri', 'sore throat': 'Sakit tenggorokan',
            'constipation': 'Sembelit', 'weight gain': 'Peningkatan berat badan',
            'blurred vision': 'Pandangan kabur', 'dryness in mouth': 'Mulut kering',
            'loss of appetite': 'Hilangnya nafsu makan', 'muscle pain': 'Nyeri otot',
            'joint pain': 'Nyeri sendi', 'weakness': 'Kelemahan tubuh', 'insomnia': 'Insomnia',
            'cough': 'Batuk', 'fever': 'Demam', 'chest pain': 'Nyeri dada',
            'shortness of breath': 'Sesak napas', 'sweating': 'Berkeringat berlebih',
            'blisters': 'Lepuh', 'skin peeling': 'Kulit mengelupas', 'swelling': 'Pembengkakan',
            'application site irritation': 'Iritasi di area penggunaan'
        }
        
        sorted_keys = sorted(kamus_frasa.keys(), key=len, reverse=True)
        for en_phrase in sorted_keys:
            id_phrase = kamus_frasa[en_phrase]
            pattern = re.compile(re.escape(en_phrase), re.IGNORECASE)
            teks_str = pattern.sub(id_phrase, teks_str)
            
    return teks_str

def bersihkan_nama_obat(nama_asli):
    return re.sub(r'\b(Tablet|Capsule|Caps|Gel|Cream|Soap|Injection|Syrup|Drop)\b.*', '', str(nama_asli), flags=re.IGNORECASE).strip()

def tentukan_kategori_awam(nama_obat):
    nama_lower = str(nama_obat).lower()
    if 'gel' in nama_lower or 'cream' in nama_lower or 'ointment' in nama_lower:
        return 'Salep / Krim Luar'
    elif 'tablet' in nama_lower:
        return 'Obat Tablet (Minum)'
    elif 'capsule' in nama_lower or 'caps' in nama_lower:
        return 'Obat Kapsul (Minum)'
    else:
        return 'Obat Medis Umum'

@app.route('/api/symptoms', methods=['GET'])
def get_symptoms():
    lang = request.args.get('lang', 'id')
    gejala_display = []
    for s in symptoms_list:
        en_name = s.replace('_', ' ').capitalize()
        tampil = kamus_gejala.get(s, en_name) if lang == 'id' else en_name
        gejala_display.append({'id': s, 'label': tampil})
    return jsonify(gejala_display)

@app.route('/api/predict', methods=['POST'])
def predict_api():
    req = request.json or {}
    lang = req.get('lang', 'id')
    selected_symptoms = req.get('symptoms', [])
    
    input_data = [0] * len(symptoms_list)
    tampilan_gejala_dipilih = []
    
    for symptom in selected_symptoms:
        if symptom in symptoms_list:
            index = symptoms_list.index(symptom)
            input_data[index] = 1
            en_name = symptom.replace('_', ' ').capitalize()
            tampil = kamus_gejala.get(symptom, en_name) if lang == 'id' else en_name
            tampilan_gejala_dipilih.append(tampil)
            
    probabilities = model.predict_proba([input_data])[0]
    classes = model.classes_
    top_indices = np.argsort(probabilities)[::-1][:3]
    
    top_predictions = []
    for idx in top_indices:
        p_raw = classes[idx]
        prob_val = round(probabilities[idx] * 100, 1)
        if prob_val > 0:
            p_name = kamus_penyakit.get(p_raw, {}).get('id', p_raw) if lang == 'id' else p_raw
            # Menyediakan key 'penyakit' & 'disease' serta angka murni 'probabilitas'
            top_predictions.append({
                'penyakit': p_name,
                'disease': p_name,
                'probabilitas': prob_val,
                'probability': prob_val
            })
            
    primary_raw = classes[top_indices[0]] if len(top_indices) > 0 else ''
    dokter_rujukan = kamus_penyakit.get(primary_raw, {}).get('dokter', 'Dokter Umum / Spesialis')
    
    # 1. Pencarian obat berdasarkan keyword penyakit
    keyword_pencarian = kamus_penyakit.get(primary_raw, {}).get('keyword', primary_raw.lower())
    mask = medicine_df['Uses'].str.contains(keyword_pencarian, case=False, na=False)
    rekomendasi = medicine_df[mask].head(3)
    
    # 2. Cadangan pencarian jika keyword belum menemukan hasil
    if rekomendasi.empty and primary_raw:
        kata_utama = primary_raw.split()[0]
        mask_fallback = medicine_df['Uses'].str.contains(kata_utama, case=False, na=False)
        rekomendasi = medicine_df[mask_fallback].head(3)

    # 3. Cadangan pencarian berdasarkan gejala terpilih
    if rekomendasi.empty and selected_symptoms:
        map_gejala_obat = {
            'high_fever': 'fever', 'joint_pain': 'pain', 'headache': 'headache', 
            'diarrhoea': 'diarrhea', 'vomiting': 'vomiting', 'itching': 'skin'
        }
        for gejala in selected_symptoms:
            if gejala in map_gejala_obat:
                mask_gejala = medicine_df['Uses'].str.contains(map_gejala_obat[gejala], case=False, na=False)
                rekomendasi = medicine_df[mask_gejala].head(3)
                if not rekomendasi.empty:
                    break
                    
    # Format list of dictionaries agar sesuai persis dengan Blade:
    # {{ $obat['Medicine Name'] }}, {{ $obat['Kategori'] }}, {{ $obat['Composition'] }}, {{ $obat['Side_effects'] }}
    obat_list = []
    for index, row in rekomendasi.iterrows():
        nama_asli = row.get('Medicine Name', '-')
        obat_list.append({
            'Medicine Name': bersihkan_nama_obat(nama_asli),
            'Kategori': tentukan_kategori_awam(nama_asli),
            'Composition': row.get('Composition', '-'),
            'Side_effects': terjemahkan_efek_samping(row.get('Side_effects', ''), lang)
        })
    
    pesan_saran = ''
    if not obat_list:
        pesan_saran = 'Disarankan untuk beristirahat cukup, mencukupi kebutuhan cairan tubuh, dan mengonsumsi makanan bergizi seimbang sambil menunggu pemeriksaan dokter.' if lang == 'id' else 'It is recommended to get enough rest, stay hydrated, and eat a balanced diet while waiting for a doctor consultation.'
    
    return jsonify({
        'top_predictions': top_predictions,
        'medicines': obat_list,
        'saran_umum': pesan_saran,
        'gejala_terpilih': tampilan_gejala_dipilih,
        'dokter': dokter_rujukan
    })

if __name__ == '__main__':
    app.run(port=5000, debug=True)
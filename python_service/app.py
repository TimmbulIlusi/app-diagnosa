from flask import Flask, request, jsonify
import pandas as pd
import pickle
import numpy as np
import re
import os

app = Flask(__name__)

BASE_DIR = os.path.dirname(os.path.abspath(__file__))

# Path File
TRAINING_PATH = os.path.join(BASE_DIR, '../public/csv/Training.csv')
MEDICINE_PATH = os.path.join(BASE_DIR, '../public/csv/Medicine_Details.csv')
MODEL_PATH = os.path.join(BASE_DIR, 'model.pkl')

# Load semua data
with open(MODEL_PATH, 'rb') as f:
    data = pickle.load(f)
    model = data['model']
    symptoms_list = data['symptoms']
    kamus_gejala = data['dictionary']

medicine_df = pd.read_csv(MEDICINE_PATH)
medicine_df['Uses'] = medicine_df['Uses'].fillna('')

@app.route('/api/predict', methods=['POST'])
def predict_api():
    req = request.json or {}
    lang = req.get('lang', 'id')
    selected_symptoms = req.get('symptoms', [])
    
    # Inisialisasi variabel supaya tidak error "not defined"
    top_predictions = []
    obat_list = []
    tampilan_gejala_dipilih = []
    dokter_rujukan = 'Dokter Umum'

    # Logika prediksi
    input_data = [1 if s in selected_symptoms else 0 for s in symptoms_list]
    probabilities = model.predict_proba([input_data])[0]
    classes = model.classes_
    top_indices = np.argsort(probabilities)[::-1][:3]
    
    for idx in top_indices:
        prob_val = round(probabilities[idx] * 100, 1)
        if prob_val > 0:
            top_predictions.append({
                'penyakit': classes[idx].replace('_', ' '),
                'probabilitas': prob_val
            })
            
    # Pastikan variabel di atas terisi sebelum jsonify
    return jsonify({
        'top_predictions': top_predictions,
        'medicines': obat_list,
        'gejala_terpilih': tampilan_gejala_dipilih,
        'dokter': dokter_rujukan
    })

if __name__ == '__main__':
    app.run(port=5000, debug=True)
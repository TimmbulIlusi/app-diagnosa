import pickle

# buka model lama
with open('model.pkl', 'rb') as f:
    data = pickle.load(f)

# simpan ulang dengan format yang lebih kompatibel
with open('model_fixed.pkl', 'wb') as f:
    pickle.dump(data, f, protocol=4)

print('Model berhasil disimpan ulang menjadi model_fixed.pkl')
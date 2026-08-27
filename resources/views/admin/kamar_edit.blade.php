@extends('admin.layout')

@section('page-title', 'Edit Kamar')
@section('page-subtitle', 'Perbarui data kamar yang tampil di halaman pelanggan.')

@section('content')

<style>
    .room-form-page {
        display: grid;
        gap: 22px;
    }

    .room-form-panel {
        background: #ffffff;
        border: 1px solid #ead6ce;
        border-radius: 26px;
        padding: 28px;
    }

    .room-form-head {
        margin-bottom: 24px;
    }

    .room-form-head h2 {
        margin: 0;
        font-size: 27px;
        font-weight: 700;
        color: #211713;
        letter-spacing: -0.02em;
    }

    .room-form-head p {
        margin: 8px 0 0;
        color: #86766f;
        font-size: 15px;
        line-height: 1.6;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .form-full {
        grid-column: 1 / -1;
    }

    .form-sepertiga {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        padding: 14px 0 14px 0;
    }

    .form-group {
        margin: 0;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #211713;
        font-size: 14px;
        font-weight: 600;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        border: 1px solid #ead6ce;
        border-radius: 15px;
        padding: 14px 16px;
        font-size: 14px;
        color: #211713;
        font-family: inherit;
        outline: none;
        background: #ffffff;
    }

    .form-group textarea {
        min-height: 115px;
        resize: vertical;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #d79b86;
        box-shadow: 0 0 0 4px rgba(200, 102, 74, 0.08);
    }

    .form-hint {
        display: block;
        margin-top: 7px;
        color: #9a8d85;
        font-size: 12px;
        line-height: 1.5;
    }

    .facility-box {
        border: 1px solid #ead6ce;
        border-radius: 18px;
        padding: 16px;
        background: #fffdfb;
    }

    .facility-title {
        margin: 0 0 12px;
        font-size: 14px;
        font-weight: 600;
        color: #211713;
    }

    .facility-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
    }

    .facility-check {
        border: 1px solid #eee1da;
        background: #fbf7f3;
        border-radius: 14px;
        padding: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        color: #4b403b;
        font-size: 13px;
        font-weight: 500;
    }

    .facility-check input {
        width: 15px;
        height: 15px;
        accent-color: #c8664a;
    }

    .current-photo {
        border: 1px solid #ead6ce;
        border-radius: 20px;
        background: #fbf5f1;
        padding: 16px;
    }

    .current-photo img {
        width: 100%;
        height: 240px;
        border-radius: 16px;
        object-fit: cover;
        display: block;
        border: 1px solid #ead6ce;
        margin-bottom: 14px;
    }

    .current-photo label {
        display: block;
        margin-bottom: 9px;
        font-size: 14px;
        font-weight: 600;
        color: #211713;
    }

    .current-photo input {
        width: 100%;
        border: 1px solid #eee1da;
        border-radius: 12px;
        padding: 11px;
        font-size: 13px;
        background: #ffffff;
    }

    .photo-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .photo-upload {
        border: 1px solid #ead6ce;
        border-radius: 16px;
        padding: 14px;
        background: #ffffff;
    }

    .photo-upload label {
        display: block;
        margin-bottom: 9px;
        font-size: 13px;
        font-weight: 600;
        color: #211713;
    }

    .photo-upload input {
        width: 100%;
        border: 1px solid #eee1da;
        border-radius: 12px;
        padding: 11px;
        font-size: 13px;
    }

    .form-actions {
        margin-top: 24px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .form-actions .btn {
        min-width: 120px;
    }

    @media (max-width: 900px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .facility-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .photo-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 520px) {
        .room-form-panel {
            padding: 22px;
        }

        .room-form-head h2 {
            font-size: 24px;
        }

        .facility-grid,
        .photo-grid {
            grid-template-columns: 1fr;
        }

        .current-photo img {
            height: 190px;
        }

        .form-actions {
            display: grid;
            grid-template-columns: 1fr;
        }

        .form-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="room-form-page">
    <div class="room-form-panel">

        <div class="room-form-head">
            <h2>Form Edit Kamar</h2>
            <p>Ubah data kamar sesuai informasi terbaru yang akan tampil pada halaman pelanggan.</p>
        </div>

        @if ($errors->any())
            <div style="padding: 14px 20px; background-color: #fce8e6; color: #c0392b; border: 1px solid #f9cfcc; border-radius: 15px; margin-bottom: 18px; font-size: 14px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/admin/kamar/{{ $kamar->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group">
                    <label>Nomor Kamar</label>
                    <input type="text" name="nomor_kamar" value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}" required>
                    <span class="form-hint">Gunakan format angka, misalnya 01, 02, 03.</span>
                </div>

                <div class="form-group">
                    <label>Status Kamar</label>
                    <select name="status">
                        <option value="tersedia" {{ old('status', $kamar->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="penuh" {{ old('status', $kamar->status) == 'penuh' ? 'selected' : '' }}>Penuh</option>
                    </select>
                </div>

            </div>
            <div class="form-sepertiga">

                <div class="form-group">
                    <label>Tower</label>
                    <select name="tower">
                        <option value="Ganjil" {{ old('tower', $kamar->tower) == 'Ganjil' ? 'selected' : '' }}>Tower Ganjil</option>
                        <option value="Genap" {{ old('tower', $kamar->tower) == 'Genap' ? 'selected' : '' }}>Tower Genap</option>
                    </select>
                    <span class="form-hint">Tower ganjil untuk kamar Non AC. Tower genap untuk kamar AC.</span>
                </div>

                <div class="form-group">
                    <label>Tipe Kamar</label>
                    <select name="tipe_kamar">
                        <option value="non-ac" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'non-ac' ? 'selected' : '' }}>Non AC</option>
                        <option value="ac" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'ac' ? 'selected' : '' }}>AC</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Luas Kamar</label>
                    <input type="text" name="luas" value="{{ old('luas', $kamar->luas) }}" required>
                </div>

            </div>
            <div class="form-grid">

                <div class="form-group">
                    <label>Harga Sewa</label>
                    <input type="number" name="harga" value="{{ old('harga', (int)$kamar->harga) }}" required>
                </div>

                {{-- PERUBAHAN: name diubah ke dalam_hitungan dan value mengambil data lama dari database ($kamar->dalam_hitungan) --}}
                <div class="form-group">
                    <label>Dalam Hitungan</label>
                    <select name="dalam_hitungan">
                        <option value="tahun" {{ old('dalam_hitungan', $kamar->dalam_hitungan) == 'tahun' ? 'selected' : '' }}>tahunan</option>
                        @for ($i = 1; $i <= 11; $i++)
                            <option value="{{ $i }} bulan" {{ old('dalam_hitungan', $kamar->dalam_hitungan) == "$i bulan" ? 'selected' : '' }}>{{ $i }} bulan</option>
                        @endfor
                    </select>
                </div>

                <div class="form-full">
                    <div class="facility-box">
                        <p class="facility-title">Fasilitas Kamar</p>

                        <div class="facility-grid">
                            @php
                                $fasilitas_kamar = is_array($kamar->fasilitas) ? $kamar->fasilitas : [];
                            @endphp

                            <label class="facility-check">
                                <input type="checkbox" name="fasilitas[]" value="Kasur" {{ in_array('Kasur', old('fasilitas', $fasilitas_kamar)) ? 'checked' : '' }}>
                                Kasur
                            </label>

                            <label class="facility-check">
                                <input type="checkbox" name="fasilitas[]" value="Lemari" {{ in_array('Lemari', old('fasilitas', $fasilitas_kamar)) ? 'checked' : '' }}>
                                Lemari
                            </label>

                            <label class="facility-check">
                                <input type="checkbox" name="fasilitas[]" value="KM Dalam" {{ in_array('KM Dalam', old('fasilitas', $fasilitas_kamar)) ? 'checked' : '' }}>
                                KM Dalam
                            </label>

                            <label class="facility-check">
                                <input type="checkbox" name="fasilitas[]" value="AC" {{ in_array('AC', old('fasilitas', $fasilitas_kamar)) ? 'checked' : '' }}>
                                AC
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-full form-group">
                    <label>Deskripsi Kamar</label>
                    <textarea name="deskripsi">{{ old('deskripsi', $kamar->deskripsi) }}</textarea>
                </div>

                <div class="form-full">
                    <div class="current-photo">
                        <label>Foto Utama Saat Ini</label>

                        @if($kamar->foto_utama)
                            <img id="editImagePreview" src="{{ asset($kamar->foto_utama) }}" alt="Foto kamar">
                        @else
                            @if($kamar->nomor_kamar == '02')
                                <img id="editImagePreview" src="{{ asset('2.jpg') }}" alt="Foto kamar 02">
                            @elseif($kamar->nomor_kamar == '03')
                                <img id="editImagePreview" src="{{ asset('3.jpg') }}" alt="Foto kamar 03">
                            @elseif($kamar->nomor_kamar == '04')
                                <img id="editImagePreview" src="{{ asset('4.jpg') }}" alt="Foto kamar 04">
                            @elseif($kamar->nomor_kamar == '05')
                                <img id="editImagePreview" src="{{ asset('5.jpg') }}" alt="Foto kamar 05">
                            @elseif($kamar->nomor_kamar == '06')
                                <img id="editImagePreview" src="{{ asset('6.jpg') }}" alt="Foto kamar 06">
                            @else
                                <img id="editImagePreview" src="{{ asset('1.jpg') }}" alt="Foto kamar 01">
                            @endif
                        @endif

                        <label>Ganti Foto Utama</label>
                        <input type="file" name="foto_utama" id="editFotoInput" accept="image/*">
                        <span class="form-hint">Kosongkan jika tidak ingin mengganti foto utama.</span>
                    </div>
                </div>

                <div class="form-full">
                    <div class="photo-grid">
                        <div class="photo-upload">
                            <label>Ganti Foto Tambahan 1</label>
                            <div style="position: relative; height: 100px; margin-bottom: 8px; border-radius: 8px; overflow: hidden; background: #fdfaf7; border: 1px solid #ead6ce; display: flex; align-items: center; justify-content: center;">
                                @if($kamar->foto_tambahan_1)
                                    <img id="preview_tambahan_1" src="{{ asset($kamar->foto_tambahan_1) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <img id="preview_tambahan_1" src="" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                                    <span id="text_tambahan_1" style="font-size: 11px; color: #9a8d85;">Belum ada foto</span>
                                @endif
                            </div>
                            <input type="file" name="foto_tambahan_1" id="input_tambahan_1" accept="image/*">
                        </div>

                        <div class="photo-upload">
                            <label>Ganti Foto Tambahan 2</label>
                            <div style="position: relative; height: 100px; margin-bottom: 8px; border-radius: 8px; overflow: hidden; background: #fdfaf7; border: 1px solid #ead6ce; display: flex; align-items: center; justify-content: center;">
                                @if($kamar->foto_tambahan_2)
                                    <img id="preview_tambahan_2" src="{{ asset($kamar->foto_tambahan_2) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <img id="preview_tambahan_2" src="" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                                    <span id="text_tambahan_2" style="font-size: 11px; color: #9a8d85;">Belum ada foto</span>
                                @endif
                            </div>
                            <input type="file" name="foto_tambahan_2" id="input_tambahan_2" accept="image/*">
                        </div>

                        <div class="photo-upload">
                            <label>Ganti Foto Tambahan 3</label>
                            <div style="position: relative; height: 100px; margin-bottom: 8px; border-radius: 8px; overflow: hidden; background: #fdfaf7; border: 1px solid #ead6ce; display: flex; align-items: center; justify-content: center;">
                                @if($kamar->foto_tambahan_3)
                                    <img id="preview_tambahan_3" src="{{ asset($kamar->foto_tambahan_3) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <img id="preview_tambahan_3" src="" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                                    <span id="text_tambahan_3" style="font-size: 11px; color: #9a8d85;">Belum ada foto</span>
                                @endif
                            </div>
                            <input type="file" name="foto_tambahan_3" id="input_tambahan_3" accept="image/*">
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn" style="border: 1px solid #c8664a; background: #c8664a; color: #ffffff; padding: 13px 18px; border-radius: 15px; font-size: 14px; font-weight: 600; cursor: pointer; font-family: inherit;">Update</button>
                <a href="/admin/kamar" class="btn btn-secondary" style="text-decoration: none; border: 1px solid #ead6ce; background: #fbf5f1; color: #7a5d52; padding: 13px 18px; border-radius: 15px; font-size: 14px; font-weight: 600; display: inline-flex; align-items: center; justify-content: center; font-family: inherit;">Batal</a>
            </div>
        </form>

    </div>
</div>

<script>
    // Preview Ganti Foto Utama
    document.getElementById('editFotoInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('editImagePreview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // Fungsi Reusable Preview Ganti Foto Tambahan
    function setupAdditionalEditPreview(inputId, previewId, textId) {
        document.getElementById(inputId).addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById(previewId);
            const statusText = document.getElementById(textId);

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    if (statusText) statusText.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        });
    }

    setupAdditionalEditPreview('input_tambahan_1', 'preview_tambahan_1', 'text_tambahan_1');
    setupAdditionalEditPreview('input_tambahan_2', 'preview_tambahan_2', 'text_tambahan_2');
    setupAdditionalPreview('input_tambahan_3', 'preview_tambahan_3', 'text_tambahan_3');
</script>

@endsection

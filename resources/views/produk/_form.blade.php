@csrf

<style>
    .form-label-luxury {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #64748b;
        margin-bottom: 8px;
        display: block;
    }

    .form-control-luxury {
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        padding: 12px 16px;
        font-size: 14px;
        color: #0f172a;
        background-color: #f8fafc;
        transition: all 0.25s ease;
    }

    .form-control-luxury:focus {
        background-color: #ffffff;
        border-color: #059669;
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.12);
        color: #0f172a;
    }

    .image-preview-container {
        background: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        padding: 16px;
        text-align: center;
        transition: all 0.2s ease;
    }

    .image-preview-container:hover {
        border-color: #059669;
        background: #ecfdf5;
    }

    .btn-save-luxury {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        border: none;
        border-radius: 12px;
        padding: 12px 28px;
        font-weight: 600;
        font-size: 14px;
        color: white;
        box-shadow: 0 4px 15px rgba(5, 150, 105, 0.3);
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-save-luxury:hover {
        background: linear-gradient(135deg, #047857 0%, #065f46 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(5, 150, 105, 0.4);
        color: white;
    }

    .btn-cancel-luxury {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        font-size: 14px;
        color: #64748b;
        transition: all 0.25s ease;
    }

    .btn-cancel-luxury:hover {
        background: #f1f5f9;
        color: #0f172a;
        border-color: #cbd5e1;
    }
</style>

<div class="row g-4 mb-4">
    {{-- Foto Saat Ini --}}
    @if (!empty($produk->foto))
        <div class="col-md-6">
            <span class="form-label-luxury">Foto Saat Ini</span>
            <div class="image-preview-container d-inline-block w-100">
                <img src="{{ asset('storage/' . $produk->foto) }}" class="rounded shadow-sm" style="width: 130px; height: 130px; object-fit: cover;">
            </div>
        </div>
    @endif

    {{-- Upload Gambar Baru --}}
    <div class="{{ !empty($produk->foto) ? 'col-md-6' : 'col-md-12' }}">
        <span class="form-label-luxury">Ganti / Upload Foto Baru</span>
        <div class="image-preview-container">
            <input type="file" name="foto" onchange="previewImage(this)" class="form-control form-control-luxury @error('foto') is-invalid @enderror">
            <div class="mt-3">
                <img id="preview" class="rounded shadow-sm border" style="display:none; width: 110px; height: 110px; object-fit: cover; margin: 0 auto;">
            </div>
        </div>
        @error('foto')
            <div class="invalid-feedback d-block mt-2">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="mb-4">
    <label class="form-label-luxury">Nama Produk</label>
    <input type="text" name="name" class="form-control form-control-luxury @error('name') is-invalid @enderror" value="{{ old('name', $produk->nama ?? '') }}" placeholder="Contoh: Kopi Susu Aren Espresso...">
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <label class="form-label-luxury">Harga Beli (Modal)</label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 12px 0 0 12px; border-color: #e2e8f0; font-weight: 600;">Rp</span>
            <input type="number" name="purchase_price" class="form-control form-control-luxury border-start-0 @error('purchase_price') is-invalid @enderror" value="{{ old('purchase_price', $produk->harga_beli ?? '') }}" placeholder="0" style="border-radius: 0 12px 12px 0;">
        </div>
        @error('purchase_price')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="col-md-6 mb-4">
        <label class="form-label-luxury">Harga Jual</label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 12px 0 0 12px; border-color: #e2e8f0; font-weight: 600;">Rp</span>
            <input type="number" name="selling_price" class="form-control form-control-luxury border-start-0 @error('selling_price') is-invalid @enderror" value="{{ old('selling_price', $produk->harga_jual ?? '') }}" placeholder="0" style="border-radius: 0 12px 12px 0;">
        </div>
        @error('selling_price')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="mb-4">
    <label class="form-label-luxury">Stok Gudang</label>
    <input type="number" name="stock" class="form-control form-control-luxury @error('stock') is-invalid @enderror" value="{{ old('stock', $produk->stok ?? '') }}" placeholder="0">
    @error('stock')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="d-flex justify-content-end gap-3 pt-4 border-top mt-4">
    <a href="{{ route('produk.index') }}" class="btn btn-cancel-luxury">Batal</a>
    <button class="btn btn-save-luxury" type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
        Simpan Perubahan
    </button>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const file = input.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }
</script>
<form action="{{ $action }}" method="POST">
    @csrf
    @if(isset($method) && in_array($method, ['PUT','PATCH']))
        @method($method)
    @endif

    <div class="form-group">
        <label for="produk_id">Produk</label>
        <select name="produk_id" id="produk_id" class="form-control">
            <option value="">Pilih Produk</option>
            @foreach($produks as $prod)
                <option value="{{ $prod->id }}" {{ (old('produk_id', $persediaan->produk_id ?? '') == $prod->id) ? 'selected' : '' }}>
                    {{ $prod->nama }}
                </option>
            @endforeach
        </select>
        @error('produk_id')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="stok">Stok</label>
        <input type="number" name="stok" id="stok" class="form-control" min="0" value="{{ old('stok', $persediaan->stok ?? 0) }}">
        @error('stok')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('persediaan.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>

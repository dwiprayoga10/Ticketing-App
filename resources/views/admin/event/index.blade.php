{{-- Lokasi --}}
<div class="mb-4">
    <label class="label">
        <span class="label-text">Lokasi</span>
    </label>
    <select name="lokasi_id" class="select select-bordered w-full" required>
        <option value="">-- Pilih Lokasi --</option>
        @foreach (($lokasis ?? []) as $lokasi)
            <option value="{{ $lokasi->id }}"
                {{ old('lokasi_id') == $lokasi->id ? 'selected' : '' }}>
                {{ $lokasi->nama_lokasi }}
            </option>
        @endforeach
    </select>
    @error('lokasi_id')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>

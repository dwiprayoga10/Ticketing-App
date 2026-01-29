<x-layouts.admin title="Tambah Event">

    {{-- Error Validation --}}
    @if ($errors->any())
        <div class="toast toast-bottom toast-center">
            <div class="alert alert-error">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.toast')?.remove()
            }, 4000)
        </script>
    @endif

    <div class="container mx-auto p-10 max-w-3xl">
        <h1 class="text-3xl font-semibold mb-6">Tambah Event</h1>

        <form
            action="{{ route('admin.events.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white p-6 rounded-box shadow-xs"
        >
            @csrf

            {{-- Judul --}}
            <div class="mb-4">
                <label class="label">
                    <span class="label-text">Judul Event</span>
                </label>
                <input
                    type="text"
                    name="judul"
                    class="input input-bordered w-full"
                    value="{{ old('judul') }}"
                    required
                >
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label class="label">
                    <span class="label-text">Deskripsi</span>
                </label>
                <textarea
                    name="deskripsi"
                    class="textarea textarea-bordered w-full"
                    rows="4"
                    required
                >{{ old('deskripsi') }}</textarea>
            </div>

            {{-- Kategori --}}
            <div class="mb-4">
                <label class="label">
                    <span class="label-text">Kategori</span>
                </label>
                <select name="kategori_id" class="select select-bordered w-full" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach (($categories ?? []) as $kategori)
                        <option value="{{ $kategori->id }}"
                            {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Lokasi (DARI DATABASE LOKASI) --}}
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
            </div>

            {{-- Tanggal & Waktu --}}
            <div class="mb-4">
                <label class="label">
                    <span class="label-text">Tanggal & Waktu</span>
                </label>
                <input
                    type="datetime-local"
                    name="tanggal_waktu"
                    class="input input-bordered w-full"
                    value="{{ old('tanggal_waktu') }}"
                    required
                >
            </div>

            {{-- Gambar --}}
            <div class="mb-6">
                <label class="label">
                    <span class="label-text">Gambar Event</span>
                </label>
                <input
                    type="file"
                    name="gambar"
                    class="file-input file-input-bordered w-full"
                    accept="image/*"
                    required
                >
            </div>

            {{-- Action --}}
            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.events.index') }}" class="btn">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    Simpan Event
                </button>
            </div>

        </form>
    </div>

</x-layouts.admin>

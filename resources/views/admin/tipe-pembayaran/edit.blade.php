<x-layouts.admin title="Edit Tipe Pembayaran">

    @if ($errors->any())
        <div class="toast toast-bottom toast-center z-50">
            <ul class="alert alert-error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.toast')?.remove()
            }, 5000)
        </script>
    @endif

    <div class="container mx-auto p-10">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <h2 class="card-title text-2xl mb-6">Edit Tipe Pembayaran</h2>

                <form id="paymentTypeEditForm"
                      class="space-y-4"
                      method="POST"
                      action="{{ route('admin.tipe-pembayaran.update', $tipe_pembayaran->id) }}">

                    @csrf
                    @method('PUT')

                    <!-- Nama Tipe Pembayaran -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Nama Tipe Pembayaran</span>
                        </label>
                        <input
                            type="text"
                            name="nama"
                            value="{{ old('nama', $tipe_pembayaran->nama) }}"
                            class="input input-bordered w-full"
                            required />
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Deskripsi</span>
                        </label>
                        <br>
                        <textarea
                            name="deskripsi"
                            class="textarea textarea-bordered h-24 w-full"
                            required>{{ old('deskripsi', $tipe_pembayaran->deskripsi) }}</textarea>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="card-actions justify-end mt-6">
                        <a href="{{ route('admin.tipe-pembayaran.index') }}"
                           class="btn btn-ghost">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Update Tipe Pembayaran
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</x-layouts.admin>

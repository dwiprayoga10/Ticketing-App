<x-layouts.admin title="Tambah Tipe Pembayaran">

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
                <h2 class="card-title text-2xl mb-6">Tambah Tipe Pembayaran</h2>

                <form id="paymentTypeForm"
                      class="space-y-4"
                      method="POST"
                      action="{{ route('admin.tipe-pembayaran.store') }}">

                    @csrf

                    <!-- Nama Tipe Pembayaran -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Nama Tipe Pembayaran</span>
                        </label>
                        <input
                            type="text"
                            name="nama"
                            placeholder="Contoh: Transfer Bank"
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
                            placeholder="Contoh: Pembayaran melalui transfer bank atau e-wallet"
                            class="textarea textarea-bordered h-24 w-full"
                            required></textarea>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="card-actions justify-end mt-6">
                        <button type="reset" class="btn btn-ghost">Reset</button>
                        <button type="submit" class="btn btn-primary">
                            Simpan Tipe Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Alert Success (opsional, konsisten dengan event) -->
        <div id="successAlert" class="alert alert-success mt-4 hidden">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="stroke-current shrink-0 h-6 w-6"
                 fill="none"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Tipe pembayaran berhasil disimpan!</span>
        </div>
    </div>

    <script>
        const form = document.getElementById('paymentTypeForm');
        const successAlert = document.getElementById('successAlert');

        form.addEventListener('reset', function () {
            successAlert.classList.add('hidden');
        });
    </script>

</x-layouts.admin>

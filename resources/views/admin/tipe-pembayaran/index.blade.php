<x-layouts.admin title="Manajemen Tipe Pembayaran">

    <div class="container mx-auto p-10">
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">

                <div class="flex items-center justify-between mb-6">
                    <h2 class="card-title text-2xl">Manajemen Tipe Pembayaran</h2>
                    <a href="{{ route('admin.tipe-pembayaran.create') }}"
                       class="btn btn-primary">
                        Tambah Tipe Pembayaran
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tipes as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="font-semibold">{{ $item->nama }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td class="text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('admin.tipe-pembayaran.edit', $item->id) }}"
                                               class="btn btn-sm btn-warning">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('admin.tipe-pembayaran.destroy', $item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-error"
                                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-gray-500 py-6">
                                        Belum ada data tipe pembayaran
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</x-layouts.admin>

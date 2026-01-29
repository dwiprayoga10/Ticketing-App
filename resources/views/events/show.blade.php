<x-layouts.app>
  <section class="max-w-7xl mx-auto py-14 px-5">

  <!-- Breadcrumb -->
  <nav class="mb-8 text-sm text-gray-500">
    <div class="breadcrumbs">
      <ul>
        <li><a href="{{ route('home') }}" class="hover:text-blue-600 transition">Beranda</a></li>
        <li>Event</li>
        <li class="font-medium text-gray-800">{{ $event->judul }}</li>
      </ul>
    </div>
  </nav>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- LEFT CONTENT -->
    <div class="lg:col-span-2 space-y-8">

      <!-- EVENT CARD -->
      <div class="rounded-2xl overflow-hidden bg-white shadow-lg border border-gray-100">

        <!-- Image -->
        <div class="relative">
          <img
            src="{{ $event->gambar
              ? asset('images/events/' . $event->gambar)
              : 'https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp'
            }}"
            alt="{{ $event->judul }}"
            class="w-full h-[420px] object-cover"
          />

          <div class="absolute bottom-4 left-4 flex gap-2">
            <span class="badge badge-primary backdrop-blur">
              {{ $event->kategori?->nama ?? 'Tanpa Kategori' }}
            </span>
            <span class="badge backdrop-blur bg-white/80 text-gray-700">
              {{ $event->user?->name ?? 'Penyelenggara' }}
            </span>
          </div>
        </div>

        <!-- Body -->
        <div class="p-6 md:p-8">

          <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight">
            {{ $event->judul }}
          </h1>

          <p class="mt-2 text-gray-500 flex items-center gap-2">
            <span>
              {{ \Carbon\Carbon::parse($event->tanggal_waktu)->locale('id')->translatedFormat('d F Y, H:i') }}
            </span>
            <span class="opacity-50">•</span>
            <span>📍 {{ $event->lokasi }}</span>
          </p>

          <p class="mt-6 text-gray-700 leading-relaxed">
            {{ $event->deskripsi }}
          </p>

        </div>
      </div>

      <!-- TICKET SECTION -->
      <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 md:p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">
          Pilih Tiket
        </h3>

        <div class="space-y-5">
          @forelse($event->tikets as $tiket)
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border rounded-xl p-4 hover:border-blue-600 transition">

              <div>
                <h4 class="font-semibold text-lg text-gray-900">
                  {{ $tiket->tipe }}
                </h4>
                <p class="text-sm text-gray-500">
                  Stok tersedia: {{ $tiket->stok }}
                </p>
              </div>

              <div class="flex items-center gap-4">
                <div class="text-right">
                  <div class="text-lg font-bold text-gray-900">
                    {{ $tiket->harga ? 'Rp ' . number_format($tiket->harga, 0, ',', '.') : 'Gratis' }}
                  </div>
                  <div class="text-sm text-gray-500">
                    Subtotal: <span id="subtotal-{{ $tiket->id }}">Rp 0</span>
                  </div>
                </div>

                <div class="flex items-center gap-2">
                  <button class="btn btn-sm btn-outline" data-action="dec" data-id="{{ $tiket->id }}">−</button>
                  <input
                    id="qty-{{ $tiket->id }}"
                    type="number"
                    min="0"
                    max="{{ $tiket->stok }}"
                    value="0"
                    class="input input-bordered w-16 text-center"
                    data-id="{{ $tiket->id }}"
                  />
                  <button class="btn btn-sm btn-outline" data-action="inc" data-id="{{ $tiket->id }}">+</button>
                </div>
              </div>

            </div>
          @empty
            <div class="alert alert-info">
              Tiket belum tersedia untuk event ini.
            </div>
          @endforelse
        </div>
      </div>

    </div>

    <!-- RIGHT SUMMARY -->
    <aside>
      <div class="sticky top-24 bg-white rounded-2xl shadow-xl border border-gray-100 p-6">

        <h4 class="text-xl font-bold text-gray-900 mb-4">
          Ringkasan Pembelian
        </h4>

        <div class="space-y-2 text-sm">
          <div class="flex justify-between text-gray-500">
            <span>Item</span>
            <span id="summaryItems">0</span>
          </div>
          <div class="flex justify-between text-xl font-bold text-gray-900">
            <span>Total</span>
            <span id="summaryTotal">Rp 0</span>
          </div>
        </div>

        <div class="divider my-4"></div>

        <div id="selectedList" class="text-sm text-gray-500 space-y-1">
          Belum ada tiket dipilih
        </div>

        @auth
          <button
            id="checkoutButton"
            onclick="openCheckout()"
            disabled
            class="mt-6 w-full rounded-xl bg-blue-900 hover:bg-blue-800 text-white font-semibold py-3 transition disabled:opacity-50"
          >
            Checkout
          </button>
        @else
          <a
            href="{{ route('login') }}"
            class="mt-6 block text-center rounded-xl bg-blue-900 hover:bg-blue-800 text-white font-semibold py-3 transition"
          >
            Login untuk Checkout
          </a>
        @endauth

      </div>
    </aside>

  </div>
</section>

<dialog id="checkoutModal" class="modal">
  <div class="modal-box max-w-lg rounded-2xl shadow-2xl">

    <h3 class="text-xl font-bold text-gray-900">
      Konfirmasi Pembelian
    </h3>

    <p class="text-sm text-gray-500 mt-1">
      Pastikan detail tiket sudah sesuai sebelum melanjutkan
    </p>

    <div
      id="modalItems"
      class="mt-6 space-y-2 text-sm text-gray-700"
    ></div>

    <div class="divider my-5"></div>

    <div class="flex justify-between items-center">
      <span class="text-gray-500 font-medium">
        Total Pembayaran
      </span>
      <span
        id="modalTotal"
        class="text-2xl font-bold text-gray-900"
      >
        Rp 0
      </span>
    </div>

    <!-- ACTION (tetap di sini, tidak dipisah) -->
    <div class="modal-action mt-6">

      <button
        class="btn btn-ghost"
        onclick="checkoutModal.close()"
      >
        Batal
      </button>

      <button
        id="confirmCheckout"
        class="btn !bg-blue-900 hover:!bg-blue-800 text-white font-semibold px-6"
      >
        Konfirmasi
      </button>

    </div>

  </div>
</dialog>


<script>
function openCheckout() {
  document.getElementById('modalItems').innerHTML =
    document.getElementById('selectedList').innerHTML;
  document.getElementById('modalTotal').innerText =
    document.getElementById('summaryTotal').innerText;
  document.getElementById('checkoutModal').showModal();
}
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {

  const formatRupiah = (value) =>
    'Rp ' + Number(value).toLocaleString('id-ID');

  window.tickets = {
    @foreach($event->tikets as $tiket)
      {{ $tiket->id }}: {
        id: {{ $tiket->id }},
        price: {{ $tiket->harga ?? 0 }},
        stock: {{ $tiket->stok }},
        tipe: @json($tiket->tipe),
      },
    @endforeach
  };

  const summaryItems = document.getElementById('summaryItems');
  const summaryTotal = document.getElementById('summaryTotal');
  const selectedList = document.getElementById('selectedList');
  const checkoutButton = document.getElementById('checkoutButton');

  function updateSubtotal(id) {
    const qty = Number(document.getElementById(`qty-${id}`).value || 0);
    document.getElementById(`subtotal-${id}`).textContent =
      formatRupiah(qty * tickets[id].price);
  }

  function updateSummary() {
    let totalQty = 0;
    let totalPrice = 0;
    let html = '';

    Object.values(tickets).forEach(t => {
      const qty = Number(document.getElementById(`qty-${t.id}`).value || 0);
      if (qty > 0) {
        totalQty += qty;
        totalPrice += qty * t.price;
        html += `
          <div class="flex justify-between">
            <span>${t.tipe} × ${qty}</span>
            <span>${formatRupiah(qty * t.price)}</span>
          </div>
        `;
      }
    });

    summaryItems.textContent = totalQty;
    summaryTotal.textContent = formatRupiah(totalPrice);
    selectedList.innerHTML = html || '<p class="text-gray-500">Belum ada tiket dipilih</p>';

    if (checkoutButton) {
      checkoutButton.disabled = totalQty === 0;
    }
  }

  document.querySelectorAll('[data-action="inc"]').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;
      const input = document.getElementById(`qty-${id}`);
      if (Number(input.value) < tickets[id].stock) {
        input.value = Number(input.value) + 1;
        updateSubtotal(id);
        updateSummary();
      }
    });
  });

  document.querySelectorAll('[data-action="dec"]').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;
      const input = document.getElementById(`qty-${id}`);
      if (Number(input.value) > 0) {
        input.value = Number(input.value) - 1;
        updateSubtotal(id);
        updateSummary();
      }
    });
  });

  document.querySelectorAll('input[id^="qty-"]').forEach(input => {
    input.addEventListener('input', () => {
      const id = input.dataset.id;
      if (input.value < 0) input.value = 0;
      if (input.value > tickets[id].stock) input.value = tickets[id].stock;
      updateSubtotal(id);
      updateSummary();
    });
  });

});
</script>

<script>
document.getElementById('confirmCheckout').addEventListener('click', async () => {

  const btn = document.getElementById('confirmCheckout');
  btn.disabled = true;
  btn.textContent = 'Memproses...';

  const items = [];
  Object.values(window.tickets).forEach(t => {
    const qty = Number(document.getElementById('qty-' + t.id).value || 0);
    if (qty > 0) {
      items.push({
        tiket_id: t.id,
        jumlah: qty
      });
    }
  });

  if (items.length === 0) {
    alert('Tidak ada tiket dipilih');
    btn.disabled = false;
    btn.textContent = 'Konfirmasi';
    return;
  }

  try {
    const res = await fetch("{{ route('orders.store') }}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute('content')
      },
      body: JSON.stringify({
        event_id: {{ $event->id }},
        items
      })
    });

    if (!res.ok) {
      const text = await res.text();
      throw new Error(text || 'Gagal checkout');
    }

    const data = await res.json();

    // tutup modal
    document.getElementById('checkoutModal').close();

    // redirect
    window.location.href = data.redirect || "{{ route('orders.index') }}";

  } catch (err) {
    alert(err.message);
    btn.disabled = false;
    btn.textContent = 'Konfirmasi';
  }
});
</script>

</x-layouts.app>

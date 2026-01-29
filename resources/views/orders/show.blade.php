<x-layouts.app>
<section class="max-w-4xl mx-auto py-14 px-6">

  <!-- HEADER -->
  <div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">
      Detail Pemesanan
    </h1>
    <p class="mt-1 text-sm text-gray-500">
      Order #{{ $order->id }} •
      {{ $order->order_date->translatedFormat('d F Y, H:i') }}
    </p>
  </div>

  <!-- CARD -->
  <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <!-- EVENT INFO -->
      <div class="p-6 border-b md:border-b-0 md:border-r">
        <img
          src="{{ $order->event?->gambar
            ? asset('images/events/' . $order->event->gambar)
            : 'https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp'
          }}"
          alt="{{ $order->event?->judul ?? 'Event' }}"
          class="w-full h-48 object-cover rounded-xl"
        />

        <h2 class="mt-4 text-lg font-semibold text-gray-900">
          {{ $order->event?->judul ?? 'Event' }}
        </h2>

        <p class="text-sm text-gray-500 mt-1">
          📍 {{ $order->event?->lokasi ?? '-' }}
        </p>
      </div>

      <!-- ORDER DETAIL -->
      <div class="p-6 md:col-span-2">

        <h3 class="text-lg font-bold text-gray-900 mb-4">
          Rincian Tiket
        </h3>

        <div class="space-y-4">
          @foreach($order->detailOrders as $d)
            <div class="flex justify-between items-center border-b pb-3 last:border-b-0">
              <div>
                <div class="font-medium text-gray-900">
                  {{ $d->tiket->tipe }}
                </div>
                <div class="text-sm text-gray-500">
                  Qty: {{ $d->jumlah }}
                </div>
              </div>

              <div class="font-semibold text-gray-900">
                Rp {{ number_format($d->subtotal_harga, 0, ',', '.') }}
              </div>
            </div>
          @endforeach
        </div>

        <div class="divider my-5"></div>

        <div class="flex justify-between items-center text-lg font-bold text-gray-900">
          <span>Total Pembayaran</span>
          <span>
            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
          </span>
        </div>

      </div>
    </div>
  </div>

  <!-- BACK BUTTON -->
  <div class="mt-8">
    <a
      href="{{ route('orders.index') }}"
      class="inline-flex items-center gap-2 rounded-xl bg-blue-900 hover:bg-blue-800 text-white px-6 py-3 font-semibold transition"
    >
      ← Kembali ke Riwayat Pembelian
    </a>
  </div>

</section>
</x-layouts.app>

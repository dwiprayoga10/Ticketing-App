<x-layouts.app>
<section class="max-w-6xl mx-auto py-14 px-6">

  <div class="flex items-center justify-between mb-8">
    <h1 class="text-3xl font-bold text-gray-900">
      Riwayat Pembelian
    </h1>
  </div>

  <div class="space-y-5">
    @forelse($orders as $order)
      <article
        class="flex flex-col md:flex-row bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition"
      >

        <!-- IMAGE -->
        <div class="md:w-56 h-48 md:h-auto">
          <img
            src="{{ $order->event?->gambar
              ? asset('images/events/' . $order->event->gambar)
              : 'https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp'
            }}"
            alt="{{ $order->event?->judul ?? 'Event' }}"
            class="w-full h-full object-cover"
          />
        </div>

        <!-- CONTENT -->
        <div class="flex-1 p-6 flex flex-col justify-between">

          <div>
            <div class="flex items-center justify-between">
              <span class="text-sm text-gray-500">
                Order #{{ $order->id }}
              </span>

              <span class="text-sm text-gray-400">
                {{ $order->order_date->translatedFormat('d F Y, H:i') }}
              </span>
            </div>

            <h3 class="mt-3 text-xl font-semibold text-gray-900">
              {{ $order->event?->judul ?? 'Event' }}
            </h3>
          </div>

          <div class="mt-6 flex items-center justify-between">
            <div class="text-lg font-bold text-gray-900">
              Rp {{ number_format($order->total_harga, 0, ',', '.') }}
            </div>

            <a
              href="{{ route('orders.show', $order) }}"
              class="inline-flex items-center gap-2 rounded-xl bg-blue-900 hover:bg-blue-800 text-white px-5 py-2.5 font-semibold transition"
            >
              Lihat Detail →
            </a>
          </div>

        </div>

      </article>
    @empty
      <div class="alert alert-info">
        Anda belum memiliki pesanan.
      </div>
    @endforelse
  </div>

</section>
</x-layouts.app>

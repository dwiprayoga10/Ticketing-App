<x-layouts.app>
    <!-- Hero Section -->
    <div class="hero bg-blue-900 min-h-screen">
        <div class="hero-content text-center text-white">
            <div class="max-w-4xl">
                <h1 class="text-5xl font-bold">Hi, Amankan Tiketmu yuk.</h1>
                <p class="py-6">
                    BengTix: Beli tiket, auto asik.
                </p>
            </div>
        </div>
    </div>

    <!-- Event Section -->
    <section class="max-w-7xl mx-auto py-20 px-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-8 mb-14">
        <div class="max-w-xl">
            <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight text-gray-900">
                Event Pilihan
            </h2>
            <p class="mt-3 text-gray-500 leading-relaxed">
                Temukan dan amankan tiket event terbaik sebelum kehabisan
            </p>
        </div>

        <!-- Category Filter -->
        <div class="flex gap-2 flex-wrap">
            <a href="{{ route('home') }}">
                <x-user.category-pill
                    :label="'Semua'"
                    :active="!request('kategori')" />
            </a>

            @foreach ($categories as $kategori)
                <a href="{{ route('home', ['kategori' => $kategori->id]) }}">
                    <x-user.category-pill
                        :label="$kategori->nama"
                        :active="request('kategori') == $kategori->id" />
                </a>
            @endforeach
        </div>
    </div>

    <!-- Event Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
        @forelse ($events as $event)
            <div class="group transition-all duration-300 hover:-translate-y-1">
                <x-user.event-card
                    :title="$event->judul"
                    :date="$event->tanggal_waktu"
                    :location="$event->lokasi"
                    :price="$event->tikets_min_harga"
                    :image="$event->gambar"
                    :href="route('events.show', $event)" />
            </div>
        @empty
            <div class="col-span-full">
                <div class="flex flex-col items-center justify-center py-28 text-center">
                    <div
                        class="w-20 h-20 mb-6 rounded-2xl bg-gray-100 flex items-center justify-center shadow-sm">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                        </svg>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-700">
                        Belum Ada Event
                    </h3>
                    <p class="mt-2 text-gray-500 max-w-sm">
                        Saat ini belum ada event yang tersedia. Silakan cek kembali nanti.
                    </p>
                </div>
            </div>
        @endforelse
    </div>
</section>

</x-layouts.app>

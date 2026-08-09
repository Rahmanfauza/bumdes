@extends('layouts.app')

@section('content')
<style>
    /* Custom Enterprise Utilities */
    .enterprise-card {
        background-color: #ffffff;
        border: 1px solid #E2E8F0;
        border-radius: 0.75rem;
        padding: 1.5rem;
        transition: all 0.2s ease-in-out;
    }
    .enterprise-card:hover {
        border-color: #1856FF;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(24, 86, 255, 0.05), 0 4px 6px -2px rgba(24, 86, 255, 0.05);
    }
    .btn-enterprise-primary {
        background-color: #1856FF;
        color: #ffffff;
        font-weight: 700;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        transition: all 0.15s ease-in-out;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        font-size: 0.875rem;
        letter-spacing: 0.05em;
    }
    .btn-enterprise-primary:hover {
        background-color: #003BFF;
        transform: translateY(-1px);
    }
    .btn-enterprise-secondary {
        background-color: #3A344E;
        color: #ffffff;
        font-weight: 700;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        transition: all 0.15s ease-in-out;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        font-size: 0.875rem;
        letter-spacing: 0.05em;
    }
    .btn-enterprise-secondary:hover {
        background-color: #2D273D;
        transform: translateY(-1px);
    }
    .btn-enterprise-outline {
        background-color: transparent;
        color: #1856FF;
        border: 1px solid #1856FF;
        font-weight: 700;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        transition: all 0.15s ease-in-out;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        font-size: 0.875rem;
        letter-spacing: 0.05em;
    }
    .btn-enterprise-outline:hover {
        background-color: rgba(24, 86, 255, 0.04);
        transform: translateY(-1px);
    }

    /* Scroll reveal transitions */
    .reveal-section {
        opacity: 0;
        transform: translateY(24px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: opacity, transform;
    }
    .reveal-section.revealed {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<!-- Top Layout Container -->
<div class="relative w-full bg-bg-base z-10">

    <!-- HERO SECTION: 50/50 Split -->
    <div class="w-full min-h-[85vh] flex flex-col lg:flex-row border-b border-slate-200">
        <!-- Left Side: Professional Enterprise Content Block -->
        <div class="w-full lg:w-1/2 bg-white relative overflow-hidden flex items-center justify-center p-6 sm:p-10 lg:p-16 min-h-[50vh] lg:min-h-full border-r border-slate-200">
            <!-- Subtle Grid Background -->
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#1856FF 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>
            
            <div class="relative z-10 w-full max-w-xl">
                <!-- Eyebrow Tag -->
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-primary/10 text-primary rounded-full font-bold tracking-wider uppercase text-xs mb-6">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    Sistem Tata Kelola Terpadu
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-secondary leading-tight mb-6">
                    BUMDes<br/><span class="text-primary">GO DIGITAL</span>
                </h1>

                <p class="text-base sm:text-lg text-slate-600 leading-relaxed mb-8 max-w-lg">
                    Revolusi akuntansi dan manajemen komoditas desa. Platform transparan, terintegrasi, dan dibangun untuk efisiensi bisnis lokal secara instan.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 mb-10">
                    <a href="#katalog" class="btn-enterprise-primary">Katalog Produk</a>
                    <a href="#statistik" class="btn-enterprise-outline">Lihat Statistik</a>
                </div>

                <!-- Enterprise Stats Grid -->
                <div class="grid grid-cols-3 gap-6 pt-8 border-t border-slate-100">
                    <div>
                        <div class="text-2xl font-display font-bold text-secondary">2.5K+</div>
                        <div class="text-xs text-slate-500 font-medium">Anggota Aktif</div>
                    </div>
                    <div>
                        <div class="text-2xl font-display font-bold text-secondary">4 Unit</div>
                        <div class="text-xs text-slate-500 font-medium">Sektor Usaha</div>
                    </div>
                    <div>
                        <div class="text-2xl font-display font-bold text-secondary">Rp1.2B+</div>
                        <div class="text-xs text-slate-500 font-medium">Perputaran Modal</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: The Image (Edge to Edge, NO overlay) -->
        <div class="w-full lg:w-1/2 h-72 sm:h-96 lg:h-auto bg-slate-100 relative">
            <img class="w-full h-full object-cover object-center block" 
                 src="{{ asset('raiyan-zakaria-Y43aG83fYMA-unsplash.jpg') }}" 
                 alt="BUMDes Operations Image">
        </div>
    </div>


    <!-- STRUKTUR PENGURUS SECTION -->
    <div id="statistik" class="w-full py-24 bg-slate-50/50 border-b border-slate-200 reveal-section">
        <div class="mx-auto max-w-7xl px-6 lg:px-12">
            
            <div class="mb-16">
                <div class="text-primary font-bold text-sm uppercase tracking-wider mb-2">Manajemen</div>
                <h2 class="text-4xl md:text-5xl font-display font-bold text-secondary uppercase tracking-wide mb-4">
                    Struktur Pengurus
                </h2>
                <div class="w-20 h-1 bg-primary"></div>
                <p class="mt-4 text-slate-500 max-w-2xl font-medium">Tim pengelola operasional BUMDes yang berdedikasi tinggi demi memajukan ekonomi desa secara transparan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Direktur -->
                <div class="enterprise-card bg-white relative">
                    <div class="w-full flex flex-col mb-6 mt-2">
                        <img class="w-20 h-20 rounded-full object-cover border-2 border-primary mb-4"
                            src="https://ui-avatars.com/api/?name=Budi+Santoso&size=200&background=1856FF&color=fff&font-size=0.33"
                            alt="Budi Santoso">
                        <h3 class="text-2xl font-display font-bold text-secondary tracking-wide mb-1">Budi Santoso</h3>
                        <span class="inline-block self-start px-2.5 py-1 bg-primary/10 text-primary rounded-md font-bold text-xs tracking-wider uppercase mb-3">
                            Direktur
                        </span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed">Penyusun strategi makro operasional BUMDes dan koordinator unit usaha.</p>
                </div>

                <!-- Sekretaris -->
                <div class="enterprise-card bg-white relative">
                    <div class="w-full flex flex-col mb-6 mt-2">
                        <img class="w-20 h-20 rounded-full object-cover border-2 border-success mb-4"
                            src="https://ui-avatars.com/api/?name=Siti+Aminah&size=200&background=07CA6B&color=fff&font-size=0.33"
                            alt="Siti Aminah">
                        <h3 class="text-2xl font-display font-bold text-secondary tracking-wide mb-1">Siti Aminah</h3>
                        <span class="inline-block self-start px-2.5 py-1 bg-success/10 text-success rounded-md font-bold text-xs tracking-wider uppercase mb-3">
                            Sekretaris
                        </span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed">Pengelola sistematisasi arsip, administrasi, dan alur komunikasi organisasi.</p>
                </div>

                <!-- Bendahara -->
                <div class="enterprise-card bg-white relative">
                    <div class="w-full flex flex-col mb-6 mt-2">
                        <img class="w-20 h-20 rounded-full object-cover border-2 border-warning mb-4"
                            src="https://ui-avatars.com/api/?name=Ahmad+Fauzi&size=200&background=E89558&color=fff&font-size=0.33"
                            alt="Ahmad Fauzi">
                        <h3 class="text-2xl font-display font-bold text-secondary tracking-wide mb-1">Ahmad Fauzi</h3>
                        <span class="inline-block self-start px-2.5 py-1 bg-warning/10 text-warning rounded-md font-bold text-xs tracking-wider uppercase mb-3">
                            Bendahara
                        </span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed">Auditor akuntansi, pengawas arus kas, dan penjamin stabilitas modal usaha.</p>
                </div>
            </div>
        </div>
    </div>


    <!-- GALERI KEGIATAN SECTION (Enterprise Dark Accent Block) -->
    <div class="w-full py-24 bg-secondary relative overflow-hidden border-b border-slate-200 reveal-section">
        <!-- Subtle Grid Decor -->
        <div class="absolute inset-0 opacity-[0.02] pointer-events-none" style="background-image: linear-gradient(to right, white 1px, transparent 1px), linear-gradient(to bottom, white 1px, transparent 1px); background-size: 40px 40px;"></div>

        <div class="mx-auto max-w-7xl px-6 lg:px-12 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div>
                    <div class="text-primary font-bold text-sm uppercase tracking-wider mb-2">Dokumentasi</div>
                    <h2 class="text-4xl md:text-5xl font-display font-bold text-white uppercase tracking-wide mb-4">
                        Arsip Kegiatan
                    </h2>
                    <div class="w-20 h-1 bg-primary"></div>
                </div>
                <p class="text-lg text-slate-300 max-w-sm font-medium">
                    Kompilasi riil dan digitalisasi kemajuan pembangunan ekonomi desa secara berkala.
                </p>
            </div>

            <!-- Hard grid, clean design -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Gallery Item 1 -->
                <div class="bg-white p-3 rounded-xl cursor-pointer group transition-all hover:-translate-y-1 hover:shadow-lg border border-slate-800/20">
                    <div class="w-full aspect-[4/3] overflow-hidden rounded-lg bg-slate-900">
                        <img src="https://picsum.photos/800/600?random=1" alt="Rapat Desa" class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity">
                    </div>
                    <div class="pt-4 pb-1 px-1 flex justify-between items-center">
                        <h3 class="font-display font-bold text-secondary text-lg uppercase tracking-wide">Rapat Desa</h3>
                        <span class="font-mono font-bold text-xs text-white bg-primary px-2 py-1 rounded">15 JAN</span>
                    </div>
                </div>

                <!-- Gallery Item 2 -->
                <div class="bg-white p-3 rounded-xl cursor-pointer group transition-all hover:-translate-y-1 hover:shadow-lg border border-slate-800/20">
                    <div class="w-full aspect-[4/3] overflow-hidden rounded-lg bg-slate-900">
                        <img src="https://picsum.photos/800/600?random=2" alt="Penyuluhan" class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity">
                    </div>
                    <div class="pt-4 pb-1 px-1 flex justify-between items-center">
                        <h3 class="font-display font-bold text-secondary text-lg uppercase tracking-wide">Penyuluhan</h3>
                        <span class="font-mono font-bold text-xs text-white bg-primary px-2 py-1 rounded">03 FEB</span>
                    </div>
                </div>

                <!-- Gallery Item 3 -->
                <div class="bg-white p-3 rounded-xl cursor-pointer group transition-all hover:-translate-y-1 hover:shadow-lg border border-slate-800/20">
                    <div class="w-full aspect-[4/3] overflow-hidden rounded-lg bg-slate-900">
                        <img src="https://picsum.photos/800/600?random=3" alt="Bazar Lokal" class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity">
                    </div>
                    <div class="pt-4 pb-1 px-1 flex justify-between items-center">
                        <h3 class="font-display font-bold text-secondary text-lg uppercase tracking-wide">Bazar Lokal</h3>
                        <span class="font-mono font-bold text-xs text-white bg-primary px-2 py-1 rounded">22 FEB</span>
                    </div>
                </div>
            </div>
            
            <!-- Button -->
            <div class="mt-16 text-center">
                <a href="#" class="inline-flex items-center justify-center border border-white/20 text-white bg-white/5 hover:bg-white/10 hover:border-white/40 px-6 py-3 rounded-lg font-bold transition-all">
                    Buka Arsip Lengkap
                </a>
            </div>
        </div>
    </div>


    <!-- KATALOG PRODUK SECTION -->
    <div id="katalog" class="w-full py-24 bg-white relative reveal-section">
        <div class="mx-auto max-w-7xl px-6 lg:px-12">
            
            <div class="flex flex-col mb-16 items-start md:items-center md:text-center">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-primary/10 text-primary rounded-full font-bold tracking-wider uppercase text-xs mb-4">
                    Indeks Komoditas Desa
                </div>
                <h2 class="text-4xl md:text-5xl font-display font-bold text-secondary uppercase tracking-wide mb-4">
                    Katalog Utama
                </h2>
                <div class="w-20 h-1 bg-primary md:mx-auto"></div>
            </div>

            <!-- Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($produks as $item)
                <div class="enterprise-card bg-slate-50/50 flex flex-col h-full group hover:shadow-lg transition-all duration-300">
                    <!-- Image Area -->
                    <div class="w-full aspect-[4/3] rounded-lg bg-slate-200 overflow-hidden relative mb-4 border border-slate-200/60">
                        <img src="{{ $item->gambar_url }}" alt="{{ $item->nama_produk }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @if($item->stok > 0)
                            <div class="absolute top-3 right-3 bg-primary text-white px-2.5 py-0.5 font-bold text-[11px] uppercase tracking-wider rounded-md shadow-sm">
                                Stok: {{ $item->stok }} {{ $item->satuan }}
                            </div>
                        @else
                            <div class="absolute top-3 right-3 bg-danger text-white px-2.5 py-0.5 font-bold text-[11px] uppercase tracking-wider rounded-md shadow-sm">
                                Habis
                            </div>
                        @endif
                        @if($item->kategori)
                            <div class="absolute bottom-3 left-3 bg-slate-900/80 backdrop-blur-sm text-white px-2.5 py-0.5 font-bold text-[10px] uppercase tracking-wider rounded">
                                {{ $item->kategori->nama_kategori }}
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col flex-grow">
                        <h3 class="text-lg font-display font-bold text-secondary uppercase tracking-wide mb-1 leading-snug group-hover:text-primary transition-colors line-clamp-1">
                            {{ $item->nama_produk }}
                        </h3>
                        <p class="text-slate-500 text-xs leading-relaxed mb-4 flex-grow line-clamp-2">
                            {{ $item->deskripsi ?: 'Komoditas berkualitas diproduksi langsung dari unit usaha dan masyarakat desa.' }}
                        </p>
                        
                        <div class="w-full pt-3 border-t border-slate-200 flex flex-col gap-2.5 mt-auto">
                            <div class="flex items-baseline justify-between">
                                <span class="text-xl font-display font-bold text-primary tracking-tight">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </span>
                                <span class="text-xs text-slate-400 font-semibold">/ {{ $item->satuan }}</span>
                            </div>
                            
                            @if($item->stok > 0)
                                <div class="grid grid-cols-2 gap-2">
                                    <form action="{{ route('cart.add') }}" method="POST" class="w-full">
                                        @csrf
                                        <input type="hidden" name="id_produk" value="{{ $item->id_produk }}">
                                        <input type="hidden" name="jumlah" value="1">
                                        <button type="submit" class="w-full py-2 px-2 rounded-md bg-white text-secondary font-bold text-xs border border-slate-300 hover:bg-slate-100 transition-all flex items-center justify-center gap-1 shadow-sm">
                                            +Keranjang
                                        </button>
                                    </form>
                                    <form action="{{ route('cart.add') }}" method="POST" class="w-full">
                                        @csrf
                                        <input type="hidden" name="id_produk" value="{{ $item->id_produk }}">
                                        <input type="hidden" name="jumlah" value="1">
                                        <input type="hidden" name="direct_checkout" value="1">
                                        <button type="submit" class="btn-enterprise-primary w-full text-xs py-2">
                                            Beli
                                        </button>
                                    </form>
                                </div>
                            @else
                                <button disabled class="w-full text-xs py-2 rounded-md bg-slate-200 text-slate-400 font-bold cursor-not-allowed">
                                    Stok Habis
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-1 sm:col-span-2 lg:col-span-4 py-12 text-center bg-slate-50 rounded-2xl border border-dashed border-slate-300">
                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <p class="text-slate-600 font-bold text-base">Belum Ada Komoditas Produk</p>
                    <p class="text-slate-400 text-xs mt-1">Produk yang diinput oleh Administrator akan otomatis muncul di sini.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-16 flex justify-center">
                <a href="{{ url('/katalog') }}" class="btn-enterprise-secondary px-8 py-3.5 flex items-center gap-2">
                    <span>Display Seluruh Komoditas</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const revealSections = document.querySelectorAll('.reveal-section');
    
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const sectionObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    revealSections.forEach(section => {
        sectionObserver.observe(section);
    });
});
</script>
@endsection
@extends('layouts.app')

@section('content')

<!-- Hero Background Wrapper -->
<div class="relative w-full h-[55vh] overflow-hidden bg-gray-900">
    <!-- Hero Image — fetchpriority tinggi agar tidak ada delay -->
    <img src="{{ asset('green-landscape-with-mountain.jpg') }}" alt="BUMDes Profil" fetchpriority="high" loading="eager"
        decoding="async" class="absolute inset-0 w-full h-full object-cover object-center">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/60"></div>

    <!-- Hero Content -->
    <div class="relative z-10 w-full h-full flex flex-col items-center justify-center text-center px-4 pt-20">
        <h1 class="text-4xl md:text-5xl lg:text-5xl font-extrabold text-white mb-4 tracking-tight">
            Profil <span class="text-transparent bg-clip-text bg-blue-300">BUMDes Go</span>
        </h1>
        <p class="text-lg md:text-xl text-white/90 max-w-2xl mt-2 font-light">
            Mengenal lebih dekat perjalanan, cita-cita, dan langkah nyata kami dalam memajukan perekonomian serta
            kesejahteraan masyarakat desa.
        </p>
    </div>
</div>

<!-- ====== PROFIL CONTENT SECTION ====== -->
<section
    class="w-full py-16 mt-[-2.5rem] relative bg-gray-50 z-20 rounded-t-[3rem] shadow-[0_-15px_40px_-15px_rgba(0,0,0,0.3)]">
    <div class="max-w-5xl mx-auto px-6 lg:px-12">

        <!-- Sejarah Section -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 border-b-2 border-blue-500 pb-2 inline-block">Sejarah</h2>
            <div class="prose prose-lg text-gray-700 max-w-none text-justify">
                <p class="leading-relaxed mb-4">
                    BUMDes (Badan Usaha Milik Desa) didirikan dengan semangat gotong royong dan tekad untuk mewujudkan
                    kemandirian ekonomi masyarakat desa. Berawal dari potensi lokal yang melimpah namun belum terkelola
                    dengan maksimal, para tokoh masyarakat dan pemerintah desa merintis pembentukan BUMDes ini sebagai
                    wadah pergerakan ekonomi desa.
                </p>
                <p class="leading-relaxed">
                    Seiring berjalannya waktu, BUMDes terus berkembang menjadi pilar ekonomi yang mewadahi berbagai unit
                    usaha, mulai dari sektor pertanian, pariwisata, hingga kerajinan dan UMKM (Usaha Mikro, Kecil, dan
                    Menengah). Transformasi digital melalui platform "BUMDes Go" merupakan langkah maju kami agar
                    produk-produk unggulan dapat menjangkau pasar yang lebih luas dan membawa dampak positif bagi
                    kemajuan ekonomi kerakyatan secara menyeluruh.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Visi Section -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6 text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi</h3>
                <p class="text-gray-700 leading-relaxed text-justify">
                    Menjadi motor penggerak ekonomi desa yang mandiri, inovatif, dan berdaya saing tinggi demi
                    mewujudkan kesejahteraan masyarakat yang merata dan berkelanjutan dengan senantiasa berpedoman pada
                    nilai-nilai kearifan lokal.
                </p>
            </div>

            <!-- Misi Section -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6 text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Misi</h3>
                <ul class="text-gray-700 space-y-3 leading-relaxed text-justify">
                    <li class="flex items-start">
                        <span class="text-blue-500 mr-2 mt-1 font-bold">•</span>
                        <span>Membangun dan mengembangkan unit usaha desa yang berbasis pada pengelolaan potensi
                            lokal.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-500 mr-2 mt-1 font-bold">•</span>
                        <span>Memberdayakan UMKM masyarakat desa setempat melalui inovasi dan digitalisasi
                            platform.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-500 mr-2 mt-1 font-bold">•</span>
                        <span>Menciptakan lapangan pekerjaan demi menekan angka pengangguran di wilayah pedesaan.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-500 mr-2 mt-1 font-bold">•</span>
                        <span>Meningkatkan Pendapatan Asli Desa (PADes) secara mandiri untuk menunjang sarana
                            umum.</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</section>

@endsection
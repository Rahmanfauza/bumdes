<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portal Login Pengurus BUMDesGO - Sistem Informasi Manajemen & Tata Kelola Usaha Desa">
    <title>Login Pengurus | BUMDesGO</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --font-sans: 'Source Sans 3', sans-serif;
            --font-display: 'Playfair Display', serif;
            --primary: #C2410C;
            --primary-dark: #9A3412;
            --bg-color: #FAFAF9;
            --text-main: #1C1917;
            --text-muted: #57534E;
            --border-color: #D6D3D1;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--bg-color);
            color: var(--text-main);
            /* Subtle grid pattern background to match enterprise style */
            background-image: linear-gradient(to right, rgba(28, 25, 23, 0.03) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(28, 25, 23, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .font-display {
            font-family: var(--font-display);
            letter-spacing: -0.02em;
        }

        /* Form Input focus transition */
        .custom-input {
            transition: all 0.2s ease-in-out;
        }
        .custom-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(194, 65, 12, 0.1);
        }

        /* Custom Radio for Actor Selection */
        .actor-radio:checked + label {
            border-color: var(--primary);
            background-color: rgba(194, 65, 12, 0.05);
        }
        .actor-radio:checked + label .actor-icon {
            color: var(--primary);
        }
        .actor-radio:checked + label .actor-title {
            color: var(--primary);
        }

        /* Left visual block styling */
        .visual-block {
            background-color: #1C1917;
            position: relative;
            overflow: hidden;
        }
        .visual-block::before {
            content: '';
            position: absolute;
            top: -20%; left: -20%; width: 140%; height: 140%;
            background: radial-gradient(circle at center, rgba(194, 65, 12, 0.15) 0%, transparent 60%);
        }
    </style>
</head>
<body class="h-full flex items-center justify-center p-4 sm:p-6 lg:p-8 relative">

    <!-- Main Container -->
    <div class="w-full max-w-[1000px] flex flex-col md:flex-row bg-white rounded-2xl shadow-xl overflow-hidden border border-[#D6D3D1]">
        
        <!-- Left Side: Visual / Branding -->
        <div class="visual-block w-full md:w-5/12 p-8 lg:p-12 flex flex-col justify-between">
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-[#C2410C] text-white rounded-lg flex items-center justify-center font-display text-2xl shrink-0">
                        B
                    </div>
                    <span class="text-3xl font-display font-bold text-white">
                        BUMDes<span class="text-[#C2410C]">GO</span>
                    </span>
                </div>
                
                <h1 class="text-3xl lg:text-4xl font-display font-bold text-white leading-tight mb-4">
                    Sistem Tata Kelola<br>Terpadu BUMDes
                </h1>
                <p class="text-slate-300 text-sm leading-relaxed">
                    Portal akses khusus bagi para pengurus BUMDes untuk mengelola keuangan, administrasi, produk, dan persetujuan dokumen.
                </p>
            </div>

            <div class="relative z-10 mt-12 space-y-4">
                <div class="flex items-center gap-4 bg-white/5 p-4 rounded-xl border border-white/10">
                    <div class="w-10 h-10 rounded-full bg-[#C2410C]/20 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-[#C2410C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <div>
                        <div class="text-white font-bold text-sm">Akses Terenkripsi</div>
                        <div class="text-slate-400 text-xs">Jalur otorisasi terpusat</div>
                    </div>
                </div>
            </div>
            
            <div class="relative z-10 mt-12 text-slate-500 text-xs font-semibold uppercase tracking-wider">
                Versi 2.0 (Admin Panel)
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full md:w-7/12 p-8 lg:p-12 bg-white relative">
            <div class="max-w-md mx-auto">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-[#1C1917] mb-2">Masuk ke Portal</h2>
                    <p class="text-[#57534E] text-sm">Pilih peran Anda dan masukkan kredensial akun.</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-red-800 font-semibold text-sm">{{ $errors->first() }}</span>
                        </div>
                    </div>
                @endif
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-green-800 font-semibold text-sm">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ url('/admin/login') }}" class="space-y-6">
                    @csrf

                    <!-- Actor Selection Grid -->
                    <div class="space-y-3">
                        <label class="block text-xs font-bold text-[#1C1917] uppercase tracking-wider">Otoritas Login (Aktor)</label>
                        <div class="grid grid-cols-2 gap-3">
                            <!-- Direktur -->
                            <div class="relative">
                                <input type="radio" name="actor" id="actor_direktur" value="direktur" class="actor-radio peer sr-only" checked>
                                <label for="actor_direktur" class="flex flex-col items-center justify-center p-3 border-2 border-[#E7E5E4] rounded-xl cursor-pointer hover:bg-[#F5F5F4] transition-all">
                                    <svg class="actor-icon w-6 h-6 text-[#78716C] mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <span class="actor-title text-sm font-bold text-[#57534E]">Direktur</span>
                                </label>
                            </div>
                            <!-- Sekretaris -->
                            <div class="relative">
                                <input type="radio" name="actor" id="actor_sekretaris" value="sekretaris" class="actor-radio peer sr-only">
                                <label for="actor_sekretaris" class="flex flex-col items-center justify-center p-3 border-2 border-[#E7E5E4] rounded-xl cursor-pointer hover:bg-[#F5F5F4] transition-all">
                                    <svg class="actor-icon w-6 h-6 text-[#78716C] mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <span class="actor-title text-sm font-bold text-[#57534E]">Sekretaris</span>
                                </label>
                            </div>
                            <!-- Bendahara -->
                            <div class="relative">
                                <input type="radio" name="actor" id="actor_bendahara" value="bendahara" class="actor-radio peer sr-only">
                                <label for="actor_bendahara" class="flex flex-col items-center justify-center p-3 border-2 border-[#E7E5E4] rounded-xl cursor-pointer hover:bg-[#F5F5F4] transition-all">
                                    <svg class="actor-icon w-6 h-6 text-[#78716C] mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="actor-title text-sm font-bold text-[#57534E]">Bendahara</span>
                                </label>
                            </div>
                            <!-- Admin POS/Produk -->
                            <div class="relative">
                                <input type="radio" name="actor" id="actor_admin" value="admin" class="actor-radio peer sr-only">
                                <label for="actor_admin" class="flex flex-col items-center justify-center p-3 border-2 border-[#E7E5E4] rounded-xl cursor-pointer hover:bg-[#F5F5F4] transition-all">
                                    <svg class="actor-icon w-6 h-6 text-[#78716C] mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                    <span class="actor-title text-sm font-bold text-[#57534E]">Admin (Operasional)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-xs font-bold text-[#1C1917] uppercase tracking-wider mb-1">Username Pengurus</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-[#A8A29E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <input id="username" name="username" type="text" required 
                                       class="custom-input block w-full pl-10 pr-3 py-3 border border-[#D6D3D1] rounded-xl text-[#1C1917] bg-[#FAFAF9] placeholder-[#A8A29E] focus:bg-white focus:outline-none sm:text-sm font-semibold" 
                                       placeholder="Contoh: direktur / bendahara">
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <label for="password" class="block text-xs font-bold text-[#1C1917] uppercase tracking-wider">Kata Sandi</label>
                                <a href="#" class="text-xs font-semibold text-[#C2410C] hover:text-[#9A3412]">Lupa sandi?</a>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-[#A8A29E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                                <input id="password" name="password" type="password" required 
                                       class="custom-input block w-full pl-10 pr-10 py-3 border border-[#D6D3D1] rounded-xl text-[#1C1917] bg-[#FAFAF9] placeholder-[#A8A29E] focus:bg-white focus:outline-none sm:text-sm font-semibold" 
                                       placeholder="••••••••">
                                
                                <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#A8A29E] hover:text-[#1C1917] focus:outline-none transition-colors">
                                    <svg id="eye-icon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-[#1C1917] hover:bg-[#C2410C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#C2410C] transition-all transform hover:-translate-y-0.5 mt-6">
                        Masuk ke Dashboard
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-[#E7E5E4] text-center">
                    <a href="{{ url('/') }}" class="text-sm font-semibold text-[#57534E] hover:text-[#C2410C] flex items-center justify-center gap-1 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Halaman Publik
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
</body>
</html>

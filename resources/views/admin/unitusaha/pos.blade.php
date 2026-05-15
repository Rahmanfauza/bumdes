@extends('layouts.admin')

@section('header_title', 'Kasir POS')

@section('content')
<div class="space-y-6" x-data="posApp()">
    <!-- Header Page -->
    <div class="flex items-center justify-between">
        <div class="inline-block px-[14px] py-[6px] bg-[#F5F5F4] text-[#57534E] font-semibold text-[14px] rounded-[9999px]">
            Modul Operasional
        </div>
    </div>

    <!-- Modul Internal Navigation -->
    <div class="flex flex-wrap gap-3 mt-4">
        <a href="{{ route('unit-usaha') }}" class="{{ request()->routeIs('unit-usaha') ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)]' : 'bg-white text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} px-6 py-2.5 font-semibold text-[14px] rounded-[8px] transition-all">
            Master Data Unit Usaha
        </a>
        <a href="{{ route('pos.index') }}" class="{{ request()->routeIs('pos.index') ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)]' : 'bg-white text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} px-6 py-2.5 font-semibold text-[14px] rounded-[8px] transition-all">
            Kasir POS
        </a>
        <a href="{{ route('simpan-pinjam.index') }}" class="{{ request()->routeIs('simpan-pinjam.index') ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)]' : 'bg-white text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} px-6 py-2.5 font-semibold text-[14px] rounded-[8px] transition-all">
            Simpan Pinjam Koperasi
        </a>
    </div>

    @if($errors->any())
        <div class="mt-4 bg-[#FEE2E2] border border-[#DC2626]/20 text-[#DC2626] px-4 py-3 rounded-[8px] font-semibold text-[14px]" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start mt-6">
        
        <!-- Kiri: Produk & Pencarian -->
        <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] shadow-sm flex flex-col min-h-[600px]">
            <div class="px-6 py-5 border-b border-[#D6D3D1] shrink-0">
                <h3 class="text-2xl font-display font-bold text-[#1C1917]">Pilih Produk</h3>
                <p class="text-[14px] text-[#57534E] mt-1">Tambahkan item ke keranjang</p>
            </div>
            <div class="p-6 flex flex-col flex-1">
                <div class="mb-6 shrink-0 relative">
                    <input type="text" x-model="searchQuery" placeholder="Cari nama produk..." 
                        class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] font-semibold placeholder-[#A8A29E] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-colors">
                    <svg class="w-5 h-5 absolute right-4 top-3.5 text-[#A8A29E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>

                <div class="flex-1 overflow-y-auto pr-2 space-y-3">
                    <template x-if="filteredProduks.length === 0">
                        <div class="text-center p-8 text-[#78716C] font-semibold bg-[#FAFAF9] border-2 border-dashed border-[#D6D3D1] rounded-[8px]">
                            Produk Tidak Ditemukan
                        </div>
                    </template>

                    <template x-for="item in filteredProduks" :key="item.id">
                        <div @click="addToCart(item)" class="flex justify-between items-center p-4 bg-white border border-[#D6D3D1] rounded-[8px] shadow-sm hover:shadow-md hover:border-[#C2410C]/30 cursor-pointer transition-all group">
                            <div>
                                <div class="font-semibold text-[#1C1917] text-[15px] uppercase" x-text="item.nama_produk"></div>
                                <div class="text-[12px] font-semibold text-[#78716C] mt-1">Stok Tersedia: <span x-text="item.stok_awal" class="text-[#DC2626]"></span></div>
                            </div>
                            <div class="font-semibold text-[14px] bg-[#F5F5F4] text-[#1C1917] border border-[#D6D3D1] px-3 py-1.5 rounded-[8px] group-hover:bg-[#C2410C] group-hover:text-white group-hover:border-[#C2410C] transition-colors">
                                Rp <span x-text="formatRupiah(item.harga_jual)"></span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Kanan: Keranjang & Checkout -->
        <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] shadow-sm flex flex-col min-h-[600px]">
            <div class="px-6 py-5 border-b border-[#D6D3D1] shrink-0">
                <h3 class="text-2xl font-display font-bold text-[#1C1917]">Keranjang</h3>
                <p class="text-[14px] text-[#57534E] mt-1">Daftar item belanja pelanggan</p>
            </div>

            <!-- List Item di Keranjang -->
            <div class="flex-1 overflow-y-auto p-6">
                <template x-if="cart.length === 0">
                    <div class="text-center p-8 text-[#78716C] font-semibold bg-[#FAFAF9] border-2 border-dashed border-[#D6D3D1] rounded-[8px] h-full flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 text-[#D6D3D1] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Keranjang Kosong
                    </div>
                </template>

                <div class="space-y-3">
                    <template x-for="(cartItem, index) in cart" :key="index">
                        <div class="flex justify-between items-center bg-white p-4 border border-[#D6D3D1] rounded-[8px] shadow-sm">
                            <div class="flex-1">
                                <div class="font-semibold text-[#1C1917] text-[15px] uppercase" x-text="cartItem.nama_produk"></div>
                                <div class="text-[13px] font-semibold text-[#78716C] mt-1">
                                    <span class="text-[#C2410C]" x-text="cartItem.qty"></span> x Rp <span x-text="formatRupiah(cartItem.harga_jual)"></span>
                                </div>
                            </div>
                            <div class="flex gap-4 items-center">
                                <div class="font-bold text-[15px] text-[#16A34A]">Rp <span x-text="formatRupiah(cartItem.qty * cartItem.harga_jual)"></span></div>
                                <button @click="removeFromCart(index)" class="w-8 h-8 flex items-center justify-center bg-[#FEE2E2] text-[#DC2626] rounded-[8px] hover:bg-[#DC2626] hover:text-white transition-colors" title="Hapus Item">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Footer: Total & Bayar -->
            <div class="p-6 border-t border-[#D6D3D1] shrink-0 bg-white rounded-b-[12px]">
                <div class="flex justify-between items-center mb-6 px-5 py-4 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px]">
                    <div class="font-bold text-[16px] text-[#57534E] uppercase tracking-wide">Total Pembayaran</div>
                    <div class="font-bold text-2xl text-[#16A34A]">Rp <span x-text="formatRupiah(totalAmount)"></span></div>
                </div>

                <button @click="openPaymentModal" :disabled="cart.length === 0" 
                    class="w-full py-4 bg-[#C2410C] text-white font-semibold rounded-[8px] shadow-sm hover:bg-[#9A3412] hover:shadow-[0_4px_12px_rgba(194,65,12,0.25)] transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                    Lanjut Pembayaran
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </div>

    </div>

    <!-- Modal Pembayaran -->
    <div x-show="paymentModalOpen" style="display: none;" 
        class="fixed inset-0 z-[70] bg-[#1C1917]/80 backdrop-blur-sm flex items-center justify-center p-4 sm:p-0">
        
        <div @click.away="paymentModalOpen = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            class="relative bg-[#FAFAF9] border border-[#D6D3D1] shadow-[0_24px_48px_rgba(28,25,23,0.12)] w-full max-w-4xl sm:mx-auto my-8 flex flex-col overflow-hidden rounded-[12px] max-h-[90vh]">
            
            <div class="p-6 border-b border-[#D6D3D1] shrink-0 bg-[#FAFAF9] relative">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-display font-bold text-[#1C1917]">Konfirmasi Pembayaran</h3>
                        <p class="text-[14px] text-[#57534E] mt-1">Pilih metode dan selesaikan transaksi</p>
                    </div>
                    <button @click="paymentModalOpen = false" type="button"
                        class="text-[#78716C] hover:text-[#1C1917] p-1 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="p-6 flex-1 bg-[#FAFAF9] flex flex-col lg:flex-row gap-8 overflow-y-auto">
                
                <!-- BAGIAN KIRI: STRUK PESANAN -->
                <div class="flex-1 flex flex-col bg-white border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm">
                    <div class="text-center mb-6 border-b border-dashed border-[#D6D3D1] pb-6">
                        <h4 class="font-bold text-xl text-[#1C1917] uppercase tracking-wide">Rincian Transaksi</h4>
                        <div class="text-[13px] font-semibold text-[#78716C] mt-2">{{ date('d M Y - H:i') }}</div>
                        <div class="inline-block mt-3 px-3 py-1 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[9999px] text-[12px] font-bold text-[#C2410C] uppercase" x-show="selectedPelanggan" x-text="'Pelanggan: ' + namaPelanggan"></div>
                        <div class="inline-block mt-3 px-3 py-1 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[9999px] text-[12px] font-bold text-[#57534E] uppercase" x-show="!selectedPelanggan">Umum / Guest</div>
                    </div>
                    
                    <!-- Item List -->
                    <div class="flex-1 overflow-y-auto pr-2 space-y-4 mb-6">
                        <template x-for="(cartItem, index) in cart" :key="index">
                            <div class="flex justify-between items-start font-semibold text-[#1C1917] border-b border-dashed border-[#D6D3D1] pb-3">
                                <div class="flex-1 pr-4">
                                    <div class="text-[14px] uppercase" x-text="cartItem.nama_produk"></div>
                                    <div class="text-[13px] text-[#78716C] mt-1"><span class="text-[#C2410C]" x-text="cartItem.qty"></span> x Rp <span x-text="formatRupiah(cartItem.harga_jual)"></span></div>
                                </div>
                                <div class="text-[14px]">Rp <span x-text="formatRupiah(cartItem.qty * cartItem.harga_jual)"></span></div>
                            </div>
                        </template>
                    </div>

                    <!-- Total di dalam Struk -->
                    <div class="border-t border-dashed border-[#D6D3D1] pt-6 mt-auto">
                        <div class="flex justify-between items-center px-4 py-3 bg-[#F5F5F4] rounded-[8px] border border-[#D6D3D1]">
                            <div class="font-bold text-[14px] text-[#57534E] uppercase tracking-wide">Total Biaya</div>
                            <div class="font-bold text-2xl text-[#16A34A]">Rp <span x-text="formatRupiah(totalAmount)"></span></div>
                        </div>
                    </div>
                </div>

                <!-- BAGIAN KANAN: PILIHAN METODE PEMBAYARAN -->
                <div class="flex-1 flex flex-col">
                    <h4 class="font-bold text-lg text-[#1C1917] mb-4">Pilih Metode Pembayaran</h4>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <!-- Pilihan Tunai -->
                        <label class="flex flex-col items-center justify-center p-4 cursor-pointer border rounded-[8px] transition-all"
                            :class="selectedMethod === 'tunai' ? 'border-[#C2410C] bg-[#FFF7ED] text-[#C2410C] ring-2 ring-[#C2410C]/20' : 'border-[#D6D3D1] bg-white hover:bg-[#F5F5F4] text-[#1C1917]'">
                            <input type="radio" name="payment_method" value="tunai" x-model="selectedMethod" class="hidden">
                            <span class="font-bold text-[15px] uppercase tracking-wide">Tunai</span>
                            <span class="text-[12px] font-semibold mt-1" :class="selectedMethod === 'tunai' ? 'text-[#C2410C]/80' : 'text-[#78716C]'">Cash on Kasir</span>
                        </label>
                        
                        <!-- Pilihan QRIS -->
                        <label class="flex flex-col items-center justify-center p-4 cursor-pointer border rounded-[8px] transition-all"
                            :class="selectedMethod === 'qris' ? 'border-[#C2410C] bg-[#FFF7ED] text-[#C2410C] ring-2 ring-[#C2410C]/20' : 'border-[#D6D3D1] bg-white hover:bg-[#F5F5F4] text-[#1C1917]'">
                            <input type="radio" name="payment_method" value="qris" x-model="selectedMethod" class="hidden">
                            <span class="font-bold text-[15px] uppercase tracking-wide">Q-RIS</span>
                            <span class="text-[12px] font-semibold mt-1" :class="selectedMethod === 'qris' ? 'text-[#C2410C]/80' : 'text-[#78716C]'">Scan Barcode</span>
                        </label>

                        <!-- Pilihan DANA -->
                        <label class="flex flex-col items-center justify-center p-4 cursor-pointer border rounded-[8px] transition-all"
                            :class="selectedMethod === 'dana' ? 'border-[#C2410C] bg-[#FFF7ED] text-[#C2410C] ring-2 ring-[#C2410C]/20' : 'border-[#D6D3D1] bg-white hover:bg-[#F5F5F4] text-[#1C1917]'">
                            <input type="radio" name="payment_method" value="dana" x-model="selectedMethod" class="hidden">
                            <span class="font-bold text-[15px] uppercase tracking-wide">DANA</span>
                            <span class="text-[12px] font-semibold mt-1" :class="selectedMethod === 'dana' ? 'text-[#C2410C]/80' : 'text-[#78716C]'">E-Wallet App</span>
                        </label>

                        <!-- Pilihan TF Bank -->
                        <label class="flex flex-col items-center justify-center p-4 cursor-pointer border rounded-[8px] transition-all"
                            :class="selectedMethod === 'transfer_bank' ? 'border-[#C2410C] bg-[#FFF7ED] text-[#C2410C] ring-2 ring-[#C2410C]/20' : 'border-[#D6D3D1] bg-white hover:bg-[#F5F5F4] text-[#1C1917]'">
                            <input type="radio" name="payment_method" value="transfer_bank" x-model="selectedMethod" class="hidden">
                            <span class="font-bold text-[15px] uppercase tracking-wide">TF Bank</span>
                            <span class="text-[12px] font-semibold mt-1" :class="selectedMethod === 'transfer_bank' ? 'text-[#C2410C]/80' : 'text-[#78716C]'">Virtual Account</span>
                        </label>
                    </div>

                    <!-- Sub Pilihan Bank (Tampil kalau pilih TF BANK) -->
                    <div x-show="selectedMethod === 'transfer_bank'" x-collapse class="mb-6">
                        <div class="p-4 border border-[#D6D3D1] rounded-[8px] bg-[#F5F5F4]">
                            <label class="block font-semibold text-[13px] text-[#1C1917] mb-2 uppercase tracking-wide">Pilih Bank Tujuan :</label>
                            <select x-model="selectedBank" class="w-full px-4 py-3 bg-white border border-[#D6D3D1] rounded-[8px] font-semibold text-[15px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-colors uppercase appearance-none">
                                <option value="bri">Bank BRI</option>
                                <option value="bca">Bank BCA</option>
                                <option value="mandiri">Bank Mandiri</option>
                                <option value="bni">Bank BNI</option>
                            </select>
                        </div>
                    </div>

                    <!-- Pilihan Pelanggan -->
                    <div class="mb-6">
                        <div class="p-4 border border-[#D6D3D1] rounded-[8px] bg-[#F5F5F4]">
                            <label class="block font-semibold text-[13px] text-[#1C1917] mb-2 uppercase tracking-wide">Hubungkan Pelanggan (Opsional) :</label>
                            <select x-model="selectedPelanggan" class="w-full px-4 py-3 bg-white border border-[#D6D3D1] rounded-[8px] font-semibold text-[15px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-colors uppercase appearance-none">
                                <option value="">-- TANPA PELANGGAN --</option>
                                @foreach($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">{{ strtoupper($pelanggan->nama_lengkap) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Form Hidden utk Checkout -->
                    <form action="{{ route('pos.checkout') }}" method="POST" id="formCheckout" class="mt-auto pt-4">
                        @csrf
                        <input type="hidden" name="cart" :value="JSON.stringify(cart)">
                        <input type="hidden" name="total" :value="totalAmount">
                        <input type="hidden" name="metode" :value="selectedMethod === 'transfer_bank' ? ('TF BANK ' + selectedBank.toUpperCase()) : selectedMethod.toUpperCase()">
                        <input type="hidden" name="pelanggan_id" :value="selectedPelanggan">

                        <button type="submit" :disabled="!selectedMethod"
                            class="w-full py-4 bg-[#C2410C] text-white font-semibold rounded-[8px] shadow-sm hover:bg-[#9A3412] transition-all disabled:opacity-50 disabled:cursor-not-allowed text-[16px] flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Selesaikan Pembayaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('posApp', () => ({
            produks: @json($produks ?? []),
            pelanggans: @json($pelanggans ?? []),
            searchQuery: '',
            cart: [],
            paymentModalOpen: false,
            selectedMethod: 'tunai', // Default TUNAI
            selectedBank: 'bri', // Default sub-opsi bank
            selectedPelanggan: '', // Default tanpa pelanggan

            get namaPelanggan() {
                if (!this.selectedPelanggan) return '';
                let p = this.pelanggans.find(x => x.id == this.selectedPelanggan);
                return p ? p.nama_lengkap : '';
            },

            get filteredProduks() {
                let q = this.searchQuery.toLowerCase().trim();
                if(q === '') return this.produks;
                return this.produks.filter(p => {
                    return p.nama_produk.toLowerCase().includes(q) 
                });
            },

            addToCart(produk) {
                if(produk.stok_awal <= 0) {
                    alert('STOK HABIS!'); return;
                }
                
                let exists = this.cart.find(c => c.id === produk.id);
                if(exists) {
                    if(exists.qty < produk.stok_awal) {
                        exists.qty++;
                    } else {
                        alert('MELEBIHI SISA STOK!');
                    }
                } else {
                    this.cart.push({
                        id: produk.id,
                        nama_produk: produk.nama_produk,
                        harga_jual: parseInt(produk.harga_jual),
                        stok_awal: produk.stok_awal,
                        qty: 1
                    });
                }
            },

            removeFromCart(index) {
                this.cart.splice(index, 1);
            },

            get totalAmount() {
                return this.cart.reduce((sum, item) => sum + (item.harga_jual * item.qty), 0);
            },

            openPaymentModal() {
                if(this.cart.length > 0) {
                    this.paymentModalOpen = true;
                }
            },

            formatRupiah(angka) {
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        }));
    });
</script>
@endsection

@extends('layouts.admin')

@section('header_title', 'Buat Transaksi Baru (POS)')

@section('content')
<div x-data="posApp()" class="flex flex-col lg:flex-row gap-6">

    <!-- Area Kiri: Daftar Produk -->
    <div class="flex-1 flex flex-col gap-4">
        <!-- Input Pencarian & Filter -->
        <div class="bg-white border border-[#D6D3D1] rounded-[12px] p-4 shadow-sm flex gap-3">
            <div class="relative flex-1">
                <input type="text" x-model="searchQuery" placeholder="Cari produk..."
                    class="w-full pl-10 pr-4 py-2 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] bg-[#FAFAF9] text-[#1C1917]">
                <svg class="w-5 h-5 absolute left-3 top-2.5 text-[#78716C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>

        <!-- Grid Produk -->
        <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 overflow-y-auto max-h-[70vh] pr-2 pb-10">
            <template x-for="produk in filteredProduks" :key="produk.id">
                <div @click="addToCart(produk)"
                    class="bg-white border border-[#D6D3D1] rounded-[12px] p-4 shadow-sm hover:border-[#C2410C] hover:shadow-md cursor-pointer transition-all flex flex-col justify-between h-full group">
                    <div>
                        <div class="w-full h-24 bg-[#F5F5F4] rounded-[8px] mb-3 flex items-center justify-center text-[#A8A29E] group-hover:bg-[#FFF7ED] transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <h3 class="font-semibold text-[#1C1917] text-sm leading-tight mb-1" x-text="produk.nama"></h3>
                        <p class="text-xs text-[#78716C] mb-2">Stok: <span x-text="produk.stok"></span> <span x-text="produk.satuan"></span></p>
                    </div>
                    <div class="font-bold text-[#C2410C] text-[15px]" x-text="formatRupiah(produk.harga)"></div>
                </div>
            </template>
            <div x-show="filteredProduks.length === 0" class="col-span-full py-10 text-center text-[#78716C]">
                Produk tidak ditemukan.
            </div>
        </div>
    </div>

    <!-- Area Kanan: Keranjang Kasir -->
    <div class="w-full lg:w-[380px] shrink-0 bg-white border border-[#D6D3D1] rounded-[12px] flex flex-col h-[calc(100vh-8rem)] sticky top-6 shadow-sm overflow-hidden">
        
        <div class="p-4 border-b border-[#D6D3D1] bg-[#FAFAF9]">
            <h2 class="text-lg font-bold text-[#1C1917] flex items-center justify-between">
                Rincian Transaksi
                <span class="bg-[#C2410C] text-white text-xs px-2 py-0.5 rounded-full" x-text="cart.length + ' Item'"></span>
            </h2>
        </div>

        <div class="flex-1 overflow-y-auto p-4 space-y-3 bg-white">
            <template x-if="cart.length === 0">
                <div class="h-full flex flex-col items-center justify-center text-[#A8A29E] space-y-2 pb-10">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <p class="text-sm">Keranjang masih kosong</p>
                </div>
            </template>

            <template x-for="(item, index) in cart" :key="item.id">
                <div class="flex justify-between items-start border-b border-[#E7E5E4] pb-3 last:border-0 last:pb-0">
                    <div class="flex-1 pr-3">
                        <h4 class="font-semibold text-sm text-[#1C1917] truncate" x-text="item.nama"></h4>
                        <div class="text-xs text-[#78716C] mt-0.5" x-text="formatRupiah(item.harga) + ' / ' + item.satuan"></div>
                        <div class="flex items-center gap-2 mt-2">
                            <button @click="updateQty(index, -1)" class="w-6 h-6 rounded bg-[#F5F5F4] text-[#57534E] flex items-center justify-center hover:bg-[#E7E5E4] transition-colors">-</button>
                            <span class="text-sm font-semibold w-6 text-center" x-text="item.qty"></span>
                            <button @click="updateQty(index, 1)" class="w-6 h-6 rounded bg-[#F5F5F4] text-[#57534E] flex items-center justify-center hover:bg-[#E7E5E4] transition-colors">+</button>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-[#C2410C] text-sm" x-text="formatRupiah(item.harga * item.qty)"></div>
                        <button @click="removeItem(index)" class="text-[#DC2626] text-xs font-semibold mt-3 hover:underline">Hapus</button>
                    </div>
                </div>
            </template>
        </div>

        <form action="{{ route('admin.transaksi.store') }}" method="POST" class="p-4 border-t border-[#D6D3D1] bg-[#FAFAF9]" @submit="prepareForm">
            @csrf
            
            <div class="mb-3">
                <label class="block text-xs font-semibold text-[#57534E] mb-1">Pelanggan (Opsional)</label>
                <select name="id_pelanggan" class="w-full px-3 py-2 border border-[#D6D3D1] rounded-[6px] text-sm focus:outline-none focus:border-[#C2410C] bg-white">
                    <option value="">-- Pelanggan Umum --</option>
                    @foreach($pelanggans as $p)
                        <option value="{{ $p->id_pelanggan }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-[#57534E] mb-1">Metode Bayar</label>
                <select name="metode_bayar" class="w-full px-3 py-2 border border-[#D6D3D1] rounded-[6px] text-sm focus:outline-none focus:border-[#C2410C] bg-white">
                    <option value="tunai">Tunai / Cash</option>
                    <option value="transfer">Transfer Bank</option>
                    <option value="qris">QRIS</option>
                </select>
            </div>

            <div class="flex justify-between items-center mb-4 text-[#1C1917]">
                <span class="font-bold">Total Tagihan</span>
                <span class="font-bold text-xl text-[#C2410C]" x-text="formatRupiah(totalCart)"></span>
            </div>

            <div id="hidden-inputs"></div>
            
            <button type="submit" :disabled="cart.length === 0"
                class="w-full bg-[#C2410C] hover:bg-[#9A3412] disabled:bg-[#D6D3D1] disabled:cursor-not-allowed text-white py-3 rounded-[8px] font-bold text-sm tracking-wide transition-colors">
                PROSES PEMBAYARAN
            </button>
        </form>

    </div>
</div>

<script>
function posApp() {
    return {
        produks: @json($produks->map(function($p) {
            return [
                'id' => $p->id_produk,
                'nama' => $p->nama_produk,
                'harga' => $p->harga,
                'stok' => $p->stok,
                'satuan' => $p->satuan
            ];
        })),
        searchQuery: '',
        cart: [],
        
        get filteredProduks() {
            if (this.searchQuery === '') {
                return this.produks;
            }
            return this.produks.filter(p => p.nama.toLowerCase().includes(this.searchQuery.toLowerCase()));
        },

        get totalCart() {
            return this.cart.reduce((total, item) => total + (item.harga * item.qty), 0);
        },

        addToCart(produk) {
            const existing = this.cart.find(item => item.id === produk.id);
            if (existing) {
                if (existing.qty < produk.stok) {
                    existing.qty++;
                } else {
                    alert('Stok tidak mencukupi!');
                }
            } else {
                if (produk.stok > 0) {
                    this.cart.push({ ...produk, qty: 1 });
                }
            }
        },

        updateQty(index, change) {
            const item = this.cart[index];
            const newQty = item.qty + change;
            
            if (newQty > 0 && newQty <= item.stok) {
                item.qty = newQty;
            }
        },

        removeItem(index) {
            this.cart.splice(index, 1);
        },

        formatRupiah(angka) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
        },

        prepareForm(e) {
            if (this.cart.length === 0) {
                e.preventDefault();
                alert('Keranjang masih kosong!');
                return;
            }
            
            const container = document.getElementById('hidden-inputs');
            container.innerHTML = '';
            
            this.cart.forEach((item, index) => {
                container.innerHTML += `<input type="hidden" name="items[${index}][id_produk]" value="${item.id}">`;
                container.innerHTML += `<input type="hidden" name="items[${index}][qty]" value="${item.qty}">`;
            });
        }
    }
}
</script>
@endsection

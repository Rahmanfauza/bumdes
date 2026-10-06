import './bootstrap';

/**
 * Helper global pemformatan angka Rupiah dengan pemisah ribuan otomatis.
 */
window.formatRupiahInput = function(angka) {
    if (!angka) return '';
    let numberString = angka.toString().replace(/[^,\d]/g, '');
    let split = numberString.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return rupiah;
};

/**
 * Parsing string berformat rupiah kembali ke angka murni.
 */
window.unformatRupiah = function(formatted) {
    if (!formatted) return 0;
    let clean = formatted.toString().replace(/\./g, '').replace(/,/g, '.');
    return parseFloat(clean) || 0;
};

// Pasang event listener untuk input berkelas .rupiah-input
document.addEventListener('DOMContentLoaded', function () {
    document.body.addEventListener('input', function (e) {
        if (e.target && e.target.classList.contains('rupiah-input')) {
            let cursorPosition = e.target.selectionStart;
            let originalLength = e.target.value.length;
            
            e.target.value = window.formatRupiahInput(e.target.value);
            
            let newLength = e.target.value.length;
            cursorPosition = cursorPosition + (newLength - originalLength);
            if (cursorPosition >= 0) {
                e.target.setSelectionRange(cursorPosition, cursorPosition);
            }
        }
    });

    // Format nilai awal saat halaman dimuat
    document.querySelectorAll('.rupiah-input').forEach(function(input) {
        if (input.value) {
            input.value = window.formatRupiahInput(input.value);
        }
    });
});

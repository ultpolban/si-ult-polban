/* =====================================================================
   ULT SELECT - SI ULT POLBAN
   ---------------------------------------------------------------------
   Mengubah <select> biasa menjadi drop-down yang bisa DICARI
   (Select2) supaya pengguna tidak perlu menggulir daftar panjang.

   Aturan:
     - jumlah opsi >= MIN_OPTIONS  ->  otomatis searchable
     - <select data-ult-search>    ->  selalu searchable
     - <select data-ult-native>    ->  dibiarkan apa adanya
     - select multiple/disabled/tersembunyi -> dilewati
     - select di dalam DataTable                -> dilewati

   API:
     window.ultSelects.refresh(container)
     window.ultSelects.destroy(container)

   Butuh jQuery + Select2. Kalau tidak tersedia, skrip ini diam
   dan select asli tetap berfungsi normal.
   ===================================================================== */

(function (window, document) {
    'use strict';

    // ============ KONFIGURASI ============

    // PENTING: Select2 hanya dipasang bila <select> diberi atribut
    //            data-ult-search (daftar panjang). Semua select lain
    //            tetap <select> biasa yang sudah dirapikan oleh
    //            ult-select.css, jadi tampilan default tetap polos.
    //
    // Ingin mengaktifkan otomatis juga? naikkan AUTO_MIN_OPTIONS
    // (mis. 8). Isi 0 berarti nonaktif.
    var AUTO_MIN_OPTIONS = 0;

    var SEARCH_PLACEHOLDER = 'Ketik untuk mencari...';
    var NO_RESULT = 'Tidak ada hasil';
    var NO_SEARCH_RESULT = 'Kata kunci tidak ditemukan';
    var SEARCHING = 'Mencari...';
    var CLEAR = 'Hapus pilihan';

    var DATA_FLAG = 'ultSelect2Ready';

    function hasSelect2() {
        return !!(window.jQuery && window.jQuery.fn && window.jQuery.fn.select2);
    }

    // ============ SELEKSI KANDIDAT ============

    function isEligible(el) {
        if (!el || el.nodeType !== 1) { return false; }
        if (el.tagName !== 'SELECT') { return false; }

        if (el.getAttribute(DATA_FLAG) === '1') { return false; }
        if (window.jQuery(el).data('select2')) { return false; }

        // Opt-out eksplisit
        if (el.hasAttribute('data-ult-native')) { return false; }
        if (el.getAttribute('data-ult-search') === 'false') { return false; }

        if (el.multiple || el.disabled) { return false; }
        if (el.hasAttribute('readonly')) { return false; }

        // Yang dikontrol library lain
        if (window.jQuery(el).closest('.dataTables_wrapper').length) { return false; }

        // Tidak ada pilihan / tidak punya identitas
        if (el.options.length === 0) { return false; }
        if (!el.id && !el.name) { return false; }

        return true;
    }

    /**
     * Perlu dibuat searchable?
     *   - <select data-ult-search>  -> ya
     *   - <select data-ult-native>  -> tidak
     *   - selain itu                -> hanya bila AUTO_MIN_OPTIONS > 0
     *                                    dan jumlah opsi cukup banyak
     */
    function needsSearch(el) {
        if (el.hasAttribute('data-ult-native')) { return false; }

        var flag = el.getAttribute('data-ult-search');

        if (flag === 'false') { return false; }
        if (flag !== null && flag !== undefined) { return true; }

        if (AUTO_MIN_OPTIONS > 0 && el.options.length >= AUTO_MIN_OPTIONS) {
            return true;
        }

        return false;
    }


    // ============ OPSI SELECT2 ============

    // CATATAN PENTING:
    // Jangan pernah menimpa `templateSelection` / `placeholder` di sini.
    //
    // Select2 4.x otomatis:
    //   - menampilkan teks opsi yang terpilih, dan
    //   - memberi kelas `select2-selection__placeholder` (teks abu-abu)
    //     pada opsi pertama yang valuenya kosong.
    //
    // Kalau `templateSelection` dioverride, Select2 berhenti
    // menambahkan kelas placeholder itu sehingga kolomnya tampil KOSONG.
    // Itu bug yang pernah terjadi. Karena itu biarkan bawaannya.

    function buildOptions(el) {
        return {
            // PENTING: dropdown ditaruh di <body> supaya tidak terpotong
            // container overflow (auth-right, modal, kartu filter, dll).
            dropdownParent: window.jQuery(document.body),

            width: '100%',
            closeOnSelect: !el.multiple,

            // Minimal 1 ketikan -> langsung mencari
            minimumResultsForSearch: 1,
            minimumInputLength: 0,

            // Bahasa Indonesia
            language: {
                noResults: function () { return NO_RESULT; },
                searching: function () { return SEARCHING; },
                inputTooShort: function () { return ''; },
                errorLoading: function () { return NO_RESULT; },
                inputTooLong: NO_SEARCH_RESULT,
                selectionTooBig: NO_SEARCH_RESULT,
                noMoreResults: NO_SEARCH_RESULT,
                searchPlaceholder: SEARCH_PLACEHOLDER,
                removeAllItems: CLEAR,
                removeItem: CLEAR
            },

            // Pencarian sederhana, mendukung optgroup
            matcher: function (params, data) {
                if (params.term === undefined || params.term === null || params.term === '') {
                    return data;
                }

                var term = params.term.toLowerCase();

                if (data.children && data.children.length > 0) {
                    var childMatch = $.map(data.children, function (child) {
                        if (child.text.toLowerCase().indexOf(term) > -1) {
                            child.match = true;
                            return child.text;
                        }

                        return null;
                    });

                    if (childMatch.length > 0) {
                        data.text += ' (' + childMatch.length + ')';
                        return data;
                    }

                    return null;
                }

                return data.text.toLowerCase().indexOf(term) > -1 ? data : null;
            }
        };
    }

    // ============ INISIALISASI ============

    function collect(root) {
        var $root = root ? window.jQuery(root) : window.jQuery(document);

        return $root.find('select').addBack('select');
    }

    function init(root) {
        if (!hasSelect2()) { return; }

        collect(root).each(function () {
            var el = this;

            // Hanya yang ditandai cari / punya daftar panjang
            if (!needsSearch(el)) { return; }
            if (!isEligible(el)) { return; }

            try {
                window.jQuery(el).select2(buildOptions(el));
                el.setAttribute(DATA_FLAG, '1');
            } catch (e) {
                // Gagal -> select asli tetap dipakai
            }
        });
    }

    /**
     * Inisialisasi ulang untuk select yang isi option-nya berubah
     * (mis. form registrasi yang dimuat lewat AJAX).
     */
    function refresh(root) {
        if (!hasSelect2()) { return; }

        collect(root).each(function () {
            var el = this;

            if (window.jQuery(el).data('select2')) {
                try {
                    window.jQuery(el).select2('destroy');
                    el.removeAttribute(DATA_FLAG);
                } catch (e) { return; }
            }

            if (!needsSearch(el)) { return; }
            if (!isEligible(el)) { return; }

            try {
                window.jQuery(el).select2(buildOptions(el));
                el.setAttribute(DATA_FLAG, '1');
            } catch (e) { /* biarkan select asli */ }
        });
    }

    /**
     * Kembalikan ke <select> biasa.
     */
    function destroy(root) {
        if (!hasSelect2()) { return; }

        collect(root).each(function () {
            var el = this;

            if (!window.jQuery(el).data('select2')) { return; }

            try {
                window.jQuery(el).select2('destroy');
                el.removeAttribute(DATA_FLAG);
            } catch (e) { /* abaikan */ }
        });
    }


    // ============================================================
    //  CEGAH SCROLLBAR HALAMAN UTAMA MUNCUL SAAT DROPDOWN DIBUKA
    // ============================================================
    //  Select2 menaruh dropdown-nya di <body>. Kalau daftar opsi
    //  panjang atau letaknya dekat tepi bawah, halaman bisa ikut
    //  memanjang sehingga muncul scrollbar yang tidak diinginkan.
    //
    //  PENTING: scrollbar desktop biasanya menempel pada <html>,
    //  BUKAN <body>. Kalau hanya <body> yang dikunci, scrollbar-nya
    //  tetap ada -> padding kompensasi justru membuat konten bergeser
    //  sedikit ke kanan. Karena itu KEDUA elemen dikunci.
    //
    //  Urutan yang benar:
    //    1. ukur lebar scrollbar yang SEDANG tampil
    //    2. kunci <html> + <body>
    //    3. baru tambah padding-right sebesar scrollbar itu
    //  Dengan begitu ruang yang hilang = padding yang ditambahkan,
    //  sehingga tampilan form TETAP DIEM (tidak bergeser).

    var scrollLock = false;
    var saved = {
        bodyPadding: '',
        bodyOverflow: '',
        htmlOverflow: ''
    };

    function lockPageScroll() {
        if (scrollLock) { return; }

        var body = document.body;
        var html = document.documentElement;

        // 1. Lebar scrollbar yang saat ini tampil
        var scrollbarWidth = window.innerWidth - html.clientWidth;

        // Simpan nilai asli supaya bisa dikembalikan persis
        saved.bodyPadding  = body.style.paddingRight;
        saved.bodyOverflow = body.style.overflow;
        saved.htmlOverflow = html.style.overflow;

        // 2. Kunci kedua elemen
        html.style.overflow = 'hidden';
        body.style.overflow = 'hidden';

        // 3. Kompensasi ruang yang baru saja hilang
        if (scrollbarWidth > 0) {
            var current = parseFloat(window.getComputedStyle(body).paddingRight) || 0;
            body.style.paddingRight = (current + scrollbarWidth) + 'px';
        }

        body.classList.add('ult-select-opened');
        html.classList.add('ult-select-lock');
        scrollLock = true;
    }

    function unlockPageScroll() {
        if (!scrollLock) { return; }

        var body = document.body;
        var html = document.documentElement;

        // Kembalikan persis ke nilai semula
        body.style.paddingRight = saved.bodyPadding;
        body.style.overflow      = saved.bodyOverflow;
        html.style.overflow      = saved.htmlOverflow;

        body.classList.remove('ult-select-opened');
        html.classList.remove('ult-select-lock');

        saved = { bodyPadding: '', bodyOverflow: '', htmlOverflow: '' };
        scrollLock = false;
    }

    function watchScrollLock() {
        if (!hasSelect2()) { return; }

        var $ = window.jQuery;

        // Delegasi: berlaku untuk select yang di-upgrade kapan pun
        // (termasuk yang baru dimuat lewat AJAX).
        $(document).on('select2:open', function () {
            lockPageScroll();
        });

        $(document).on('select2:close', function () {
            unlockPageScroll();
        });

        // Jaring pengaman: tutup dropdown saat klik di luar atau tekan Esc.
        $(document).on('click', function (e) {
            if (!scrollLock) { return; }

            if ($(e.target).closest('.select2-container').length === 0) {
                unlockPageScroll();
            }
        });

        $(document).on('keyup', function (e) {
            if (scrollLock && e.key === 'Escape') {
                unlockPageScroll();
            }
        });
    }

    // ============ PANGAUAN ISI DINAMIS ============
    // Halaman registrasi mengganti isi form lewat AJAX
    // ($('#dynamicFields').html(...)). Tanpa ini, dropdown yang baru
    // dimuat tidak akan jadi searchable.

    function watchContent() {
        if (!hasSelect2() || !window.MutationObserver) { return; }

        var pending = null;

        var observer = new window.MutationObserver(function (mutations) {
            var root = null;

            mutations.forEach(function (m) {
                for (var i = 0; i < m.addedNodes.length; i++) {
                    var node = m.addedNodes[i];
                    if (node.nodeType === 1 && !root) { root = node; }
                }
            });

            if (!root) { return; }

            // Gabungkan beberapa mutasi jadi satu kali refresh
            if (pending) { window.clearTimeout(pending); }

            pending = window.setTimeout(function () {
                pending = null;
                refresh(root);
            }, 80);
        });

        observer.observe(document.body, { childList: true, subtree: true });
    }

    // ============ JALANKAN ============

    function boot() {
        if (!hasSelect2()) { return; }

        init();
        watchScrollLock();
        watchContent();
    }

    window.ultSelects = {
        init: init,
        refresh: refresh,
        destroy: destroy,
        AUTO_MIN_OPTIONS: AUTO_MIN_OPTIONS
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }

})(window, document);

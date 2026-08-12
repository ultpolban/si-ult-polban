<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Dashboard Pimpinan</h3>
            <p class="text-muted mb-0">Ringkasan kinerja Unit Layanan Terpadu</p>
        </div>
        <div class="d-flex align-items-center">
            <select class="select-filter mr-2" id="periodeFilter" style="height: 38px;">
                <option>01 Mei 2024 - 07 Mei 2024</option>
                <option>Minggu Ini</option>
                <option>Bulan Ini</option>
                <option>Tahun Ini</option>
            </select>
            <button class="btn btn-filter-submit d-flex align-items-center mr-2" style="height: 38px; border-radius: 8px;">
                <i class="fas fa-sync-alt mr-1"></i> Refresh
            </button>
            <!-- Export Buttons -->
            <div class="dropdown">
                <button class="btn d-flex align-items-center dropdown-toggle" id="exportDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    style="height: 38px; border-radius: 8px; background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%); color: #fff; border: none; font-weight: 600; padding: 0 18px; box-shadow: 0 4px 10px rgba(15, 118, 110, 0.2);">
                    <i class="fas fa-download mr-1"></i> Ekspor
                </button>
                <div class="dropdown-menu dropdown-menu-right shadow border-0" style="border-radius: 10px; min-width: 180px; padding: 8px 0;" aria-labelledby="exportDropdown">
                    <a class="dropdown-item d-flex align-items-center py-2 px-3" href="#" id="exportPdf" style="font-size: 0.9rem; font-weight: 500; color: #f7921d;">
                        <i class="fas fa-file-pdf mr-2" style="width: 18px;"></i> Ekspor PDF
                    </a>
                    <a class="dropdown-item d-flex align-items-center py-2 px-3" href="#" id="exportExcel" style="font-size: 0.9rem; font-weight: 500; color: #16a34a;">
                        <i class="fas fa-file-excel mr-2" style="width: 18px;"></i> Ekspor Excel
                    </a>
                    <a class="dropdown-item d-flex align-items-center py-2 px-3" href="#" id="exportCsv" style="font-size: 0.9rem; font-weight: 500; color: #2563eb;">
                        <i class="fas fa-file-csv mr-2" style="width: 18px;"></i> Ekspor CSV
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item d-flex align-items-center py-2 px-3" href="#" onclick="window.print(); return false;" style="font-size: 0.9rem; font-weight: 500; color: #475569;">
                        <i class="fas fa-print mr-2" style="width: 18px;"></i> Cetak Halaman
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 5 Stat Cards Row -->
    <div class="row">
        <!-- Card 1: Total Tiket -->
        <div class="col-xl col-md-4 col-sm-6 col-12">
            <div class="card-stat card-stat-blue" style="min-height: 120px;">
                <div>
                    <div class="stat-label" style="font-size: 0.85rem;">Total Tiket</div>
                    <div class="stat-value" style="font-size: 1.8rem;"><?= number_format($totalTicket, 0, ',', '.') ?></div>
                </div>
                <div class="stat-meta" style="font-size: 0.72rem;">
                    <i class="fas fa-arrow-up"></i> +12% dari periode lalu
                </div>
            </div>
        </div>

        <!-- Card 2: Tiket Selesai -->
        <div class="col-xl col-md-4 col-sm-6 col-12">
            <div class="card-stat card-stat-orange" style="min-height: 120px;">
                <div>
                    <div class="stat-label" style="font-size: 0.85rem;">Tiket Selesai</div>
                    <div class="stat-value" style="font-size: 1.8rem;"><?= number_format($ticketSelesai, 0, ',', '.') ?></div>
                </div>
                <div class="stat-meta" style="font-size: 0.72rem;">
                    <i class="fas fa-arrow-up"></i> +15% dari periode lalu
                </div>
            </div>
        </div>

        <!-- Card 3: SLA Tercapai -->
        <div class="col-xl col-md-4 col-sm-6 col-12">
            <div class="card-stat card-stat-teal" style="min-height: 120px;">
                <div>
                    <div class="stat-label" style="font-size: 0.85rem;">SLA Tercapai</div>
                    <div class="stat-value" style="font-size: 1.8rem;"><?= $slaTercapai ?></div>
                </div>
                <div class="stat-meta" style="font-size: 0.72rem;">
                    <i class="fas fa-arrow-up"></i> +8% dari periode lalu
                </div>
            </div>
        </div>

        <!-- Card 4: Tiket Terlambat -->
        <div class="col-xl col-md-4 col-sm-6 col-12">
            <div class="card-stat card-stat-red" style="min-height: 120px;">
                <div>
                    <div class="stat-label" style="font-size: 0.85rem;">Tiket Terlambat</div>
                    <div class="stat-value" style="font-size: 1.8rem;"><?= $ticketTerlambat ?></div>
                </div>
                <div class="stat-meta" style="font-size: 0.72rem;">
                    <i class="fas fa-arrow-up"></i> +8% dari periode lalu
                </div>
            </div>
        </div>

        <!-- Card 5: Rata-rata Waktu Selesai -->
        <div class="col-xl col-md-4 col-sm-6 col-12">
            <div class="card-stat card-stat-blue" style="min-height: 120px; background: linear-gradient(135deg, #1e293b 0%, #334155 100%) !important;">
                <div>
                    <div class="stat-label" style="font-size: 0.85rem;">Rata-rata Waktu Selesai</div>
                    <div class="stat-value" style="font-size: 1.8rem;"><?= $avgSelesai ?></div>
                </div>
                <div class="stat-meta" style="font-size: 0.72rem;">
                    <i class="fas fa-arrow-down"></i> -0.5 hari dari periode lalu
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 1 -->
    <div class="row mt-2">
        <!-- Line Chart -->
        <div class="col-lg-8 col-12">
            <div class="card card-premium">
                <div class="card-header">
                    <h5>Tren Tiket per Hari</h5>
                </div>
                <div class="card-body">
                    <div style="height: 280px; position: relative;">
                        <canvas id="dailyTicketsTrendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donut Chart -->
        <div class="col-lg-4 col-12">
            <div class="card card-premium">
                <div class="card-header">
                    <h5>Tiket per Kategori Layanan</h5>
                </div>
                <div class="card-body">
                    <div style="height: 280px; position: relative;" class="d-flex align-items-center justify-content-center">
                        <canvas id="categoryDonutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Statistics Row 2 -->
    <div class="row mt-2">
        <!-- Top 5 Services Progress bars -->
        <div class="col-lg-8 col-12">
            <div class="card card-premium">
                <div class="card-header">
                    <h5>Top 5 Layanan Terbanyak</h5>
                </div>
                <div class="card-body">
                    <?php 
                    $colors = ['#1e2f99', '#f7921d', '#0093ad', '#0f766e', '#64748b'];
                    foreach ($topServices as $index => $svc): 
                        $color = $colors[$index] ?? '#64748b';
                    ?>
                    <div class="mb-4">
                        <div class="progress-label-container">
                            <span style="font-weight: 600; color: #1e293b;"><?= esc($svc['name']) ?></span>
                            <span style="font-weight: 700; color: #1e2f99;"><?= esc($svc['count']) ?> Tiket</span>
                        </div>
                        <div class="progress progress-modern">
                            <div class="progress-bar" role="progressbar" style="width: <?= $svc['percentage'] ?>%; background-color: <?= $color ?>;" aria-valuenow="<?= $svc['percentage'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Vertical SLA performance bars -->
        <div class="col-lg-4 col-12">
            <div class="card card-premium">
                <div class="card-header">
                    <h5>Performa Unit (SLA Tercapai)</h5>
                </div>
                <div class="card-body">
                    <div style="height: 310px; position: relative;">
                        <canvas id="unitPerformanceBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Libraries -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- SheetJS for Excel export -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<!-- html2pdf for PDF export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Daily Tickets trend (Double Line Chart)
    const lineCtx = document.getElementById('dailyTicketsTrendChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['01 Mei', '02 Mei', '03 Mei', '04 Mei', '05 Mei', '06 Mei', '07 Mei'],
            datasets: [
                {
                    label: 'Tiket Masuk',
                    data: [130, 160, 200, 180, 240, 220, 250],
                    borderColor: '#1e2f99',
                    borderWidth: 2.5,
                    backgroundColor: 'transparent',
                    tension: 0.35,
                    pointBackgroundColor: '#1e2f99',
                    pointBorderColor: '#fff',
                    pointRadius: 4
                },
                {
                    label: 'Tiket Selesai',
                    data: [100, 120, 150, 130, 210, 190, 215],
                    borderColor: '#f7921d',
                    borderWidth: 2.5,
                    backgroundColor: 'transparent',
                    tension: 0.35,
                    pointBackgroundColor: '#f7921d',
                    pointBorderColor: '#fff',
                    pointRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 12,
                        font: { family: 'Inter', size: 11, weight: 500 },
                        color: '#64748b'
                    }
                }
            },
            scales: {
                y: {
                    grid: { color: 'rgba(226, 232, 240, 0.6)' },
                    ticks: { color: '#64748b', font: { family: 'Inter', size: 10 } },
                    border: { dash: [5, 5] }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#64748b', font: { family: 'Inter', size: 10 } }
                }
            }
        }
    });

    // 2. Kategori Layanan (Donut Chart)
    const donutCtx = document.getElementById('categoryDonutChart').getContext('2d');
    new Chart(donutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Akademik', 'Kemahasiswaan', 'Keuangan', 'Umum', 'Lainnya'],
            datasets: [{
                data: [35, 25, 20, 10, 10],
                backgroundColor: ['#1e2f99', '#f7921d', '#0093ad', '#0f766e', '#64748b'],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 10,
                        font: { family: 'Inter', size: 10, weight: 500 },
                        color: '#475569'
                    }
                }
            }
        }
    });

    // 3. Unit Performance Bar Chart
    const barCtx = document.getElementById('unitPerformanceBarChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Akad', 'Mhs', 'Keu', 'Umum', 'Lain'],
            datasets: [{
                label: 'SLA Tercapai (%)',
                data: [95, 92, 90, 88, 85],
                backgroundColor: ['#1e2f99', '#f7921d', '#0093ad', '#0f766e', '#64748b'],
                borderRadius: 5,
                barThickness: 24
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    max: 100,
                    min: 50,
                    grid: { color: 'rgba(226, 232, 240, 0.6)' },
                    ticks: { color: '#64748b', font: { family: 'Inter', size: 10 } },
                    border: { dash: [5, 5] }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#64748b', font: { family: 'Inter', size: 10 } }
                }
            }
        }
    });
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {

    // ── Shared Data (PHP → JS) ───────────────────────────────
    var periode    = document.getElementById('periodeFilter').options[document.getElementById('periodeFilter').selectedIndex].text;
    var totalTiket      = <?= (int)$totalTicket ?>;
    var tiketSelesai    = <?= (int)$ticketSelesai ?>;
    var tiketTerlambat  = <?= (int)$ticketTerlambat ?>;
    var slaTercapai     = '<?= esc($slaTercapai) ?>';
    var avgSelesai      = '<?= esc($avgSelesai) ?>';
    var topServices     = <?= json_encode($topServices) ?>;

    var trendLabels = ['01 Mei','02 Mei','03 Mei','04 Mei','05 Mei','06 Mei','07 Mei'];
    var trendMasuk  = [130,160,200,180,240,220,250];
    var trendSelesai= [100,120,150,130,210,190,215];

    // Update periode label when filter changes
    document.getElementById('periodeFilter').addEventListener('change', function() {
        periode = this.options[this.selectedIndex].text;
    });

    // ── Toast helper ─────────────────────────────────────────
    function showToast(msg, color) {
        var d = document.createElement('div');
        d.style.cssText = 'position:fixed;top:20px;right:20px;z-index:9999;min-width:280px;'
            + 'padding:14px 18px;border-radius:10px;color:#fff;font-weight:600;font-size:0.9rem;'
            + 'box-shadow:0 6px 20px rgba(0,0,0,.18);display:flex;align-items:center;gap:10px;background:' + color;
        d.innerHTML = '<i class="fas fa-check-circle" style="font-size:1.1rem"></i><span>' + msg + '</span>';
        document.body.appendChild(d);
        setTimeout(function() { d.style.transition='opacity .4s'; d.style.opacity='0'; setTimeout(function(){d.remove();},400); }, 3500);
    }

    // ── Spinner helper on anchor ──────────────────────────────
    function spinBtn(el, label, fn) {
        var orig = el.innerHTML;
        el.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>' + label;
        el.style.pointerEvents = 'none';
        setTimeout(function() {
            fn();
            el.innerHTML = orig;
            el.style.pointerEvents = '';
        }, 200);
    }

    // ── 1. CSV Download ───────────────────────────────────────
    document.getElementById('exportCsv').addEventListener('click', function(e) {
        e.preventDefault();
        var me = this;
        spinBtn(me, 'Mengunduh CSV...', function() {
            var rows = [
                ['Laporan Kinerja ULT POLBAN'],
                ['Periode: ' + periode],
                [''],
                ['RINGKASAN STATISTIK'],
                ['Indikator','Nilai'],
                ['Total Tiket', totalTiket],
                ['Tiket Selesai', tiketSelesai],
                ['Tiket Terlambat', tiketTerlambat],
                ['SLA Tercapai', slaTercapai],
                ['Rata-rata Waktu Selesai', avgSelesai],
                [''],
                ['TOP 5 LAYANAN TERBANYAK'],
                ['Nama Layanan', 'Jumlah Tiket', 'Persentase (%)']
            ];
            topServices.forEach(function(s) {
                rows.push([s.name, s.count, s.percentage]);
            });
            rows.push(['']);
            rows.push(['TREN TIKET HARIAN']);
            rows.push(['Tanggal', 'Tiket Masuk', 'Tiket Selesai']);
            trendLabels.forEach(function(lbl, i) {
                rows.push([lbl, trendMasuk[i], trendSelesai[i]]);
            });

            var csv = rows.map(function(r) {
                return r.map(function(c) {
                    var s = String(c);
                    return s.indexOf(',') >= 0 || s.indexOf('"') >= 0 ? '"' + s.replace(/"/g,'""') + '"' : s;
                }).join(',');
            }).join('\r\n');

            var bom = '\uFEFF';
            var blob = new Blob([bom + csv], { type: 'text/csv;charset=utf-8;' });
            var url  = URL.createObjectURL(blob);
            var a    = document.createElement('a');
            a.href     = url;
            a.download = 'laporan-ult-' + new Date().toISOString().slice(0,10) + '.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
            showToast('File CSV berhasil diunduh!', 'linear-gradient(135deg,#2563eb,#3b82f6)');
        });
    });

    // ── 2. Excel Download (SheetJS) ───────────────────────────
    document.getElementById('exportExcel').addEventListener('click', function(e) {
        e.preventDefault();
        var me = this;
        spinBtn(me, 'Mengunduh Excel...', function() {
            if (typeof XLSX === 'undefined') {
                alert('Library SheetJS belum dimuat. Coba refresh halaman.');
                return;
            }
            var wb = XLSX.utils.book_new();

            /* Sheet 1: Ringkasan */
            var ws1Data = [
                ['Laporan Kinerja ULT POLBAN'],
                ['Periode', periode],
                [],
                ['Indikator', 'Nilai'],
                ['Total Tiket', totalTiket],
                ['Tiket Selesai', tiketSelesai],
                ['Tiket Terlambat', tiketTerlambat],
                ['SLA Tercapai', slaTercapai],
                ['Rata-rata Waktu Selesai', avgSelesai]
            ];
            var ws1 = XLSX.utils.aoa_to_sheet(ws1Data);
            ws1['!cols'] = [{wch:30},{wch:20}];
            XLSX.utils.book_append_sheet(wb, ws1, 'Ringkasan');

            /* Sheet 2: Top Layanan */
            var ws2Data = [['Nama Layanan','Jumlah Tiket','Persentase (%)']];
            topServices.forEach(function(s) { ws2Data.push([s.name, s.count, s.percentage]); });
            var ws2 = XLSX.utils.aoa_to_sheet(ws2Data);
            ws2['!cols'] = [{wch:35},{wch:15},{wch:15}];
            XLSX.utils.book_append_sheet(wb, ws2, 'Top Layanan');

            /* Sheet 3: Tren Harian */
            var ws3Data = [['Tanggal','Tiket Masuk','Tiket Selesai']];
            trendLabels.forEach(function(lbl,i){ ws3Data.push([lbl, trendMasuk[i], trendSelesai[i]]); });
            var ws3 = XLSX.utils.aoa_to_sheet(ws3Data);
            ws3['!cols'] = [{wch:15},{wch:15},{wch:15}];
            XLSX.utils.book_append_sheet(wb, ws3, 'Tren Harian');

            XLSX.writeFile(wb, 'laporan-ult-' + new Date().toISOString().slice(0,10) + '.xlsx');
            showToast('File Excel berhasil diunduh!', 'linear-gradient(135deg,#16a34a,#22c55e)');
        });
    });

    // ── 3. PDF Download (html2pdf) ────────────────────────────
    document.getElementById('exportPdf').addEventListener('click', function(e) {
        e.preventDefault();
        var me = this;
        me.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Membuat PDF...';
        me.style.pointerEvents = 'none';

        var element = document.querySelector('.container-fluid.py-2');
        var opt = {
            margin:       [10, 10, 10, 10],
            filename:     'laporan-ult-' + new Date().toISOString().slice(0,10) + '.pdf',
            image:        { type: 'jpeg', quality: 0.95 },
            html2canvas:  { scale: 1.5, useCORS: true, logging: false },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'landscape' },
            pagebreak:    { mode: ['avoid-all', 'css'] }
        };

        html2pdf().set(opt).from(element).save().then(function() {
            me.innerHTML = '<i class="fas fa-file-pdf mr-2" style="width:18px"></i> Ekspor PDF';
            me.style.pointerEvents = '';
            showToast('File PDF berhasil diunduh!', 'linear-gradient(135deg,#f7921d,#faa94e)');
        });
    });

});
</script>

<?= $this->endSection() ?>


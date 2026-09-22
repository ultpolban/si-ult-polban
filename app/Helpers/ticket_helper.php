<?php

/*
|--------------------------------------------------------------------------
| Helper Tiket
|--------------------------------------------------------------------------
| Fungsi-fungsi kecil untuk konsistensi tampilan data tiket/pengajuan.
| Dipakai pada view dashboard, daftar tiket, tracking, laporan, statistik.
|--------------------------------------------------------------------------
*/

if (! function_exists('ticket_status_map')) {

    /**
     * Peta status tiket => [label, bootstrap color class]
     */
    function ticket_status_map(): array
    {
        return [
            'draft'       => ['Draft', 'secondary'],
            'submitted'   => ['Diajukan', 'warning'],
            'verification' => ['Verifikasi', 'info'],
            'revision'    => ['Revisi', 'secondary'],
            'processing'  => ['Diproses', 'primary'],
            'completed'   => ['Selesai', 'success'],
            'rejected'    => ['Ditolak', 'danger'],
            'cancelled'   => ['Dibatalkan', 'danger'],
        ];
    }
}

if (! function_exists('ticket_status_badge')) {

    /**
     * HTML badge status tiket.
     */
    function ticket_status_badge(?string $status): string
    {
        $map = ticket_status_map();

        [$label, $color] = $map[$status] ?? [
            ucwords(str_replace('_', ' ', (string) $status)),
            'secondary',
        ];

        return '<span class="badge bg-' . $color . '">' . esc($label) . '</span>';
    }
}

if (! function_exists('ticket_priority_map')) {

    function ticket_priority_map(): array
    {
        return [
            'low'    => ['Rendah', 'secondary'],
            'normal' => ['Normal', 'info'],
            'high'   => ['Tinggi', 'warning'],
            'urgent' => ['Urgent', 'danger'],
        ];
    }
}

if (! function_exists('ticket_priority_badge')) {

    function ticket_priority_badge(?string $priority): string
    {
        $map = ticket_priority_map();

        [$label, $color] = $map[$priority] ?? [
            ucwords(str_replace('_', ' ', (string) $priority)),
            'secondary',
        ];

        return '<span class="badge bg-' . $color . '">' . esc($label) . '</span>';
    }
}

if (! function_exists('ticket_state_color')) {

    /**
     * Warna ikon/angka untuk ringkasan dashboard.
     */
    function ticket_state_color(string $key): string
    {
        $colors = [
            'total'      => 'primary',
            'pending'    => 'warning',
            'processing' => 'info',
            'completed'  => 'success',
            'rejected'   => 'danger',
        ];

        return $colors[$key] ?? 'secondary';
    }
}

if (! function_exists('ticket_state_label')) {

    function ticket_state_label(string $key): string
    {
        $labels = [
            'total'      => 'Total Pengajuan',
            'pending'    => 'Menunggu',
            'processing' => 'Diproses',
            'completed'  => 'Selesai',
            'rejected'   => 'Ditolak',
        ];

        return $labels[$key] ?? ucfirst($key);
    }
}
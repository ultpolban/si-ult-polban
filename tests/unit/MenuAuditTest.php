<?php

use CodeIgniter\Test\CIUnitTestCase;

/**
 * Audit menu lintas role.
 *
 * Memastikan SETIAP item menu pada SEMUA role & jenis pemohon
 * menunjuk ke route yang benar-benar ada, sehingga tidak ada
 * menu yang ProduN 404 / halaman error.
 *
 * Jalankan:
 *   php vendor/phpunit/phpunit/phpunit tests/unit/MenuAuditTest.php --no-coverage
 */
final class MenuAuditTest extends CIUnitTestCase
{
    /**
     * @var list<string>
     */
    private array $bad = [];

    private int $total = 0;

    protected function setUp(): void
    {
        parent::setUp();

        helper('role');
    }

    protected function tearDown(): void
    {
        session()->destroy();

        parent::tearDown();
    }

    public function testEveryMenuItemTargetsAnExistingRoute(): void
    {
        $contexts = [
            ['SUPER_ADMIN', null],
            ['ADMIN_ULT', null],
            ['PETUGAS_ULT', null],
            ['PIMPINAN', null],
            ['UNIT_TUJUAN', null],
            ['PETUGAS_AKADEMIK', null],
            ['PETUGAS_KEUANGAN', null],
            ['PETUGAS_KEMAHASISWAAN', null],
            ['PETUGAS_PERPUSTAKAAN', null],
            ['PETUGAS_JURUSAN', null],
            ['PETUGAS_TIK', null],
            ['PETUGAS_UMUM', null],
            ['PEMOHON', 'MHS'],
            ['PEMOHON', 'DOSEN'],
            ['PEMOHON', 'TENDIK'],
            ['PEMOHON', 'ALUMNI'],
            ['PEMOHON', 'MITRA'],
            ['PEMOHON', 'WALI'],
            ['PEMOHON', 'UMUM'],
        ];

        $report = [];

        foreach ($contexts as [$role, $applicant]) {
            $session = ['role_code' => $role];

            if ($applicant !== null) {
                $session['applicant_type_code'] = $applicant;
            }

            session()->set($session);

            $label = $role . ($applicant !== null ? " ({$applicant})" : '');

            $report[] = '';
            $report[] = "[{$label}]";

            foreach (ult_menu($role, $applicant) as $group) {
                $report[] = '  -- ' . $group['label'];

                foreach ($group['items'] ?? [] as $item) {
                    $this->total++;

                    $url = (string) ($item['url'] ?? '');
                    $ok  = ult_menu_url_exists($url);

                    if (! $ok) {
                        $this->bad[] = "{$label} -> {$url}";
                    }

                    $report[] = sprintf(
                        '     %s %-46s %s',
                        $ok ? 'v' : 'x',
                        $url,
                        (string) ($item['label'] ?? '')
                    );
                }
            }
        }

        $report[] = '';
        $report[] = sprintf(
            'TOTAL ITEM MENU: %d | TANPA ROUTE: %d',
            $this->total,
            count($this->bad)
        );

        foreach ($this->bad as $entry) {
            $report[] = '  ! ' . $entry;
        }

        fwrite(STDERR, PHP_EOL . implode(PHP_EOL, $report) . PHP_EOL);

        $this->assertSame(
            [],
            $this->bad,
            'Ada item menu yang tidak memiliki route valid.'
        );
    }

    public function testEveryRoleDashboardRouteExists(): void
    {
        foreach (ult_roles() as $role) {
            $dashboard = ult_role_dashboard($role);

            $this->assertTrue(
                ult_menu_url_exists($dashboard),
                "Dashboard {$role} -> {$dashboard} tidak punya route."
            );
        }
    }
}

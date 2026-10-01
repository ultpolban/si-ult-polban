<?php

use CodeIgniter\Test\CIUnitTestCase;

/**
 * Menguji pemetaan role -> dashboard dan definisi menu per role
 * pada helper `ult_role_dashboard()` / `ult_menu()`.
 */
final class RoleMenuRoutingTest extends CIUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        helper(['role']);
    }

    protected function tearDown(): void
    {
        session()->destroy();

        parent::tearDown();
    }

    public static function roleDashboardProvider(): array
    {
        return [
            ['SUPER_ADMIN', 'admin/dashboard'],
            ['ADMIN_ULT',   'admin/dashboard'],
            ['PETUGAS_ULT', 'petugas/dashboard'],
            ['PIMPINAN',    'pimpinan/dashboard'],
            ['UNIT_TUJUAN', 'unit/dashboard'],
        ];
    }

    /**
     * @dataProvider roleDashboardProvider
     */
    public function testRoleHasItsOwnDashboard(string $role, string $expected): void
    {
        $this->assertSame($expected, ult_role_dashboard($role));
    }

    public static function applicantDashboardProvider(): array
    {
        return [
            ['MHS',    'mahasiswa/dashboard'],
            ['DOSEN',  'dosen/dashboard'],
            ['TENDIK', 'tendik/dashboard'],
            ['ALUMNI', 'alumni/dashboard'],
            ['MITRA',  'mitra/dashboard'],
            ['WALI',   'orangtua/dashboard'],
            ['UMUM',   'umum/dashboard'],
        ];
    }

    /**
     * @dataProvider applicantDashboardProvider
     */
    public function testPemohonHasDashboardByApplicantType(
        string $applicant,
        string $expected
    ): void {
        $this->assertSame($expected, ult_applicant_dashboard($applicant));
    }

    public function testPemohonRoleUsesApplicantTypeDashboard(): void
    {
        session()->set([
            'role_code'           => 'PEMOHON',
            'applicant_type_code' => 'MHS',
        ]);

        $this->assertSame('mahasiswa/dashboard', ult_role_dashboard('PEMOHON'));
    }

    public function testAdminMenuContainsOnlyAdminSections(): void
    {
        $menu = ult_menu('SUPER_ADMIN');

        $this->assertNotEmpty($menu);
        $this->assertSame('admin', ult_role_group('SUPER_ADMIN'));

        foreach ($menu as $group) {
            foreach ($group['items'] as $item) {
                $this->assertNotSame(
                    'petugas/tiket',
                    $item['url'],
                    'Menu admin tidak boleh memuat menu petugas.'
                );
            }
        }
    }

    public function testPetugasMenuTargetsPetugasPages(): void
    {
        $urls = $this->menuUrls(ult_menu('PETUGAS_ULT'));

        $this->assertContains('petugas/dashboard', $urls);
        $this->assertContains('petugas/verifikasi', $urls);
        $this->assertNotContains('admin/dashboard', $urls);
        $this->assertNotContains('master/services', $urls);
    }

    public function testPemohonMenuOnlyContainsOwnApplicantPrefix(): void
    {
        session()->set([
            'role_code'           => 'PEMOHON',
            'applicant_type_code' => 'DOSEN',
        ]);

        $urls = $this->menuUrls(ult_menu());

        $this->assertContains('dosen/dashboard', $urls);
        $this->assertContains('dosen/ticket/create', $urls);
        $this->assertNotContains('mahasiswa/dashboard', $urls);
        $this->assertNotContains('admin/dashboard', $urls);
    }

    public function testUnitMenuDoesNotLinkToMissingUnitPages(): void
    {
        $urls = $this->menuUrls(ult_menu('UNIT_TUJUAN'));

        // Prefix "unit" tidak menyediakan halaman statistik/profil
        // (profil memakai halaman global "profile").
        $this->assertNotContains('unit/statistik', $urls);
        $this->assertNotContains('unit/profile', $urls);

        // Log aktivitas unit kini tersedia (UnitController::logAktivitas
        // + route unit/log-aktivitas).
        $this->assertContains('unit/log-aktivitas', $urls);

        $this->assertContains('unit/dashboard', $urls);
        $this->assertContains('unit/laporan', $urls);
    }

    /**
     * @return list<string>
     */
    private function menuUrls(array $menu): array
    {
        $urls = [];

        foreach ($menu as $group) {
            foreach ($group['items'] ?? [] as $item) {
                $urls[] = (string) ($item['url'] ?? '');
            }
        }

        return $urls;
    }
}
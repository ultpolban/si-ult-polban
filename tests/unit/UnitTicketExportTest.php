<?php

use App\Controllers\UnitController;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;

/**
 * Regresi untuk fitur export pada menu "Data Tiket" unit tujuan
 * (route `unit/tiket`).
 *
 * Memastikan:
 *  1. Ketiga route export benar-benar terdaftar (tidak 404).
 *  2. Halaman Data Tiket menautkan ketiga opsi export.
 *  3. exportCsv(), exportExcel(), dan exportPdf() mengembalikan
 *     unduhan yang valid dengan tipe konten yang benar.
 */
final class UnitTicketExportTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    /**
     * Konfigurasi group `tests` asli, disimpan agar bisa dikembalikan.
     *
     * @var array<string, mixed>|null
     */
    private ?array $originalTestsGroup = null;

    protected function setUp(): void
    {
        parent::setUp();

        helper('role');

        // Pada ENVIRONMENT=testing CodeIgniter memakai group `tests`
        // (SQLite3 :memory:), sedangkan ekstensi sqlite3 tidak tersedia
        // pada environment ini. Arahkan group `tests` ke konfigurasi
        // MySQL yang dipakai aplikasi supaya controller benar-benar
        // dapat dieksekusi. Hanya berlaku selama test ini berjalan.
        $dbConfig = config(\Config\Database::class);

        if (($dbConfig->tests['DBDriver'] ?? null) !== 'MySQLi') {
            $this->originalTestsGroup = $dbConfig->tests;
            $dbConfig->tests          = $dbConfig->default;
        }
    }

    protected function tearDown(): void
    {
        if ($this->originalTestsGroup !== null) {
            config(\Config\Database::class)->tests = $this->originalTestsGroup;

            $this->originalTestsGroup = null;
        }

        session()->destroy();

        parent::tearDown();
    }

    public static function exportRouteProvider(): array
    {
        return [
            'csv'   => ['unit/tiket/export/csv'],
            'excel' => ['unit/tiket/export/excel'],
            'pdf'   => ['unit/tiket/export/pdf'],
        ];
    }

    /**
     * @dataProvider exportRouteProvider
     */
    public function testExportRouteIsRegistered(string $route): void
    {
        $this->assertTrue(
            ult_menu_url_exists($route),
            "Route {$route} harus terdaftar agar tombol export tidak menghasilkan 404."
        );
    }

    public function testDataTiketViewLinksEveryExportOption(): void
    {
        session()->set([
            'role_code' => 'UNIT_TUJUAN',
            'role_name' => 'Unit Tujuan',
            'full_name' => 'Unit Tujuan',
            'name'      => 'Unit Tujuan',
            'isLoggedIn' => true,
            'logged_in'  => true,
        ]);

        $html = view('unit/index', ['tickets' => []]);

        foreach (['csv', 'excel', 'pdf'] as $format) {
            $route = 'unit/tiket/export/' . $format;

            $this->assertStringContainsString(
                base_url($route),
                $html,
                "Halaman Data Tiket harus menautkan {$route}."
            );
        }
    }

    public function testCsvExportProducesAttachmentWithHeaderRow(): void
    {
        $response = $this->controller(UnitController::class)
            ->execute('exportCsv');

        $http = $response->response();

        $this->assertStringContainsString(
            'text/csv',
            $http->getHeaderLine('Content-Type'),
            'Export CSV harus bertipe text/csv.'
        );

        $this->assertStringContainsString(
            'attachment',
            $http->getHeaderLine('Content-Disposition'),
            'Export CSV harus berupa file unduhan.'
        );

        $body = (string) $http->getBody();

        $this->assertStringContainsString(
            'No Tiket',
            $body,
            'Baris judul kolom export tidak ditemukan pada CSV.'
        );

        $this->assertStringContainsString(
            'Tanggal Pengajuan',
            $body,
            'Baris judul kolom export tidak ditemukan pada CSV.'
        );
    }

    public function testExcelExportProducesXlsxDownload(): void
    {
        $response = $this->controller(UnitController::class)
            ->execute('exportExcel');

        $http = $response->response();

        $this->assertStringContainsString(
            'spreadsheetml',
            $http->getHeaderLine('Content-Type'),
            'Export Excel harus bertipe .xlsx.'
        );

        $this->assertStringContainsString(
            'attachment',
            $http->getHeaderLine('Content-Disposition'),
            'Export Excel harus berupa file unduhan.'
        );

        // Berkas .xlsx pada dasarnya berupa arsip ZIP ("PK").
        $this->assertSame(
            'PK',
            substr((string) $http->getBody(), 0, 2),
            'Isi export Excel bukan berkas .xlsx yang valid.'
        );
    }

    public function testPdfExportProducesPdfDownload(): void
    {
        $response = $this->controller(UnitController::class)
            ->execute('exportPdf');

        $http = $response->response();

        $this->assertStringContainsString(
            'application/pdf',
            $http->getHeaderLine('Content-Type'),
            'Export PDF harus bertipe application/pdf.'
        );

        $this->assertStringContainsString(
            'attachment',
            $http->getHeaderLine('Content-Disposition'),
            'Export PDF harus berupa file unduhan.'
        );

        $this->assertSame(
            '%PDF',
            substr((string) $http->getBody(), 0, 4),
            'Isi export PDF bukan berkas PDF yang valid.'
        );
    }
}

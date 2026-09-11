<?php

use App\Controllers\Auth\AuthController;
use App\Controllers\DashboardController;
use CodeIgniter\Test\CIUnitTestCase;

final class UnitLoginRoutingTest extends CIUnitTestCase
{
    public static function unitDashboardProvider(): array
    {
        return [
            ['PETUGAS_AKADEMIK', '/akademik/dashboard'],
            ['PETUGAS_KEUANGAN', '/keuangan/dashboard'],
            ['PETUGAS_KEMAHASISWAAN', '/kemahasiswaan/dashboard'],
            ['PETUGAS_PERPUSTAKAAN', '/perpustakaan/dashboard'],
            ['PETUGAS_JURUSAN', '/jurusan/dashboard'],
        ];
    }

    /**
     * @dataProvider unitDashboardProvider
     */
    public function testEachUnitRoleHasItsOwnLoginRedirect(
        string $role,
        string $dashboard
    ): void {
        $controller = new AuthController();
        $method = new ReflectionMethod($controller, 'redirectByRole');
        $method->setAccessible(true);

        $response = $method->invoke($controller, $role);

        $this->assertSame(302, $response->getStatusCode());
        $this->assertSame(site_url(ltrim($dashboard, '/')), $response->getHeaderLine('Location'));
    }

    /**
     * @dataProvider unitDashboardProvider
     */
    public function testDashboardControllerUsesTheSameUnitMapping(
        string $role,
        string $dashboard
    ): void {
        session()->set([
            'isLoggedIn' => true,
            'role_code' => $role,
        ]);

        $response = (new DashboardController())->index();

        $this->assertSame(302, $response->getStatusCode());
        $this->assertSame(base_url(ltrim($dashboard, '/')), $response->getHeaderLine('Location'));

        session()->destroy();
    }
}
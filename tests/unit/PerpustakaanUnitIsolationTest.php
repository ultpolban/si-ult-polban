<?php

use CodeIgniter\Test\CIUnitTestCase;

final class PerpustakaanUnitIsolationTest extends CIUnitTestCase
{
    public function testPerpustakaanControllerExistsAndIsIsolated(): void
    {
        $this->assertTrue(class_exists('App\\Controllers\\Perpustakaan'));

        $reflection = new ReflectionClass('App\\Controllers\\Perpustakaan');
        $this->assertTrue($reflection->hasMethod('queryTiket'));
    }
}

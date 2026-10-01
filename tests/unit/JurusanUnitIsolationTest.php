<?php

use CodeIgniter\Test\CIUnitTestCase;

final class JurusanUnitIsolationTest extends CIUnitTestCase
{
    public function testJurusanControllerExistsAndIsIsolated(): void
    {
        $this->assertTrue(class_exists('App\\Controllers\\Jurusan'));

        $reflection = new ReflectionClass('App\\Controllers\\Jurusan');
        $this->assertTrue($reflection->hasMethod('queryTiket'));
    }
}

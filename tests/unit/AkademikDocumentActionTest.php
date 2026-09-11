<?php

namespace Tests\Unit;

use App\Controllers\Akademik;
use App\Models\DokumenHasilModel;
use PHPUnit\Framework\TestCase;

final class AkademikDocumentActionTest extends TestCase
{
    public function testControllerExposesDocumentViewAndDownloadMethods(): void
    {
        $reflection = new \ReflectionClass(Akademik::class);

        $this->assertTrue($reflection->hasMethod('lihatDokumenLog'));
        $this->assertTrue($reflection->hasMethod('downloadDokumenLog'));
    }

    public function testDokumenHasilModelStoresUploadedFileMetadata(): void
    {
        $reflection = new \ReflectionClass(DokumenHasilModel::class);
        $allowedFields = $reflection->getDefaultProperties()['allowedFields'] ?? [];

        $this->assertContains('penanganan_id', $allowedFields);
        $this->assertContains('nama_file', $allowedFields);
        $this->assertContains('nama_asli', $allowedFields);
        $this->assertContains('ukuran_file', $allowedFields);
        $this->assertContains('tipe_file', $allowedFields);
    }

    public function testResolveFileFromStoredNameUsesPublicUploadFolder(): void
    {
        $fileName = 'unit_test_' . uniqid('', true) . '.pdf';
        $filePath = FCPATH . 'uploads/hasil/' . $fileName;

        file_put_contents($filePath, 'unit test content');

        try {
            $controller = new class extends Akademik {
                public function ticketsById(int $id): ?array
                {
                    return ['id' => $id];
                }
            };

            $method = new \ReflectionMethod(Akademik::class, 'resolveFileFromStoredName');
            $method->setAccessible(true);

            $this->assertSame($filePath, $method->invoke($controller, $fileName, 42));
        } finally {
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }
    }
}

<?php

use CodeIgniter\Test\CIUnitTestCase;

final class UnitTicketDetailViewTest extends CIUnitTestCase
{
    protected function tearDown(): void
    {
        session()->destroy();

        parent::tearDown();
    }

    public function testDetailViewDisplaysRequestDescriptionAndStoredAttachmentPath(): void
    {
        session()->set([
            'role_code'  => 'UNIT_TUJUAN',
            'role_name'  => 'Unit Tujuan',
            'full_name'  => 'Petugas Unit',
            'name'       => 'Petugas Unit',
            'isLoggedIn' => true,
            'logged_in'  => true,
        ]);

        $html = view('unit/detail', [
            'ticket' => [
                'id'            => 42,
                'ticket_number' => 'TKT-202610-00042',
                'service_name'  => 'Layanan Uji',
                'unit_name'     => 'Unit Tujuan',
                'description'   => "Baris pertama\nBaris kedua",
                'priority'      => 'normal',
                'status'        => 'assigned',
            ],
            'attachments' => [
                [
                    'original_name'    => 'dokumen.pdf',
                    'file_name'        => 'random-name.pdf',
                    'file_path'        => 'uploads/service_requests/42/random-name.pdf',
                    'requirement_name' => 'Dokumen Pendukung',
                ],
            ],
            'logs' => [],
        ]);

        $this->assertStringContainsString('Deskripsi Permohonan', $html);
        $this->assertStringContainsString('Baris pertama', $html);
        $this->assertStringContainsString('Baris kedua', $html);
        $this->assertStringContainsString('dokumen.pdf', $html);
        $this->assertStringContainsString('Dokumen Pendukung', $html);
        $this->assertStringContainsString(
            base_url('uploads/service_requests/42/random-name.pdf'),
            $html
        );
    }

    public function testDashboardShowsDetailAndKeepsUpdateStatusAction(): void
    {
        session()->set([
            'role_code'  => 'UNIT_TUJUAN',
            'role_name'  => 'Unit Tujuan',
            'full_name'  => 'Petugas Unit',
            'name'       => 'Petugas Unit',
            'isLoggedIn' => true,
            'logged_in'  => true,
        ]);

        $html = view('unit/dashboard', [
            'tickets' => [
                [
                    'id'                   => 42,
                    'ticket_number'        => 'TKT-202610-00042',
                    'applicant_name'       => 'Pemohon Uji',
                    'service_display_name' => 'Layanan Uji',
                    'status'               => 'assigned',
                ],
            ],
            'summary' => [
                'total'      => 1,
                'assigned'   => 1,
                'processing' => 0,
            ],
        ]);

        $this->assertStringContainsString(
            base_url('unit/detail/42'),
            $html
        );
        $this->assertStringContainsString('> Detail', $html);
        $this->assertStringContainsString(
            base_url('unit/update-status/42'),
            $html
        );
        $this->assertStringContainsString('> Update Status', $html);
    }
}

<?php

use App\Models\TicketModel;
use CodeIgniter\Test\CIUnitTestCase;

final class TicketApplicantDataTest extends CIUnitTestCase
{
    protected function tearDown(): void
    {
        session()->destroy();

        parent::tearDown();
    }

    public function testTicketQueryUsesTheProfileOwnerForApplicantIdentityAndPhone(): void
    {
        $sql = (new TicketModel())
            ->getComplete()
            ->builder()
            ->getCompiledSelect();
        $sql = strtolower(str_replace(['`', ' ', "\n", "\r", "\t"], '', $sql));

        $this->assertStringContainsString(
            'applicant_users.id=user_profiles.user_id',
            $sql
        );
        $this->assertStringContainsString(
            'users.id=tickets.assigned_to',
            $sql
        );
        $this->assertStringContainsString('applicant_users.identity_number', $sql);
        $this->assertStringContainsString('applicant_users.phone_number', $sql);
        $this->assertStringContainsString(
            "coalesce(nullif(trim(user_profiles.nim),''),nullif(trim(user_profiles.nik),''),nullif(trim(applicant_users.identity_number),''))asapplicant_identifier",
            $sql
        );
        $this->assertStringContainsString(
            "coalesce(nullif(trim(user_profiles.phone),''),nullif(trim(applicant_users.phone_number),''))asphone",
            $sql
        );
        $this->assertStringContainsString('user_profiles.nim', $sql);
        $this->assertStringContainsString('user_profiles.nik', $sql);
        $this->assertStringContainsString('user_profiles.phone', $sql);
    }

    public function testTrackingDetailDisplaysApplicantIdentityAndPhone(): void
    {
        session()->set([
            'role_code'  => 'PEMOHON',
            'isLoggedIn' => true,
        ]);

        $html = view('tracking/detail', [
            'ticket' => [
                'ticket_number'        => 'TKT-202610-00042',
                'status'               => 'assigned',
                'progress_step'        => 3,
                'applicant_name'       => 'Pemohon Pengujian',
                'applicant_identifier' => 'NIM-20260042',
                'applicant_phone'      => '081234567890',
                'service_name'         => 'Layanan Uji',
                'service_unit_name'    => 'Unit Tujuan',
            ],
            'logs' => [],
        ]);

        $this->assertStringContainsString('Identitas', $html);
        $this->assertStringContainsString('NIM-20260042', $html);
        $this->assertStringContainsString('081234567890', $html);
    }

    public function testTrackingDetailUsesDashWhenApplicantIdentityAndPhoneAreMissing(): void
    {
        session()->set([
            'role_code'  => 'PEMOHON',
            'isLoggedIn' => true,
        ]);

        $html = view('tracking/detail', [
            'ticket' => [
                'ticket_number' => 'TKT-202610-00043',
                'status'        => 'submitted',
            ],
            'logs' => [],
        ]);

        $this->assertMatchesRegularExpression('/Identitas\s*<\/div>/', $html);
        $this->assertMatchesRegularExpression('/Nomor HP\s*<\/div>/', $html);
        $this->assertMatchesRegularExpression(
            '/Identitas\s*<\/div>\s*<div class="info-value">\s*-\s*<\/div>/',
            $html
        );
        $this->assertMatchesRegularExpression(
            '/Nomor HP\s*<\/div>\s*<div class="info-value">\s*-\s*<\/div>/',
            $html
        );
    }
}

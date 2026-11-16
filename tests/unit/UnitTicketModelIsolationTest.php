<?php

use App\Models\PerpustakaanTicketModel;
use App\Models\UptTikTicketModel;
use CodeIgniter\Test\CIUnitTestCase;

final class UnitTicketModelIsolationTest extends CIUnitTestCase
{
    private string $originalPrefix = '';

    protected function setUp(): void
    {
        parent::setUp();

        $db = db_connect('tests');
        $this->originalPrefix = $db->getPrefix();
        $db->setPrefix('');
        foreach ([
            'tickets',
            'master_services',
            'master_service_categories',
            'master_service_units',
            'user_profiles',
            'users',
        ] as $table) {
            $db->query('DROP TABLE IF EXISTS ' . $table);
        }

        $db->query(
            'CREATE TABLE master_service_units (
                id INTEGER PRIMARY KEY,
                code VARCHAR(20) NOT NULL,
                name VARCHAR(150) NOT NULL
            )'
        );
        $db->query(
            'CREATE TABLE master_services (
                id INTEGER PRIMARY KEY,
                service_unit_id INTEGER,
                service_category_id INTEGER,
                name VARCHAR(200)
            )'
        );
        $db->query(
            'CREATE TABLE master_service_categories (
                id INTEGER PRIMARY KEY,
                name VARCHAR(150)
            )'
        );
        $db->query(
            'CREATE TABLE user_profiles (
                id INTEGER PRIMARY KEY,
                user_id INTEGER,
                name VARCHAR(150),
                nim VARCHAR(30),
                nik VARCHAR(30),
                phone VARCHAR(30)
            )'
        );
        $db->query(
            'CREATE TABLE users (
                id INTEGER PRIMARY KEY,
                full_name VARCHAR(150),
                identity_number VARCHAR(50),
                phone_number VARCHAR(30)
            )'
        );
        $db->query(
            'CREATE TABLE tickets (
                id INTEGER PRIMARY KEY,
                ticket_number VARCHAR(30),
                user_profile_id INTEGER,
                service_id INTEGER,
                unit_id INTEGER,
                title VARCHAR(200),
                description TEXT,
                status VARCHAR(30),
                deleted_at DATETIME
            )'
        );

        $db->table('master_service_units')->insertBatch([
            ['id' => 5, 'code' => 'PERPUS', 'name' => 'Perpustakaan'],
            ['id' => 7, 'code' => 'UPTIK', 'name' => 'UPT TIK'],
            ['id' => 8, 'code' => 'ADM', 'name' => 'Administrasi Umum'],
        ]);
        $db->table('master_services')->insertBatch([
            ['id' => 10, 'service_unit_id' => 7, 'service_category_id' => null, 'name' => 'Layanan UPTIK'],
            ['id' => 20, 'service_unit_id' => 5, 'service_category_id' => null, 'name' => 'Layanan Perpustakaan'],
        ]);
        $db->table('tickets')->insertBatch([
            ['id' => 1, 'ticket_number' => 'TEST-1', 'user_profile_id' => null, 'service_id' => 10, 'unit_id' => 7, 'title' => 'A', 'description' => '', 'status' => 'completed', 'deleted_at' => null],
            ['id' => 2, 'ticket_number' => 'TEST-2', 'user_profile_id' => null, 'service_id' => 10, 'unit_id' => 7, 'title' => 'B', 'description' => '', 'status' => 'assigned', 'deleted_at' => null],
            ['id' => 3, 'ticket_number' => 'TEST-3', 'user_profile_id' => null, 'service_id' => 20, 'unit_id' => 5, 'title' => 'C', 'description' => '', 'status' => 'completed', 'deleted_at' => null],
            ['id' => 4, 'ticket_number' => 'TEST-4', 'user_profile_id' => null, 'service_id' => 10, 'unit_id' => 5, 'title' => 'D', 'description' => '', 'status' => 'processing', 'deleted_at' => null],
            ['id' => 5, 'ticket_number' => 'TEST-5', 'user_profile_id' => null, 'service_id' => 10, 'unit_id' => 7, 'title' => 'E', 'description' => '', 'status' => 'processing', 'deleted_at' => null],
            ['id' => 6, 'ticket_number' => 'TEST-6', 'user_profile_id' => null, 'service_id' => 10, 'unit_id' => null, 'title' => 'F', 'description' => '', 'status' => 'submitted', 'deleted_at' => null],
        ]);
    }

    protected function tearDown(): void
    {
        $db = db_connect('tests');
        $prefix = $db->getPrefix();
        foreach ([
            'tickets',
            'master_services',
            'master_service_categories',
            'master_service_units',
            'user_profiles',
            'users',
        ] as $table) {
            $db->query('DROP TABLE IF EXISTS ' . $table);
        }
        $db->setPrefix($this->originalPrefix);

        parent::tearDown();
    }

    public function testUnitTicketModelsFilterStatisticsByEffectiveDestination(): void
    {
        $uptTikTickets = (new UptTikTicketModel())->findAll();
        $perpustakaanTickets = (new PerpustakaanTicketModel())->findAll();

        $this->assertSame([6, 5, 2, 1], array_column($uptTikTickets, 'id'));
        $this->assertSame([4, 3], array_column($perpustakaanTickets, 'id'));
        $this->assertSame(
            ['assigned' => 1, 'completed' => 1, 'processing' => 1, 'submitted' => 1],
            $this->statusCounts($uptTikTickets)
        );
        $this->assertSame(
            ['completed' => 1, 'processing' => 1],
            $this->statusCounts($perpustakaanTickets)
        );
        $this->assertSame(
            count($uptTikTickets),
            array_sum($this->statusCounts($uptTikTickets))
        );
        $this->assertSame(
            count($perpustakaanTickets),
            array_sum($this->statusCounts($perpustakaanTickets))
        );
        $this->assertSame(
            25,
            (int) round(
                ($this->statusCounts($uptTikTickets)['completed'] / count($uptTikTickets)) * 100
            )
        );
        $this->assertSame(
            50,
            (int) round(
                ($this->statusCounts($perpustakaanTickets)['completed'] / count($perpustakaanTickets)) * 100
            )
        );
    }

    public function testUnitWithoutTicketsHasZeroCounts(): void
    {
        $tickets = (new \App\Models\AdministrasiUmumTicketModel())->findAll();
        $counts = $this->statusCounts($tickets);
        $total = count($tickets);
        $percentCompleted = $total > 0
            ? (int) round((($counts['completed'] ?? 0) / $total) * 100)
            : 0;

        $this->assertSame([], $tickets);
        $this->assertSame(0, $total);
        $this->assertSame(0, $counts['completed'] ?? 0);
        $this->assertSame(0, $percentCompleted);
    }

    private function statusCounts(array $tickets): array
    {
        $counts = [];

        foreach ($tickets as $ticket) {
            $status = $ticket['status'];
            $counts[$status] = ($counts[$status] ?? 0) + 1;
        }

        ksort($counts);

        return $counts;
    }
}

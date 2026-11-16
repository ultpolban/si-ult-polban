<?php

use App\Libraries\PetugasTicketStatistics;
use CodeIgniter\Test\CIUnitTestCase;

final class PetugasTicketStatisticsTest extends CIUnitTestCase
{
    public function testStatusCountsAndPercentagesUseTheSelectedTickets(): void
    {
        $statistics = new PetugasTicketStatistics();

        $firstGroup = $statistics->calculate([
            ['status' => 'submitted'],
            ['status' => 'completed'],
        ]);
        $secondGroup = $statistics->calculate([
            ['status' => 'assigned'],
            ['status' => 'in_progress'],
            ['status' => 'rejected'],
        ]);

        $this->assertSame(2, $firstGroup['total_tiket']);
        $this->assertSame(1, $firstGroup['completed']);
        $completedIndex = array_search(
            'Completed',
            $firstGroup['status_labels'],
            true
        );
        $this->assertSame(50.0, $firstGroup['status_percentages'][$completedIndex]);
        $this->assertSame(2, array_sum($firstGroup['status_values']));

        $this->assertSame(3, $secondGroup['total_tiket']);
        $this->assertSame(1, $secondGroup['disposisi']);
        $this->assertSame(1, $secondGroup['in_progress']);
        $this->assertSame(0, $secondGroup['completed']);
        $this->assertSame(3, array_sum($secondGroup['status_values']));
    }

    public function testEmptyPeriodReturnsZeroValuesAndPercentages(): void
    {
        $summary = (new PetugasTicketStatistics())->calculate([]);

        $this->assertSame(0, $summary['total_tiket']);
        $this->assertSame(0, array_sum($summary['status_values']));
        $this->assertSame(
            array_fill(0, count($summary['status_labels']), 0.0),
            $summary['status_percentages']
        );
    }

    public function testPeriodFilterUsesSubmittedDateAndSupportsCustomDates(): void
    {
        $statistics = new PetugasTicketStatistics();
        $tickets = [
            [
                'status' => 'submitted',
                'submitted_at' => '2025-03-12 10:00:00',
                'created_at' => '2025-02-01 10:00:00',
            ],
            [
                'status' => 'completed',
                'submitted_at' => '2025-02-28 10:00:00',
                'created_at' => '2025-03-12 10:00:00',
            ],
            [
                'status' => 'rejected',
                'created_at' => '2025-03-20 10:00:00',
            ],
        ];

        $march = $statistics->filterByPeriod(
            $tickets,
            'bulan',
            today: new \DateTimeImmutable('2025-03-15')
        );
        $custom = $statistics->filterByPeriod(
            $tickets,
            'custom',
            '2025-03-10',
            '2025-03-20',
            new \DateTimeImmutable('2025-03-15')
        );

        $this->assertSame(2, count($march));
        $this->assertSame(2, count($custom));
        $this->assertSame(
            ['submitted', 'rejected'],
            array_column($custom, 'status')
        );
    }

    public function testUnfilteredPeriodsRetainTicketsWithoutDates(): void
    {
        $statistics = new PetugasTicketStatistics();
        $tickets = [['status' => 'submitted']];

        $this->assertCount(
            1,
            $statistics->filterByPeriod($tickets, 'semua')
        );
        $this->assertCount(
            1,
            $statistics->filterByPeriod($tickets, 'custom')
        );
        $this->assertCount(
            0,
            $statistics->filterByPeriod(
                $tickets,
                'bulan',
                today: new \DateTimeImmutable('2025-03-15')
            )
        );
    }
}

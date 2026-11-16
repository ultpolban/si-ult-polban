<?php

namespace App\Libraries;

use DateTimeImmutable;

class PetugasTicketStatistics
{
    private const STATUS_LABELS = [
        'Draft',
        'Submitted',
        'Verification',
        'Verified',
        'Disposisi',
        'In Progress',
        'Completed',
        'Need Revision',
        'Rejected',
        'Cancelled',
    ];

    public function filterByPeriod(
        array $tickets,
        string $period,
        ?string $startDate = null,
        ?string $endDate = null,
        ?DateTimeImmutable $today = null
    ): array {
        $today = $today ?? new DateTimeImmutable('today');
        $startOfWeek = $today->modify('monday this week');
        $endOfWeek = $today->modify('sunday this week');

        $filtered = array_filter(
            $tickets,
            static function (array $ticket) use (
                $period,
                $startDate,
                $endDate,
                $today,
                $startOfWeek,
                $endOfWeek
            ): bool {
                if (
                    !in_array(
                        $period,
                        ['hari', 'minggu', 'bulan', 'tahun', 'custom'],
                        true
                    )
                ) {
                    return true;
                }

                if (
                    $period === 'custom'
                    && (empty($startDate) || empty($endDate))
                ) {
                    return true;
                }

                $date = $ticket['submitted_at'] ?? $ticket['created_at'] ?? null;

                if (!$date) {
                    return false;
                }

                $timestamp = strtotime((string) $date);

                if ($timestamp === false) {
                    return false;
                }

                $ticketDate = date('Y-m-d', $timestamp);

                return match ($period) {
                    'hari' => $ticketDate === $today->format('Y-m-d'),
                    'minggu' => $ticketDate >= $startOfWeek->format('Y-m-d')
                        && $ticketDate <= $endOfWeek->format('Y-m-d'),
                    'bulan' => substr($ticketDate, 0, 7) === $today->format('Y-m'),
                    'tahun' => substr($ticketDate, 0, 4) === $today->format('Y'),
                    'custom' => $ticketDate >= $startDate && $ticketDate <= $endDate,
                    default => true,
                };
            }
        );

        return array_values($filtered);
    }

    public function calculate(array $tickets): array
    {
        $counts = array_fill_keys(self::STATUS_LABELS, 0);

        foreach ($tickets as $ticket) {
            $rawStatus = strtolower(trim((string) ($ticket['status'] ?? '')));
            $label = match ($rawStatus) {
                'draft' => 'Draft',
                'submitted' => 'Submitted',
                'verification' => 'Verification',
                'verified' => 'Verified',
                'assigned', 'disposisi' => 'Disposisi',
                'in progress', 'in_progress', 'processing' => 'In Progress',
                'completed', 'complete' => 'Completed',
                'need revision', 'need_revision', 'revision' => 'Need Revision',
                'rejected' => 'Rejected',
                'cancelled', 'canceled' => 'Cancelled',
                default => $rawStatus === ''
                    ? 'Unknown'
                    : ucwords(str_replace(['_', '-'], ' ', $rawStatus)),
            };

            if (!array_key_exists($label, $counts)) {
                $counts[$label] = 0;
            }

            $counts[$label]++;
        }

        $total = count($tickets);
        $labels = array_keys($counts);
        $values = array_values($counts);
        $percentages = array_map(
            static fn (int $count): float => $total > 0
                ? round(($count / $total) * 100, 2)
                : 0.0,
            $values
        );

        return [
            'total_tiket' => $total,
            'status_counts' => $counts,
            'status_labels' => $labels,
            'status_values' => $values,
            'status_percentages' => $percentages,
            'submitted' => $counts['Submitted'],
            'verified' => $counts['Verified'],
            'disposisi' => $counts['Disposisi'],
            'in_progress' => $counts['In Progress'],
            'completed' => $counts['Completed'],
            'need_revision' => $counts['Need Revision'],
            'rejected' => $counts['Rejected'],
            'cancelled' => $counts['Cancelled'],
        ];
    }
}

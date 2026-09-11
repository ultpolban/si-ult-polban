<?php

namespace App\Models;

use CodeIgniter\Model;

class AkademikTicketModel extends Model
{
    protected $table = 'akademik_tickets';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $useTimestamps = false;

    protected $allowedFields = [
        'ticket_number',
        'applicant_name',
        'applicant_identifier',
        'service_name',
        'service_category',
        'unit_name',
        'title',
        'description',
        'status',
        'priority',
        'admin_note',
        'result_note',
        'result_file',
        'submitted_at',
        'processed_at',
        'completed_at',

        // Pengiriman ke ULT
        'sent_to_ult',
        'sent_to_ult_at',

        // Pengiriman hasil ke Pemohon
        'sent_to_applicant',
        'sent_to_applicant_at',
    ];
}

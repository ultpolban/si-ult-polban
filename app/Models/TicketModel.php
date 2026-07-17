<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{

    protected $table = 'tickets';

    protected $primaryKey = 'id';

    protected $allowedFields=[

'ticket_number',

'service_name',

'applicant_name',

'nim',

'study_program',

'status',

'ktm_file',

'krs_file',

'catatan',

'verified_at',

'assigned_at',

'process_at',

'completed_at',

'closed_at'

];

}
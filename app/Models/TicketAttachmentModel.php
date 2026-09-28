<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketAttachmentModel extends Model
{
    protected $table = 'service_request_files';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'ticket_id',
        'service_request_id',
        'request_id',

        'requirement_id',
        'requirement_name',

        'file_name',
        'filename',
        'original_name',
        'original_filename',

        'file_path',
        'filepath',
        'path',
        'file',

        'file_extension',
        'file_size',

        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $useTimestamps = false;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $useSoftDeletes = true;

    protected $deletedField = 'deleted_at';
}
<?php

namespace App\Models;

use CodeIgniter\Model;


class UnitKerjaModel extends Model
{


    protected $table = 'unit_layanan';


    protected $primaryKey = 'id';


    protected $returnType = 'array';



    protected $allowedFields = [

        'nama_unit',

        'deskripsi',

        'status'

    ];


}
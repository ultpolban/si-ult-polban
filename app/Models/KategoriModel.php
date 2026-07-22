<?php

namespace App\Models;

use CodeIgniter\Model;


class KategoriModel extends Model
{


    protected $table = 'kategori_layanan';


    protected $primaryKey = 'id';


    protected $returnType = 'array';



    protected $allowedFields = [

        'unit_id',

        'nama_kategori',

        'deskripsi',

        'status'

    ];


}
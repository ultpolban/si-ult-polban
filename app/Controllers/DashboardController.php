<?php

namespace App\Controllers;


use App\Models\UserModel;
use App\Models\UnitKerjaModel;
use App\Models\KategoriModel;
use App\Models\LayananModel;
use App\Models\PersyaratanModel;



class DashboardController extends BaseController
{

    public function index()
    {


        $role = session()->get('role_id');


        switch ($role) {


            case 1: // Admin


                $userModel = new UserModel();

                $unitModel = new UnitKerjaModel();

                $kategoriModel = new KategoriModel();

                $layananModel = new LayananModel();

                $persyaratanModel = new PersyaratanModel();



                $data = [


                    'totalUser' => 
                    $userModel->countAll(),


                    'jumlah_unit' =>
                    $unitModel->countAll(),


                    'jumlah_kategori' =>
                    $kategoriModel->countAll(),


                    'jumlah_layanan' =>
                    $layananModel->countAll(),


                    'jumlah_persyaratan' =>
                    $persyaratanModel->countAll(),


                ];



                return view(
                    'dashboard/admin',
                    $data
                );




            case 2:

                return view('dashboard/petugas');



            case 3:

                return view('dashboard/unit');



            case 4:

                return view('dashboard/pemohon');



            case 5:

                return view('dashboard/pimpinan');



            default:

                session()->destroy();

                return redirect()->to('/login');

        }


    }


}
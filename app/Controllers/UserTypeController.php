<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserTypeModel;
use App\Models\UserModel;

class UserTypeController extends BaseController
{
    protected UserTypeModel $userTypeModel;
    protected UserModel $userModel;

    public function __construct()
    {
        helper(['form']);

        $this->userTypeModel = new UserTypeModel();
        $this->userModel     = new UserModel();
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $keyword = trim($this->request->getGet('keyword') ?? '');

        $perPage = 10;

        $types = $this->userTypeModel

            ->search($keyword)

            ->paginate($perPage);

        foreach ($types as &$type) {

            // Backend1 menyimpan nama jenis pemohon di kolom `name`,
            // sementara View Frontend4 memakai key `type_name`.
            $type['type_name'] = $type['name'] ?? '';

            $type['total_user'] = $this->userTypeModel
                ->countUser($type['id']);
        }

        $data = [

            'title' => 'Management Jenis Pemohon',

            'types' => $types,

            'pager' => $this->userTypeModel->pager,

            'keyword' => $keyword,

            'totalType' => $this->userTypeModel->countAll()

        ];

        return view('user-types/index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('user-types/create', [

            'title'      => 'Tambah Jenis Pemohon',

            'type'       => [],

            'validation' => \Config\Services::validation()

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        if (
            !$this->validate(
                $this->validationRules(),
                $this->validationMessages()
            )
        ) {

            return redirect()

                ->back()

                ->withInput()

                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }

        $this->userTypeModel->insert([

            'name' => trim(
                $this->request->getPost('name')
            ),

            'description' => trim(
                $this->request->getPost('description')
            )

        ]);

        return redirect()

            ->to(base_url('user-types'))

            ->with(
                'success',
                'Jenis pemohon berhasil ditambahkan.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $type = $this->userTypeModel->find($id);

        if (!$type) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Jenis pemohon tidak ditemukan.'
            );
        }

        return view('user-types/edit', [

            'title'      => 'Edit Jenis Pemohon',

            'type'       => $type,

            'validation' => \Config\Services::validation()

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $type = $this->userTypeModel->find($id);

        if (!$type) {

            return redirect()

                ->to(base_url('user-types'))

                ->with(
                    'error',
                    'Jenis pemohon tidak ditemukan.'
                );
        }

        if (
            !$this->validate(
                $this->validationRules((int) $id),
                $this->validationMessages()
            )
        ) {

            return redirect()

                ->back()

                ->withInput()

                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }

        $this->userTypeModel->update($id, [

            'name' => trim(
                $this->request->getPost('name')
            ),

            'description' => trim(
                $this->request->getPost('description')
            )

        ]);

        return redirect()

            ->to(base_url('user-types'))

            ->with(
                'success',
                'Jenis pemohon berhasil diperbarui.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $type = $this->userTypeModel->find($id);

        if (!$type) {

            return redirect()

                ->to(base_url('user-types'))

                ->with(
                    'error',
                    'Jenis pemohon tidak ditemukan.'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | Cek apakah masih digunakan user
    |--------------------------------------------------------------------------
    */

        $totalUser = $this->userModel

            ->where('user_type_id', $id)

            ->countAllResults();

        if ($totalUser > 0) {

            return redirect()

                ->to(base_url('user-types'))

                ->with(
                    'error',
                    'Jenis pemohon tidak dapat dihapus karena masih digunakan oleh ' . $totalUser . ' user.'
                );
        }

        $this->userTypeModel->delete($id);

        return redirect()

            ->to(base_url('user-types'))

            ->with(
                'success',
                'Jenis pemohon berhasil dihapus.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATION RULES
    |--------------------------------------------------------------------------
    */

    private function validationRules(?int $id = null): array
    {
        $typeRule = 'required|max_length[100]';

        if ($id === null) {

            $typeRule .= '|is_unique[master_applicant_types.name]';
        } else {

            $typeRule .= '|is_unique[master_applicant_types.name,id,' . $id . ']';
        }

        return [

            'name'   => $typeRule,

            'description' => 'permit_empty|max_length[255]'

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATION MESSAGES
    |--------------------------------------------------------------------------
    */

    private function validationMessages(): array
    {
        return [

            'name' => [

                'required'   => 'Nama jenis pemohon wajib diisi.',

                'max_length' => 'Nama jenis pemohon maksimal 100 karakter.',

                'is_unique'  => 'Nama jenis pemohon sudah digunakan.'

            ],

            'description' => [

                'max_length' => 'Deskripsi maksimal 255 karakter.'

            ]

        ];
    }
}

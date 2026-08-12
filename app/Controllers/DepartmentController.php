<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use App\Models\UserModel;

class DepartmentController extends BaseController
{
    protected DepartmentModel $departmentModel;
    protected UserModel $userModel;

    public function __construct()
    {
        helper(['form']);

        $this->departmentModel = new DepartmentModel();
        $this->userModel = new UserModel();
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

        $departments = $this->departmentModel

            ->search($keyword)

            ->paginate($perPage);

        foreach ($departments as &$department) {

            $department['department_name'] = $department['name'] ?? '';

            $department['total_user'] = $this->departmentModel

                ->countUser($department['id']);

            $department['total_prodi'] = $this->departmentModel

                ->countStudyProgram($department['id']);
        }

        return view('departments/index', [

            'title' => 'Management Jurusan',

            'departments' => $departments,

            'pager' => $this->departmentModel->pager,

            'keyword' => $keyword,

            'totalDepartment' => $this->departmentModel->countAll()

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('departments/create', [

            'title' => 'Tambah Jurusan',

            'department' => [],

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

        $this->departmentModel->insert([

            'code' => strtoupper(
                trim($this->request->getPost('code'))
            ),

            'name' => trim(
                $this->request->getPost('name')
            )

        ]);

        return redirect()

            ->to(base_url('departments'))

            ->with(
                'success',
                'Jurusan berhasil ditambahkan.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $department = $this->departmentModel->find($id);

        if (!$department) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Jurusan tidak ditemukan.'
            );
        }

        return view('departments/edit', [

            'title' => 'Edit Jurusan',

            'department' => $department,

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
        $department = $this->departmentModel->find($id);

        if (!$department) {

            return redirect()

                ->to(base_url('departments'))

                ->with(
                    'error',
                    'Jurusan tidak ditemukan.'
                );
        }

        if (
            !$this->validate(
                $this->validationRules((int)$id),
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

        $this->departmentModel->update($id, [

            'code' => strtoupper(
                trim($this->request->getPost('code'))
            ),

            'name' => trim(
                $this->request->getPost('name')
            )
        ]);

        return redirect()

            ->to(base_url('departments'))

            ->with(
                'success',
                'Jurusan berhasil diperbarui.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $department = $this->departmentModel->find($id);

        if (!$department) {

            return redirect()

                ->to(base_url('departments'))

                ->with(
                    'error',
                    'Jurusan tidak ditemukan.'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | Cek User
    |--------------------------------------------------------------------------
    */

        $totalUser = $this->departmentModel->countUser($id);

        if ($totalUser > 0) {

            return redirect()

                ->to(base_url('departments'))

                ->with(
                    'error',
                    'Jurusan tidak dapat dihapus karena masih digunakan oleh ' . $totalUser . ' user.'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | Cek Program Studi
    |--------------------------------------------------------------------------
    */

        $totalProdi = (new \App\Models\StudyProgramModel())

            ->where('department_id', $id)

            ->countAllResults();

        if ($totalProdi > 0) {

            return redirect()

                ->to(base_url('departments'))

                ->with(
                    'error',
                    'Jurusan tidak dapat dihapus karena masih memiliki ' . $totalProdi . ' program studi.'
                );
        }

        $this->departmentModel->delete($id);

        return redirect()

            ->to(base_url('departments'))

            ->with(
                'success',
                'Jurusan berhasil dihapus.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATION
    |--------------------------------------------------------------------------
    */

    private function validationRules(?int $id = null): array
    {
        $codeRule = 'required|max_length[20]';

        if ($id === null) {

            $codeRule .= '|is_unique[master_departments.code]';
        } else {

            $codeRule .= '|is_unique[master_departments.code,id,' . $id . ']';
        }

        return [

            'code' => $codeRule,

            'name' => 'required|max_length[150]'

        ];
    }

    private function validationMessages(): array
    {
        return [

            'code' => [

                'required' => 'Kode jurusan wajib diisi.',

                'is_unique' => 'Kode jurusan sudah digunakan.'

            ],

            'name' => [

                'required' => 'Nama jurusan wajib diisi.'

            ]

        ];
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudyProgramModel;
use App\Models\DepartmentModel;
use App\Models\UserModel;

class StudyProgramController extends BaseController
{
    protected StudyProgramModel $studyProgramModel;
    protected DepartmentModel $departmentModel;
    protected UserModel $userModel;

    public function __construct()
    {
        helper(['form']);

        $this->studyProgramModel = new StudyProgramModel();
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
        $keyword = trim($this->request->getGet('keyword'));

        $perPage = 10;

        $studyPrograms = $this->studyProgramModel
            ->search($keyword)
            ->paginate($perPage);

        foreach ($studyPrograms as &$program) {

            $program['total_user'] = $this->studyProgramModel
                ->countUser($program['id']);
        }

        return view('study-programs/index', [

            'title' => 'Management Program Studi',

            'studyPrograms' => $studyPrograms,

            'departments' => $this->departmentModel
                ->orderBy('department_name')
                ->findAll(),

            'pager' => $this->studyProgramModel->pager,

            'keyword' => $keyword,

            'totalProgram' => $this->studyProgramModel->countAll()

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('study-programs/create', [

            'title' => 'Tambah Program Studi',

            'studyProgram' => [],

            'departments' => $this->departmentModel
                ->orderBy('department_name')
                ->findAll(),

            'validation' => \Config\Services::validation()

        ]);
    }

    private function validationRules(?int $id = null): array
    {
        return [

            'department_id' => 'required',

            'education_level' => 'required',

            'program_name' => 'required|max_length[150]'

        ];
    }

    private function validationMessages(): array
    {
        return [

            'department_id' => [
                'required' => 'Jurusan wajib dipilih.'
            ],

            'education_level' => [
                'required' => 'Jenjang wajib dipilih.'
            ],

            'program_name' => [
                'required' => 'Nama Program Studi wajib diisi.'
            ]

        ];
    }

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
                ->with('errors', $this->validator->getErrors());
        }

        $this->studyProgramModel->insert([

            'department_id' => $this->request->getPost('department_id'),

            'education_level' => $this->request->getPost('education_level'),

            'program_name' => $this->request->getPost('program_name')

        ]);

        return redirect()

            ->to(base_url('study-programs'))

            ->with('success', 'Program Studi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $studyProgram = $this->studyProgramModel->find($id);

        if (!$studyProgram) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Program Studi tidak ditemukan.'
            );
        }

        return view('study-programs/edit', [

            'title' => 'Edit Program Studi',

            'studyProgram' => $studyProgram,

            'departments' => $this->departmentModel
                ->orderBy('department_name', 'ASC')
                ->findAll(),

            'validation' => \Config\Services::validation()

        ]);
    }

    public function update($id)
    {
        $studyProgram = $this->studyProgramModel->find($id);

        if (!$studyProgram) {

            return redirect()

                ->to(base_url('study-programs'))

                ->with('error', 'Program Studi tidak ditemukan.');
        }

        if (
            !$this->validate(
                $this->validationRules($id),
                $this->validationMessages()
            )
        ) {

            return redirect()

                ->back()

                ->withInput()

                ->with('errors', $this->validator->getErrors());
        }

        $this->studyProgramModel->update($id, [

            'department_id'   => $this->request->getPost('department_id'),

            'education_level' => $this->request->getPost('education_level'),

            'program_name'    => trim(
                $this->request->getPost('program_name')
            )

        ]);

        return redirect()

            ->to(base_url('study-programs'))

            ->with(
                'success',
                'Program Studi berhasil diperbarui.'
            );
    }

    public function delete($id)
    {
        $studyProgram = $this->studyProgramModel->find($id);

        if (!$studyProgram) {

            return redirect()

                ->to(base_url('study-programs'))

                ->with('error', 'Program Studi tidak ditemukan.');
        }

        $totalUser = $this->userModel

            ->where('study_program_id', $id)

            ->countAllResults();

        if ($totalUser > 0) {

            return redirect()

                ->to(base_url('study-programs'))

                ->with(
                    'error',
                    'Program Studi masih digunakan oleh ' . $totalUser . ' user.'
                );
        }

        $this->studyProgramModel->delete($id);

        return redirect()

            ->to(base_url('study-programs'))

            ->with(
                'success',
                'Program Studi berhasil dihapus.'
            );
    }

    public function byDepartment($departmentId)
    {
        $studyPrograms = $this->studyProgramModel

            ->where('department_id', $departmentId)

            ->orderBy('education_level', 'ASC')

            ->orderBy('program_name', 'ASC')

            ->findAll();

        return $this->response->setJSON($studyPrograms);
    }
}

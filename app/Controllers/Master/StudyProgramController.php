<?php

namespace App\Controllers\Master;

use App\Controllers\AdminController;
use App\Services\StudyProgramService;
use App\Services\DepartmentService;
use App\Validation\StudyProgramValidator;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class StudyProgramController extends AdminController
{
    /**
     * Services
     */
    protected StudyProgramService $studyProgramService;
    protected DepartmentService $departmentService;

    public function __construct()
    {
        parent::__construct();

        $this->studyProgramService = service('studyProgramService');
        $this->departmentService   = service('departmentService');
    }

    /**
     * List Data
     */
    public function index()
    {
        $this->authorize(Permissions::STUDY_PROGRAM_VIEW);

        $keyword = trim($this->request->getGet('keyword') ?? '');

        $result = $this->studyProgramService->getList($keyword);

        return view('master/study-program/index', $this->viewData([
            'title'         => 'Master Program Studi',
            'pageTitle'     => 'Master Program Studi',
            'studyPrograms' => $result['studyPrograms'],
            'pager'         => $result['pager'],
            'keyword'       => $keyword,
        ]));
    }

    /**
     * Form Tambah
     */
    public function create()
    {
        $this->authorize(Permissions::STUDY_PROGRAM_CREATE);

        return view('master/study-program/create', $this->viewData([
            'title'       => 'Tambah Program Studi',
            'pageTitle'   => 'Tambah Program Studi',
            'departments' => $this->departmentService->getDropdown(),
        ]));
    }

    /**
     * Simpan Data
     */
    public function store()
    {
        $this->authorize(Permissions::STUDY_PROGRAM_CREATE);

        $rules = StudyProgramValidator::store();

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->studyProgramService->create(
            $this->request->getPost()
        );

        return redirect()
            ->to(site_url('master/study-programs'))
            ->with('success', 'Program studi berhasil ditambahkan.');
    }

    /**
     * Detail
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::STUDY_PROGRAM_VIEW);

        $studyProgram = $this->studyProgramService->getById($id);

        if (!$studyProgram) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('master/study-program/show', $this->viewData([
            'title'        => 'Detail Program Studi',
            'pageTitle'    => 'Detail Program Studi',
            'studyProgram' => $studyProgram,
        ]));
    }

    /**
     * Form Edit
     */
    public function edit(int $id)
    {
        $this->authorize(Permissions::STUDY_PROGRAM_UPDATE);

        $studyProgram = $this->studyProgramService->getById($id);

        if (!$studyProgram) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('master/study-program/edit', $this->viewData([
            'title'        => 'Edit Program Studi',
            'pageTitle'    => 'Edit Program Studi',
            'studyProgram' => $studyProgram,
            'departments'  => $this->departmentService->getDropdown(),
        ]));
    }

    /**
     * Update
     */
    public function update(int $id)
    {
        $this->authorize(Permissions::STUDY_PROGRAM_UPDATE);

        $rules = StudyProgramValidator::update($id);

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->studyProgramService->update(
            $id,
            $this->request->getPost()
        );

        return redirect()
            ->to(site_url('master/study-programs'))
            ->with('success', 'Program studi berhasil diubah.');
    }

    /**
     * Hapus
     */
    public function delete(int $id)
    {
        $this->authorize(Permissions::STUDY_PROGRAM_DELETE);

        $this->studyProgramService->delete($id);

        return redirect()
            ->back()
            ->with('success', 'Program studi berhasil dihapus.');
    }

    /**
     * Restore
     */
    public function restore(int $id)
    {
        $this->authorize(Permissions::STUDY_PROGRAM_RESTORE);

        $this->studyProgramService->restore($id);

        return redirect()
            ->back()
            ->with('success', 'Program studi berhasil dikembalikan.');
    }

    /**
     * Ubah Status
     */
    public function changeStatus(int $id)
    {
        $this->authorize(Permissions::STUDY_PROGRAM_UPDATE);

        $status = (bool) $this->request->getPost('is_active');

        $this->studyProgramService->changeStatus(
            $id,
            $status
        );

        return redirect()
            ->back()
            ->with('success', 'Status berhasil diperbarui.');
    }
}

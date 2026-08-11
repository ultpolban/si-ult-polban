<?php

namespace App\Controllers\Master;

use App\Controllers\AdminController;
use App\Services\ClassService;
use App\Services\StudyProgramService;
use App\Validation\ClassValidator;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class ClassController extends AdminController
{
    /**
     * Services
     */
    protected ClassService $classService;
    protected StudyProgramService $studyProgramService;

    public function __construct()
    {
        parent::__construct();

        $this->classService = service('classService');
        $this->studyProgramService = service('studyProgramService');
    }

    /**
     * ==========================================
     * INDEX - List Data
     * ==========================================
     */
    public function index()
    {
        $this->authorize(Permissions::CLASS_VIEW);

        $keyword = trim(
            $this->request->getGet('keyword') ?? ''
        );

        $result = $this->classService->getList($keyword);

        return view(
            'master/class/index',
            $this->viewData([
                'title'      => 'Master Kelas',
                'pageTitle'  => 'Master Kelas',
                'classes'    => $result['classes'],
                'pager'      => $result['pager'],
                'keyword'    => $keyword,
            ])
        );
    }

    /**
     * ==========================================
     * CREATE - Form Tambah
     * ==========================================
     */
    public function create()
    {
        $this->authorize(Permissions::CLASS_CREATE);

        return view(
            'master/class/create',
            $this->viewData([
                'title'         => 'Tambah Kelas',
                'pageTitle'     => 'Tambah Kelas',
                'studyPrograms' => $this->studyProgramService->getDropdown(),
            ])
        );
    }

    /**
     * ==========================================
     * STORE - Simpan Data
     * ==========================================
     */
    public function store()
    {
        $this->authorize(Permissions::CLASS_CREATE);

        if (! $this->validate(ClassValidator::store())) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->classService->create(
            $this->request->getPost()
        );

        return redirect()
            ->to(site_url('master/classes'))
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    /**
     * ==========================================
     * SHOW - Detail
     * ==========================================
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::CLASS_VIEW);

        $class = $this->classService->getById($id);

        if (! $class) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view(
            'master/class/show',
            $this->viewData([
                'title'     => 'Detail Kelas',
                'pageTitle' => 'Detail Kelas',
                'class'     => $class,
            ])
        );
    }

    /**
     * ==========================================
     * EDIT - Form Edit
     * ==========================================
     */
    public function edit(int $id)
    {
        $this->authorize(Permissions::CLASS_UPDATE);

        $class = $this->classService->getById($id);

        if (! $class) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view(
            'master/class/edit',
            $this->viewData([
                'title'         => 'Edit Kelas',
                'pageTitle'     => 'Edit Kelas',
                'class'         => $class,
                'studyPrograms' => $this->studyProgramService->getDropdown(),
            ])
        );
    }

    /**
     * ==========================================
     * UPDATE - Update Data
     * ==========================================
     */
    public function update(int $id)
    {
        $this->authorize(Permissions::CLASS_UPDATE);

        if (! $this->validate(ClassValidator::update($id))) {
            return redirect()
                ->back()
                ->withInput();
        }

        $this->classService->update(
            $id,
            $this->request->getPost()
        );

        return redirect()
            ->to(site_url('master/classes'))
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    /**
     * ==========================================
     * DELETE - Hapus
     * ==========================================
     */
    public function delete(int $id)
    {
        $this->authorize(Permissions::CLASS_DELETE);

        $this->classService->delete($id);

        return redirect()
            ->back()
            ->with('success', 'Data kelas berhasil dihapus.');
    }

    /**
     * ==========================================
     * RESTORE - Kembalikan
     * ==========================================
     */
    public function restore(int $id)
    {
        $this->authorize(Permissions::CLASS_RESTORE);

        $this->classService->restore($id);

        return redirect()
            ->back()
            ->with('success', 'Data kelas berhasil dikembalikan.');
    }

    /**
     * ==========================================
     * CHANGE STATUS - Ubah Status
     * ==========================================
     */
    public function changeStatus(int $id)
    {
        $this->authorize(Permissions::CLASS_UPDATE);

        $status = (bool) $this->request->getPost('is_active');

        $this->classService->changeStatus(
            $id,
            $status
        );

        return redirect()
            ->back()
            ->with('success', 'Status kelas berhasil diperbarui.');
    }
}

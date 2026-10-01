<?php

namespace App\Controllers\Management;

use App\Controllers\CrudController;
use App\Models\MasterRoleModel;
use App\Models\MasterApplicantTypeModel;
use App\Models\MasterStudyProgramModel;
use App\Models\MasterClassModel;
use App\Services\UserService;
use App\Validation\UserValidator;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends CrudController
{
    /**
     * Service
     */
    protected object $service;

    /**
     * Role Model
     */
    protected MasterRoleModel $roleModel;

    /**
     * Applicant Type Model
     */
    protected MasterApplicantTypeModel $applicantTypeModel;

    /**
     * Study Program Model
     */
    protected MasterStudyProgramModel $studyProgramModel;

    /**
     * Class Model
     */
    protected MasterClassModel $classModel;

    /**
     * Title
     */
    protected string $title = 'Manajemen User';

    /**
     * View Folder
     */
    protected string $viewPath = 'management/users';

    /**
     * Route
     */
    protected string $routePath = 'users';

    /**
     * Permission Prefix
     */
    protected string $permissionPrefix = 'user';

    public function __construct()
    {
        parent::__construct();

        $this->service           = new UserService();
        $this->roleModel         = new MasterRoleModel();
        $this->applicantTypeModel = new MasterApplicantTypeModel();
        $this->studyProgramModel = new MasterStudyProgramModel();
        $this->classModel        = new MasterClassModel();
    }

    /**
     * List User
     */
    public function index()
    {
        $this->authorize(Permissions::USER_VIEW);

        $keyword = trim(
            $this->request->getGet('keyword') ?? ''
        );

        $items = $keyword !== ''
            ? $this->service->search($keyword)
            : $this->service->paginate();

        return view(
            $this->viewPath . '/index',
            $this->viewData([
                'title'     => $this->title,
                'pageTitle' => $this->title,
                'items'     => $items,
                'pager'     => $this->service->getModel()->pager,
                'keyword'   => $keyword,
            ])
        );
    }

    /**
     * Form Tambah
     */
    public function create()
    {
        $this->authorize(Permissions::USER_CREATE);

        return view(
            $this->viewPath . '/create',
            $this->viewData([
                'title'          => 'Tambah User',
                'roles'          => $this->roleModel->getActive(),
                'applicantTypes' => $this->applicantTypeModel->getActive(),
                'studyPrograms'  => $this->studyProgramModel->getActive(),
                'classes'        => $this->classModel->getActive(),
                'applicantCode'  => 'UMUM',
                'applicantType'  => null,
                'data'           => [],
            ])
        );
    }

    /**
     * Form dinamis berdasarkan jenis pemohon (AJAX)
     */
    public function fields(int $applicantTypeId)
    {
        $this->authorize(Permissions::USER_CREATE);

        if ($applicantTypeId <= 0) {
            return view('components/applicant_fields', [
                'applicantCode' => 'UMUM',
                'applicantType' => null,
                'studyPrograms' => $this->studyProgramModel->getActive(),
                'classes'       => $this->classModel->getActive(),
                'data'          => [],
            ]);
        }

        $applicantType = $this->applicantTypeModel->find($applicantTypeId);

        if (! $applicantType) {
            return $this->response->setBody(
                '<p class="text-muted text-center py-3">Jenis pemohon tidak ditemukan.</p>'
            );
        }

        $code = strtoupper(
            $applicantType['code'] ?? ''
        );

        return view('components/applicant_fields', [
            'applicantCode' => $code,
            'applicantType' => $applicantType,
            'studyPrograms' => $this->studyProgramModel->getActive(),
            'classes'       => $this->classModel->getActive(),
            'data'          => [],
        ]);
    }

    /**
     * Simpan User
     */
    public function store(): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->authorize(Permissions::USER_CREATE);

        if (! $this->validate(UserValidator::store())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();

        if (! isset($data['is_active'])) {
            $data['is_active'] = 0;
        }

        $userId = $this->service->store($data);

        $this->logActivity(
            'create_user',
            'Menambahkan user baru: ' . ($data['full_name'] ?? ''),
            'users',
            $userId
        );

        return redirect()
            ->to(site_url($this->routePath))
            ->with('success', 'User berhasil disimpan.');
    }

    /**
     * Detail User
     */
    public function show(int $id)
    {
        $this->authorize(Permissions::USER_VIEW);

        $item = $this->service->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $profile = (new \App\Models\UserProfileModel())
            ->getComplete()
            ->where('user_profiles.user_id', $id)
            ->first();

        return view(
            $this->viewPath . '/show',
            $this->viewData([
                'title'   => 'Detail User',
                'item'    => $item,
                'profile' => $profile,
            ])
        );
    }

    /**
     * Form Edit
     */
    public function edit(int $id)
    {
        $this->authorize(Permissions::USER_UPDATE);

        $item = $this->service->find($id);

        if (! $item) {
            throw PageNotFoundException::forPageNotFound();
        }

        $profile = (new \App\Models\UserProfileModel())
            ->where('user_id', $id)
            ->first();

        $applicantCode = 'UMUM';
        $applicantType = null;

        if (! empty($profile['applicant_type_id'])) {
            $applicantType = $this->applicantTypeModel
                ->find($profile['applicant_type_id']);

            $applicantCode = strtoupper(
                $applicantType['code'] ?? 'UMUM'
            );
        }

        return view(
            $this->viewPath . '/edit',
            $this->viewData([
                'title'          => 'Edit User',
                'item'           => $item,
                'profile'        => $profile,
                'roles'          => $this->roleModel->getActive(),
                'applicantTypes' => $this->applicantTypeModel->getActive(),
                'studyPrograms'  => $this->studyProgramModel->getActive(),
                'classes'        => $this->classModel->getActive(),
                'applicantCode'  => $applicantCode,
                'applicantType'  => $applicantType,
                'data'           => $profile ?? [],
            ])
        );
    }

    /**
     * Update User
     */
    public function update(int $id): \CodeIgniter\HTTP\RedirectResponse
    {
        $this->authorize(Permissions::USER_UPDATE);

        if (! $this->validate(UserValidator::update($id))) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();

        if (! isset($data['is_active'])) {
            $data['is_active'] = 0;
        }

        $this->service->update($id, $data);

        $this->logActivity(
            'update_user',
            'Memperbarui user #' . $id,
            'users',
            $id
        );

        return redirect()
            ->to(site_url($this->routePath . '/show/' . $id))
            ->with('success', 'User berhasil diperbarui.');
    }
}

<?php

namespace App\Controllers\Content;

use App\Controllers\AdminController;
use App\Services\UnitsProfileService;
use App\Services\ServiceUnitService;
use App\Validation\UnitsProfileValidator;
use App\Constants\Permissions;
use CodeIgniter\Exceptions\PageNotFoundException;

class UnitsProfileController extends AdminController
{
    protected UnitsProfileService $profileService;
    protected ServiceUnitService $unitService;

    public function __construct()
    {
        parent::__construct();
        $this->profileService = service('unitsProfileService');
        $this->unitService = service('serviceUnitService');
    }

    public function index()
    {
        $this->authorize(Permissions::UNIT_PROFILE_VIEW);
        
        // TEST INSERT
        if ($this->request->getGet('test_insert')) {
            $data = [
                'service_unit_id' => 99, // some ID
                'description' => 'Test description directly in index',
                'is_active' => '1',
                'created_by' => 1
            ];
            try {
                $res = $this->profileService->create($data);
                dd("Success: " . $res);
            } catch (\Exception $e) {
                dd("Error: " . $e->getMessage());
            }
        }
        // END TEST
        
        $keyword = trim($this->request->getGet('keyword') ?? '');
        $result = $this->profileService->getList($keyword);
        return view('units-profiles/index', $this->viewData([
            'title' => 'Deskripsi Unit', 'pageTitle' => 'Deskripsi Unit',
            'profiles' => $result['profiles'], 'pager' => $result['pager'], 'keyword' => $keyword,
        ]));
    }

    public function create()
    {
        $this->authorize(Permissions::UNIT_PROFILE_CREATE);
        return view('units-profiles/create', $this->viewData([
            'title' => 'Tambah Deskripsi Unit', 'pageTitle' => 'Tambah Deskripsi Unit',
            'serviceUnits' => $this->unitService->getDropdown(),
        ]));
    }

    public function store()
    {
        $this->authorize(Permissions::UNIT_PROFILE_CREATE);
        if (! $this->validate(UnitsProfileValidator::store())) {
            return redirect()->back()->withInput();
        }
        $data = $this->request->getPost();
        $data['created_by'] = $this->user['id'] ?? null;
        $this->profileService->create($data);
        $this->logActivity('create', 'Menambahkan deskripsi unit (unit id: ' . ($data['service_unit_id'] ?? '-') . ')', 'units_profile', null);
        return redirect()->to(site_url('units-profiles'))->with('success', 'Deskripsi unit berhasil ditambahkan.');
    }

    public function show(int $id)
    {
        $this->authorize(Permissions::UNIT_PROFILE_VIEW);
        $profile = $this->profileService->getById($id);
        if (! $profile) throw PageNotFoundException::forPageNotFound();
        return view('units-profiles/show', $this->viewData([
            'title' => 'Detail Deskripsi Unit', 'pageTitle' => 'Detail Deskripsi Unit', 'profile' => $profile,
        ]));
    }

    public function edit(int $id)
    {
        $this->authorize(Permissions::UNIT_PROFILE_UPDATE);
        $profile = $this->profileService->getById($id);
        if (! $profile) throw PageNotFoundException::forPageNotFound();
        return view('units-profiles/edit', $this->viewData([
            'title' => 'Edit Deskripsi Unit', 'pageTitle' => 'Edit Deskripsi Unit',
            'profile' => $profile, 'serviceUnits' => $this->unitService->getDropdown(),
        ]));
    }

    public function update(int $id)
    {
        $this->authorize(Permissions::UNIT_PROFILE_UPDATE);
        if (! $this->validate(UnitsProfileValidator::update($id))) {
            return redirect()->back()->withInput();
        }
        $data = $this->request->getPost();
        $data['updated_by'] = $this->user['id'] ?? null;
        $this->profileService->update($id, $data);
        $this->logActivity('update', 'Memperbarui deskripsi unit (id: ' . $id . ')', 'units_profile', $id);
        return redirect()->to(site_url('units-profiles'))->with('success', 'Deskripsi unit berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $this->authorize(Permissions::UNIT_PROFILE_DELETE);
        $profile = $this->profileService->getById($id);
        $this->profileService->delete($id);
        $this->logActivity('delete', 'Menghapus deskripsi unit: ' . ($profile['unit_name'] ?? $id), 'units_profile', $id);
        return redirect()->back()->with('success', 'Deskripsi unit berhasil dihapus.');
    }

    public function restore(int $id)
    {
        $this->authorize(Permissions::UNIT_PROFILE_RESTORE);
        $this->profileService->restore($id);
        $this->logActivity('restore', 'Memulihkan deskripsi unit (id: ' . $id . ')', 'units_profile', $id);
        return redirect()->back()->with('success', 'Deskripsi unit berhasil dikembalikan.');
    }

    public function changeStatus(int $id)
    {
        $this->authorize(Permissions::UNIT_PROFILE_UPDATE);
        $this->profileService->changeStatus($id, (bool) $this->request->getPost('is_active'));
        $this->logActivity('update', 'Mengubah status deskripsi unit (id: ' . $id . ')', 'units_profile', $id);
        return redirect()->back()->with('success', 'Status deskripsi unit berhasil diperbarui.');
    }
}

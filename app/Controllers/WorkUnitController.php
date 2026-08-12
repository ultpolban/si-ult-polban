<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WorkUnitModel;
use App\Models\UserModel;

class WorkUnitController extends BaseController
{
    protected WorkUnitModel $workUnitModel;
    protected UserModel $userModel;

    public function __construct()
    {
        helper(['form']);

        $this->workUnitModel = new WorkUnitModel();
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

        $workUnits = $this->workUnitModel
            ->search($keyword)
            ->paginate($perPage);

        foreach ($workUnits as &$unit) {

            $unit['unit_code'] = $unit['code'] ?? '';

            $unit['total_user'] = $this->workUnitModel
                ->countUser($unit['id']);
        }

        unset($unit);

        return view('work-units/index', [

            'title' => 'Management Unit Kerja',

            'workUnits' => $workUnits,

            'pager' => $this->workUnitModel->pager,

            'keyword' => $keyword,

            'totalUnit' => $this->workUnitModel->countAll()

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('work-units/create', [

            'title' => 'Tambah Unit Kerja',

            'workUnit' => [],

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
                ->with('errors', $this->validator->getErrors());
        }

        $this->workUnitModel->insert([
            'code' => strtoupper(
                trim($this->request->getPost('code'))
            ),
            'name' => trim(
                $this->request->getPost('name')
            )
        ]);

        return redirect()
            ->to(base_url('work-units'))
            ->with('success', 'Unit kerja berhasil ditambahkan.');
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
            $codeRule .= '|is_unique[master_service_units.code]';
        } else {
            $codeRule .= '|is_unique[master_service_units.code,id,' . $id . ']';
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
                'required' => 'Kode unit wajib diisi.',
                'is_unique' => 'Kode unit sudah digunakan.'
            ],
            'name' => [
                'required' => 'Nama unit wajib diisi.'
            ]
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $workUnit = $this->workUnitModel->find($id);

        if (!$workUnit) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Unit kerja tidak ditemukan.'
            );
        }

        return view('work-units/edit', [

            'title' => 'Edit Unit Kerja',

            'workUnit' => $workUnit,

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
        $workUnit = $this->workUnitModel->find($id);

        if (!$workUnit) {

            return redirect()

                ->to(base_url('work-units'))

                ->with('error', 'Unit kerja tidak ditemukan.');
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

                ->with('errors', $this->validator->getErrors());
        }

        $this->workUnitModel->update($id, [
            'code' => strtoupper(
                trim($this->request->getPost('code'))
            ),
            'name' => trim(
                $this->request->getPost('name')
            )
        ]);

        return redirect()

            ->to(base_url('work-units'))

            ->with('success', 'Unit kerja berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $workUnit = $this->workUnitModel->find($id);

        if (!$workUnit) {

            return redirect()

                ->to(base_url('work-units'))

                ->with('error', 'Unit kerja tidak ditemukan.');
        }

        // Backend1 tidak menyimpan work_unit_id di users.
        $this->workUnitModel->delete($id);


        return redirect()

            ->to(base_url('work-units'))

            ->with(
                'success',
                'Unit kerja berhasil dihapus.'
            );
    }
}

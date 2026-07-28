<?php

namespace App\Controllers\Api\V1;

use App\Models\DepartmentModel;

class DepartmentController extends BaseApiController
{
    protected DepartmentModel $departmentModel;

    public function __construct()
    {
        $this->departmentModel = new DepartmentModel();
    }

    // GET /api/v1/departments
    public function index()
    {
        return $this->respond([
            'success' => true,
            'data' => $this->departmentModel
                ->orderBy('department_name', 'ASC')
                ->findAll()
        ]);
    }

    // GET /api/v1/departments/1
    public function show($id = null)
    {
        $department = $this->departmentModel->find($id);

        if (!$department) {
            return $this->failNotFound('Jurusan tidak ditemukan.');
        }

        return $this->respond([
            'success' => true,
            'data' => $department
        ]);
    }

    public function store()
    {
        $data = $this->request->getJSON(true);

        if (!$this->departmentModel->insert($data)) {

            return $this->errorResponse(
                implode(', ', $this->departmentModel->errors())
            );
        }

        return $this->successResponse([], 'Jurusan berhasil ditambahkan.', 201);
    }

    public function update($id = null)
    {
        $department = $this->departmentModel->find($id);

        if (!$department) {

            return $this->errorResponse(
                'Jurusan tidak ditemukan.',
                404
            );
        }

        $data = $this->request->getJSON(true);

        $this->departmentModel->update($id, $data);

        return $this->successResponse([], 'Jurusan berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        $department = $this->departmentModel->find($id);

        if (!$department) {

            return $this->errorResponse(
                'Jurusan tidak ditemukan.',
                404
            );
        }

        $this->departmentModel->delete($id);

        return $this->successResponse([], 'Jurusan berhasil dihapus.');
    }
}

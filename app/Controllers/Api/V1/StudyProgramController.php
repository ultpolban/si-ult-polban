<?php

namespace App\Controllers\Api\V1;

use App\Models\StudyProgramModel;

class StudyProgramController extends BaseApiController
{
    protected StudyProgramModel $studyProgramModel;

    public function __construct()
    {
        $this->studyProgramModel = new StudyProgramModel();
    }

    /**
     * Menampilkan semua program studi
     */
    public function index()
    {
        $departmentId = $this->request->getGet('department_id');

        $builder = $this->studyProgramModel
            ->select('study_programs.*, departments.department_name')
            ->join('departments', 'departments.id = study_programs.department_id', 'left');

        if (!empty($departmentId)) {
            $builder->where('study_programs.department_id', $departmentId);
        }

        $data = $builder
            ->orderBy('study_programs.program_name', 'ASC')
            ->findAll();

        return $this->successResponse($data, 'Data program studi berhasil diambil.');
    }

    /**
     * Detail program studi
     */
    public function show($id = null)
    {
        $data = $this->studyProgramModel
            ->select('study_programs.*, departments.department_name')
            ->join('departments', 'departments.id = study_programs.department_id', 'left')
            ->where('study_programs.id', $id)
            ->first();

        if (!$data) {
            return $this->errorResponse('Program Studi tidak ditemukan.', 404);
        }

        return $this->successResponse($data, 'Detail program studi berhasil diambil.');
    }

    /**
     * Tambah program studi
     */
    public function store()
    {
        $data = $this->request->getJSON(true);

        if (!$this->studyProgramModel->insert($data)) {
            return $this->errorResponse(
                implode(', ', $this->studyProgramModel->errors())
            );
        }

        return $this->successResponse([], 'Program Studi berhasil ditambahkan.', 201);
    }

    /**
     * Update program studi
     */
    public function update($id = null)
    {
        if (!$this->studyProgramModel->find($id)) {
            return $this->errorResponse('Program Studi tidak ditemukan.', 404);
        }

        $data = $this->request->getJSON(true);

        $this->studyProgramModel->update($id, $data);

        return $this->successResponse([], 'Program Studi berhasil diperbarui.');
    }

    /**
     * Hapus program studi
     */
    public function delete($id = null)
    {
        if (!$this->studyProgramModel->find($id)) {
            return $this->errorResponse('Program Studi tidak ditemukan.', 404);
        }

        $this->studyProgramModel->delete($id);

        return $this->successResponse([], 'Program Studi berhasil dihapus.');
    }
}

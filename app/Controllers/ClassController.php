<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClassModel;
use App\Models\StudyProgramModel;

class ClassController extends BaseController
{
    protected $classModel;
    protected $studyProgramModel;

    public function __construct()
    {
        $this->classModel = new ClassModel();
        $this->studyProgramModel = new StudyProgramModel();
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $classes = $this->classModel
                ->search($keyword)
                ->paginate(10);
        } else {
            $classes = $this->classModel
                ->getClasses()
                ->paginate(10);
        }

        $data = [

            'title' => 'Management Kelas',

            'classes' => $classes,

            'pager' => $this->classModel->pager,

            'keyword' => $keyword,

            'totalClass' => $this->classModel->countAll(),

            'activeClass' => $this->classModel->countActive(),

            'inactiveClass' => $this->classModel->countInactive()

        ];

        return view('classes/index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $data = [

            'title' => 'Tambah Kelas',

            'studyPrograms' => $this->studyProgramModel
                ->orderBy('program_name')
                ->findAll(),

            'validation' => \Config\Services::validation()

        ];

        return view('classes/create', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store()
    {

        $rules = [

            'study_program_id' => 'required',

            'class_name' => 'required',

            'status' => 'required'

        ];

        if (!$this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput();
        }

        $exist = $this->classModel

            ->where('study_program_id', $this->request->getPost('study_program_id'))

            ->where('class_name', $this->request->getPost('class_name'))

            ->first();

        if ($exist) {

            return redirect()

                ->back()

                ->withInput()

                ->with('error', 'Kelas sudah ada pada Program Studi tersebut.');
        }

        $this->classModel->save([

            'study_program_id' => $this->request->getPost('study_program_id'),

            'class_name' => strtoupper($this->request->getPost('class_name')),

            'status' => $this->request->getPost('status')

        ]);

        return redirect()

            ->to('/classes')

            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {

        $class = $this->classModel->getClassById($id);

        if (!$class) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('classes/show', [

            'title' => 'Detail Kelas',

            'class' => $class

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {

        $class = $this->classModel->find($id);

        if (!$class) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('classes/edit', [

            'title' => 'Edit Kelas',

            'class' => $class,

            'studyPrograms' => $this->studyProgramModel

                ->orderBy('program_name')

                ->findAll(),

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

        $exist = $this->classModel

            ->where('study_program_id', $this->request->getPost('study_program_id'))

            ->where('class_name', $this->request->getPost('class_name'))

            ->where('id !=', $id)

            ->first();

        if ($exist) {

            return redirect()

                ->back()

                ->withInput()

                ->with('error', 'Kelas sudah ada.');
        }

        $this->classModel->update($id, [

            'study_program_id' => $this->request->getPost('study_program_id'),

            'class_name' => strtoupper($this->request->getPost('class_name')),

            'status' => $this->request->getPost('status')

        ]);

        return redirect()

            ->to('/classes')

            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {

        $this->classModel->delete($id);

        return redirect()

            ->to('/classes')

            ->with('success', 'Data kelas berhasil dihapus.');
    }
}

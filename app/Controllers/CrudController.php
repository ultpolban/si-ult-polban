<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Exceptions\PageNotFoundException;

abstract class CrudController extends AdminController
{
    /**
     * Service yang dipakai controller turunan.
     */
    protected object $service;

    /**
     * Judul halaman.
     */
    protected string $title = '';

    /**
     * Folder view.
     * Contoh: master/departments
     */
    protected string $viewPath = '';

    /**
     * Route dasar.
     * Contoh: master/departments
     */
    protected string $routePath = '';

    /**
     * Prefix permission.
     */
    protected string $permissionPrefix = '';

    /**
     * Menampilkan daftar data.
     */
    public function index()
    {
        $data = $this->viewData([
            'title' => $this->title,
            'items' => $this->service->paginate(),
        ]);

        return view($this->viewPath . '/index', $data);
    }

    /**
     * Form tambah.
     */
    public function create()
    {
        return view(
            $this->viewPath . '/create',
            $this->viewData([
                'title' => 'Tambah ' . $this->title,
            ])
        );
    }

    /**
     * Simpan data.
     */
    public function store(): RedirectResponse
    {
        $this->service->store($this->request->getPost());

        return redirect()
            ->to(site_url($this->routePath))
            ->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Detail data.
     */
    public function show(int $id)
    {
        $item = $this->service->find($id);

        if (!$item) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view(
            $this->viewPath . '/show',
            $this->viewData([
                'title' => 'Detail ' . $this->title,
                'item'  => $item,
            ])
        );
    }

    /**
     * Form edit.
     */
    public function edit(int $id)
    {
        $item = $this->service->find($id);

        if (!$item) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view(
            $this->viewPath . '/edit',
            $this->viewData([
                'title' => 'Edit ' . $this->title,
                'item'  => $item,
            ])
        );
    }

    /**
     * Update data.
     */
    public function update(int $id): RedirectResponse
    {
        $this->service->update(
            $id,
            $this->request->getPost()
        );

        return redirect()
            ->to(site_url($this->routePath))
            ->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Soft delete.
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->delete($id);

        return redirect()
            ->back()
            ->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Restore soft delete.
     */
    public function restore(int $id): RedirectResponse
    {
        $this->service->restore($id);

        return redirect()
            ->back()
            ->with('success', 'Data berhasil dipulihkan.');
    }
}

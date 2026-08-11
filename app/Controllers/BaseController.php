<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    /**
     * Request Instance
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * Helpers
     */
    protected $helpers = [
        'url',
        'form',
        'text',
        'filesystem'
    ];

    /**
     * Service
     */
    protected $session;
    protected $validation;
    protected $db;

    /**
     * Login User
     */
    protected ?array $currentUser = null;

    /**
     * initialize
     */
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController(
            $request,
            $response,
            $logger
        );

        $this->session = session();

        $this->validation = service('validation');

        $this->db = db_connect();

        $this->currentUser = $this->session->get('user');
    }

    /**
     * Login Check
     */
    protected function requireLogin()
    {
        if (!$this->session->has('user')) {

            return redirect()->to('/login');

        }

        return null;
    }

    /**
     * JSON Success
     */
    protected function success(
        string $message = '',
        array $data = [],
        int $code = 200
    ) {
        return $this->response
            ->setStatusCode($code)
            ->setJSON([
                'status' => true,
                'message' => $message,
                'data' => $data,
            ]);
    }

    /**
     * JSON Error
     */
    protected function error(
        string $message = '',
        array $errors = [],
        int $code = 400
    ) {
        return $this->response
            ->setStatusCode($code)
            ->setJSON([
                'status' => false,
                'message' => $message,
                'errors' => $errors,
            ]);
    }

    /**
     * Flash Success
     */
    protected function flashSuccess(string $message)
    {
        session()->setFlashdata(
            'success',
            $message
        );
    }

    /**
     * Flash Error
     */
    protected function flashError(string $message)
    {
        session()->setFlashdata(
            'error',
            $message
        );
    }

    /**
     * Validation Error
     */
    protected function validationErrors()
    {
        return $this->validation->getErrors();
    }

    /**
     * Current User
     */
    protected function user()
    {
        return $this->currentUser;
    }

    /**
     * User ID
     */
    protected function userId()
    {
        return $this->currentUser['id'] ?? null;
    }

    /**
     * User Role
     */
    protected function roleId()
    {
        return $this->currentUser['role_id'] ?? null;
    }

    /**
     * Is Ajax
     */
    protected function isAjax()
    {
        return $this->request->isAJAX();
    }

    /**
     * Upload File
     */
    protected function uploadFile(
        string $field,
        string $path
    ) {
        $file = $this->request->getFile($field);

        if (!$file || !$file->isValid()) {
            return null;
        }

        $name = $file->getRandomName();

        $file->move(
            WRITEPATH . '../public/uploads/' . $path,
            $name
        );

        return $name;
    }

    /**
     * Delete Upload
     */
    protected function deleteFile(
        string $path,
        ?string $filename
    ) {
        if (!$filename) {
            return;
        }

        $file = WRITEPATH .
            '../public/uploads/' .
            $path .
            '/' .
            $filename;

        if (is_file($file)) {
            unlink($file);
        }
    }
}
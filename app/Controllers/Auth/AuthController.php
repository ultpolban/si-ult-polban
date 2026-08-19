<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        helper(['form']);

        $this->userModel = new UserModel();
    }

    /**
     * Halaman Login
     */
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard-mahasiswa');
        }

        return view('auth/login', [
            'title' => 'Login'
        ]);
    }

    /**
     * Proses Login
     */
 public function authenticate()
{
    $email = trim((string) $this->request->getPost('email'));
    $password = (string) $this->request->getPost('password');

    if ($email === '' || $password === '') {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Email dan Password wajib diisi.');
    }

    $user = $this->userModel
        ->where('email', $email)
        ->where('is_active', 1)
        ->first();

    if (!$user) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Email tidak ditemukan.');
    }

    if (!password_verify($password, $user['password'])) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Password salah.');
    }

    // ==========================================
    // UPDATE LAST LOGIN
    // ==========================================

    $this->userModel->updateLastLogin((int) $user['id']);

    // ==========================================
    // AMBIL ROLE
    // ==========================================

    $role = db_connect()
        ->table('roles')
        ->where('id', $user['role_id'])
        ->get()
        ->getRowArray();

    // ==========================================
    // SET SESSION
    // ==========================================

    session()->set([
        'user_id'    => (int) $user['id'],
        'role_id'    => (int) $user['role_id'],
        'full_name'  => $user['full_name'],
        'email'      => $user['email'],
        'role_name'  => $role['name'] ?? '',
        'isLoggedIn' => true,
        'user'       => $user,
    ]);

    // ==========================================
    // TENTUKAN DASHBOARD
    // BERDASARKAN JENIS PEMOHON
    // ==========================================

    $dashboardUrl = $this->getDashboardUrl((int) $user['id']);

    if (!$dashboardUrl) {

        session()->destroy();

        return redirect()
            ->to('/login')
            ->with(
                'error',
                'Jenis pemohon akun belum terdaftar dengan benar.'
            );
    }

    return redirect()->to($dashboardUrl);
}

    /**
     * Logout
     */
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }

    /**
 * Tentukan dashboard berdasarkan jenis pemohon
 */
private function getDashboardUrl(int $userId): ?string
{
    $db = \Config\Database::connect();

    $profile = $db->table('user_profiles up')
        ->select('
            up.applicant_type_id,
            mat.code AS applicant_code
        ')
        ->join(
            'master_applicant_types mat',
            'mat.id = up.applicant_type_id',
            'left'
        )
        ->where('up.user_id', $userId)
        ->where('up.deleted_at', null)
        ->get()
        ->getRowArray();

    if (!$profile) {
        return null;
    }

    $code = strtoupper(trim($profile['applicant_code'] ?? ''));

    switch ($code) {

        case 'MHS':
            return '/dashboard-mahasiswa';

        case 'DOSEN':
            return '/dosen/dashboard';

        case 'TENDIK':
            return '/dashboard-tendik';

        case 'WALI':
            return '/dashboard-orangtua';

        case 'MITRA':
            return '/dashboard-mitra';

        case 'UMUM':
            return '/dashboard-umum';

        case 'ALUMNI':
            return '/dashboard-alumni';

        default:
            return null;
    }
}
}

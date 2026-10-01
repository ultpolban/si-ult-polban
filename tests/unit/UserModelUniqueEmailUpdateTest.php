<?php

use App\Models\UserModel;
use CodeIgniter\Test\CIUnitTestCase;

/**
 * Regresi untuk bug "Profil gagal diperbarui" pada pembaruan profil.
 *
 * Akar bug:
 * Validation::fillPlaceholders() hanya mengganti placeholder {id} bila key
 * `id` benar-benar ada pada data yang divalidasi. BaseModel::update() tidak
 * pernah menyisipkan primary key, sehingga rule email tetap berbentuk literal
 * "is_unique[users.email,id,{id}]" -> SQL "id != '{id}'" -> MySQL mengonversi
 * '{id}' menjadi 0 -> "id != 0" selalu benar -> record milik user sendiri ikut
 * terhitung -> validasi gagal -> update() mengembalikan false -> controller
 * melempar error "Profil gagal diperbarui".
 *
 * Solusi: UserModel::update() menyisipkan primary key ke dalam data sebelum
 * validasi, dan UserModel menyediakan rule `id` agar placeholder bisa diisi.
 */
final class UserModelUniqueEmailUpdateTest extends CIUnitTestCase
{
    public function testOwnEmailIsConsideredUniqueOnlyWhenIdIsPresent(): void
    {
        $user = (new UserModel())->findAll(1)[0] ?? null;

        if ($user === null) {
            $this->markTestSkipped('Tabel users kosong.');
        }

        $rowWithoutId = [
            'full_name'    => $user['full_name'],
            'email'        => $user['email'],
            'phone_number' => $user['phone_number'] ?? null,
        ];

        $rowWithId = ['id' => (int) $user['id']] + $rowWithoutId;

        // Perilaku lama (tanpa `id`): email sendiri dianggap duplikat.
        $modelWithoutId = new UserModel();

        $this->assertFalse(
            $modelWithoutId->validate($rowWithoutId),
            'Tanpa key `id`, rule is_unique tidak dapat mengecualikan record sendiri.'
        );

        // Perilaku setelah fix (dengan `id`): email sendiri harus lolos.
        $modelWithId = new UserModel();

        $this->assertTrue(
            $modelWithId->validate($rowWithId),
            'Dengan key `id`, is_unique harus mengabaikan record miliknya sendiri. '
            . json_encode($modelWithId->errors())
        );
    }

    public function testUpdateWithUnchangedEmailSucceeds(): void
    {
        $db   = \Config\Database::connect('default');
        $user = (new UserModel())->findAll(1)[0] ?? null;

        if ($user === null) {
            $this->markTestSkipped('Tabel users kosong.');
        }

        // Transaksi dibatalkan agar data di database tidak berubah.
        $db->transBegin();

        try {
            $result = (new UserModel())->update((int) $user['id'], [
                'full_name'    => $user['full_name'],
                'email'        => $user['email'],
                'phone_number' => $user['phone_number'] ?? null,
            ]);

            $this->assertTrue(
                $result,
                'UserModel::update() wajib sukses ketika email tidak diubah.'
            );
        } finally {
            $db->transRollback();
        }
    }
}

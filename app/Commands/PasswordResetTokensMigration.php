<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Database\BaseConnection;
use CodeIgniter\Database\MigrationRunner;
use Config\Database as DatabaseConfig;
use Config\Migrations as MigrationsConfig;
use Throwable;

class PasswordResetTokensMigration extends BaseCommand
{
    private const TARGET_DATABASE = 'si-ult-polban';
    private const TARGET_VERSION = '2026-10-22-000001';
    private const TARGET_CLASS = 'CreatePasswordResetTokensTable';
    private const TARGET_NAMESPACE = 'App';
    private const TARGET_GROUP = 'default';

    protected $group = 'Database';
    protected $name = 'password-reset:tokens-up';
    protected $description = 'Safely applies only the password reset token migration.';
    protected $usage = 'password-reset:tokens-up --confirm-target=si-ult-polban --confirm-backup=yes --confirm-up=CreatePasswordResetTokensTable';
    protected $options = [
        '--confirm-target' => 'Required confirmation of the target database name.',
        '--confirm-backup' => 'Must be yes to confirm a verified backup exists.',
        '--confirm-up'     => 'Must match the migration class to confirm up direction.',
    ];

    public function run(array $params)
    {
        if (ENVIRONMENT !== 'development') {
            return $this->abort('Only the development environment is allowed.');
        }

        $targetConfirmation = $params['confirm-target'] ?? CLI::getOption('confirm-target');
        $backupConfirmation = $params['confirm-backup'] ?? CLI::getOption('confirm-backup');
        $directionConfirmation = $params['confirm-up'] ?? CLI::getOption('confirm-up');

        if (
            $targetConfirmation !== self::TARGET_DATABASE
            || $backupConfirmation !== 'yes'
            || $directionConfirmation !== self::TARGET_CLASS
        ) {
            return $this->abort(
                'Confirm target, verified backup, and up direction using the documented options.'
            );
        }

        $databaseConfig = config(DatabaseConfig::class);
        $migrationConfig = config(MigrationsConfig::class);

        if (
            $databaseConfig->defaultGroup !== self::TARGET_GROUP
            || strtolower((string) ($databaseConfig->default['DBDriver'] ?? '')) !== 'mysqli'
        ) {
            return $this->abort('The configured default connection is not the required MySQLi group.');
        }

        if (! $migrationConfig->enabled || ! $migrationConfig->lock) {
            return $this->abort('Migrations must be enabled and CI4 migration locking must be enabled.');
        }

        try {
            $db = db_connect(self::TARGET_GROUP);
            $db->initialize();

            $databaseRow = $db->query('SELECT DATABASE() AS active_database')->getRowArray();
            $activeDatabase = (string) ($databaseRow['active_database'] ?? '');

            if ($activeDatabase !== self::TARGET_DATABASE) {
                return $this->abort('The active database is not si-ult-polban.');
            }

            $prefix = $db->getPrefix();
            $usersTable = $prefix . 'users';
            $historyTable = $prefix . $migrationConfig->table;
            $resetTokensTable = $prefix . 'password_reset_tokens';

            if (! $this->tableExists($db, $historyTable)) {
                return $this->abort('The migrations history table is missing; refusing to create it.');
            }

            if (! $this->tableExists($db, $historyTable . '_lock')) {
                return $this->abort('The CI4 migration lock table is missing; refusing to create it.');
            }

            if ($this->tableExists($db, $resetTokensTable)) {
                return $this->abort('password_reset_tokens already exists; inspect it before proceeding.');
            }

            $userSchema = $db->query(
                'SELECT c.COLUMN_TYPE, c.COLUMN_KEY, t.ENGINE
                   FROM INFORMATION_SCHEMA.COLUMNS c
                   JOIN INFORMATION_SCHEMA.TABLES t
                     ON t.TABLE_SCHEMA = c.TABLE_SCHEMA
                    AND t.TABLE_NAME = c.TABLE_NAME
                  WHERE c.TABLE_SCHEMA = DATABASE()
                    AND c.TABLE_NAME = ?
                    AND c.COLUMN_NAME = ?',
                [$usersTable, 'id']
            )->getRowArray();

            if (! $this->hasCompatibleUsersPrimaryKey($userSchema)) {
                return $this->abort('users.id must be an InnoDB INT UNSIGNED primary key.');
            }

            $runner = $this->createGuardedRunner($migrationConfig);
            $migrationPath = APPPATH
                . 'Database' . DIRECTORY_SEPARATOR
                . 'Migrations' . DIRECTORY_SEPARATOR
                . self::TARGET_VERSION . '_' . self::TARGET_CLASS . '.php';
            $preflight = fn (): bool => $this->preflight($db, $runner);

            if (! $preflight()) {
                return $this->abort('A preflight condition failed. No migration was run.');
            }

            if (! $runner->applyOneUp(
                $migrationPath,
                self::TARGET_NAMESPACE,
                self::TARGET_GROUP,
                $preflight
            )) {
                return $this->abort('The guarded up operation was refused or failed. Inspect schema and history before retrying.');
            }

            $verifyError = $this->verifyResult($db, $runner);

            if ($verifyError !== null) {
                return $this->abort($verifyError . ' Inspect schema and history before retrying.');
            }

            CLI::write('Password reset token migration applied and verified.', 'green');

            return EXIT_SUCCESS;
        } catch (Throwable) {
            return $this->abort('Preflight or migration failed. Inspect database schema and migration history; details were withheld.');
        }
    }

    private function createGuardedRunner(MigrationsConfig $config): MigrationRunner
    {
        return new class($config, self::TARGET_GROUP) extends MigrationRunner {
            public function applyOneUp(
                string $path,
                string $namespace,
                string $group,
                callable $preflight
            ): bool {
                if (! $this->enabled || ! $this->lock) {
                    return false;
                }

                $this->setNamespace($namespace);
                $this->setGroup($group);
                $this->groupFilter = $group;

                if (! $preflight()) {
                    return false;
                }

                if (
                    ! $this->db->tableExists($this->table)
                    || ! $this->db->tableExists($this->table . '_lock')
                    || ! $this->acquireMigrationLock()
                ) {
                    return false;
                }

                try {
                    if (! $preflight()) {
                        return false;
                    }

                    $migration = $this->migrationFromFile($path, $namespace);

                    if ($migration === false) {
                        return false;
                    }

                    $batch = $this->getLastBatch() + 1;

                    if (! $this->migrate('up', $migration) || $this->groupSkip) {
                        $this->groupSkip = false;

                        return false;
                    }

                    $this->addHistory($migration, $batch);

                    return true;
                } finally {
                    $this->releaseMigrationLock();
                }
            }
        };
    }

    private function preflight(BaseConnection $db, MigrationRunner $runner): bool
    {
        $activeDatabase = (string) ($db->query('SELECT DATABASE() AS active_database')->getRowArray()['active_database'] ?? '');

        if ($activeDatabase !== self::TARGET_DATABASE) {
            return false;
        }

        $prefix = $db->getPrefix();
        $historyTable = $prefix . config(MigrationsConfig::class)->table;
        $lockTable = $historyTable . '_lock';
        $usersTable = $prefix . 'users';
        $resetTokensTable = $prefix . 'password_reset_tokens';

        if (
            ! $this->tableExists($db, $historyTable)
            || ! $this->tableExists($db, $lockTable)
            || ! $this->tableExists($db, $usersTable)
            || $this->tableExists($db, $resetTokensTable)
        ) {
            return false;
        }

        $userSchema = $db->query(
            'SELECT c.COLUMN_TYPE, c.COLUMN_KEY, t.ENGINE
               FROM INFORMATION_SCHEMA.COLUMNS c
               JOIN INFORMATION_SCHEMA.TABLES t
                 ON t.TABLE_SCHEMA = c.TABLE_SCHEMA
                AND t.TABLE_NAME = c.TABLE_NAME
              WHERE c.TABLE_SCHEMA = DATABASE()
                AND c.TABLE_NAME = ?
                AND c.COLUMN_NAME = ?',
            [$usersTable, 'id']
        )->getRowArray();

        if (! $this->hasCompatibleUsersPrimaryKey($userSchema)) {
            return false;
        }

        $runner->setNamespace(self::TARGET_NAMESPACE);
        $matches = array_values(array_filter(
            $runner->findNamespaceMigrations(self::TARGET_NAMESPACE),
            static fn (object $migration): bool =>
                $migration->version === self::TARGET_VERSION
                && $migration->class === self::TARGET_CLASS
        ));

        if (count($matches) !== 1) {
            return false;
        }

        $targetUid = $runner->getObjectUid($matches[0]);

        foreach ($runner->getHistory(self::TARGET_GROUP) as $record) {
            if ($runner->getObjectUid($record) === $targetUid) {
                return false;
            }
        }

        return true;
    }

    private function verifyResult(BaseConnection $db, MigrationRunner $runner): ?string
    {
        $prefix = $db->getPrefix();
        $table = $prefix . 'password_reset_tokens';

        if (! $this->tableExists($db, $table)) {
            return 'password_reset_tokens is missing after the up operation.';
        }

        $columns = $db->query(
                        'SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_KEY, EXTRA
               FROM INFORMATION_SCHEMA.COLUMNS
              WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = ?',
            [$table]
        )->getResultArray();
        $columnMap = [];

        foreach ($columns as $column) {
            $columnMap[$column['COLUMN_NAME']] = $column;
        }

        $expectedColumns = [
            'id'          => ['int unsigned', 'NO', 'PRI'],
            'user_id'     => ['int unsigned', 'NO', 'UNI'],
            'token_hash'  => ['char(64)', 'NO', 'UNI'],
            'expires_at'  => ['datetime', 'NO', ''],
            'consumed_at' => ['datetime', 'YES', ''],
            'created_at'  => ['datetime', 'NO', ''],
        ];

        foreach ($expectedColumns as $name => [$type, $nullable, $key]) {
            $column = $columnMap[$name] ?? null;

            if (
                $column === null
                || $this->normalizeColumnType((string) $column['COLUMN_TYPE']) !== $type
                || $column['IS_NULLABLE'] !== $nullable
                || $column['COLUMN_KEY'] !== $key
                || ($name === 'id' && strtolower((string) $column['EXTRA']) !== 'auto_increment')
            ) {
                return 'The password_reset_tokens schema does not match the migration.';
            }
        }

        $tableEngine = $db->query(
            'SELECT ENGINE
               FROM INFORMATION_SCHEMA.TABLES
              WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = ?',
            [$table]
        )->getRowArray();

        if (strtolower((string) ($tableEngine['ENGINE'] ?? '')) !== 'innodb') {
            return 'password_reset_tokens is not using InnoDB.';
        }

        $foreignKey = $db->query(
                        'SELECT k.REFERENCED_TABLE_NAME,
                                        k.REFERENCED_COLUMN_NAME,
                                        r.DELETE_RULE,
                                        r.UPDATE_RULE
                             FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE k
                             JOIN INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS r
                                 ON r.CONSTRAINT_SCHEMA = k.CONSTRAINT_SCHEMA
                                AND r.CONSTRAINT_NAME = k.CONSTRAINT_NAME
                            WHERE k.TABLE_SCHEMA = DATABASE()
                                AND k.TABLE_NAME = ?
                                AND k.COLUMN_NAME = ?
                                AND k.REFERENCED_TABLE_NAME = ?
                                AND k.REFERENCED_COLUMN_NAME = ?',
            [$table, 'user_id', $prefix . 'users', 'id']
        )->getRowArray();

        if (
            $foreignKey === null
            || strtoupper((string) $foreignKey['DELETE_RULE']) !== 'CASCADE'
            || strtoupper((string) $foreignKey['UPDATE_RULE']) !== 'CASCADE'
        ) {
            return 'The user_id foreign key to users.id does not match the migration.';
        }

        $runner->setNamespace(self::TARGET_NAMESPACE);
        $target = null;

        foreach ($runner->findNamespaceMigrations(self::TARGET_NAMESPACE) as $migration) {
            if (
                $migration->version === self::TARGET_VERSION
                && $migration->class === self::TARGET_CLASS
            ) {
                $target = $migration;
                break;
            }
        }

        if ($target === null) {
            return 'The target migration could not be resolved for history verification.';
        }

        foreach ($runner->getHistory(self::TARGET_GROUP) as $record) {
            if ($runner->getObjectUid($record) === $runner->getObjectUid($target)) {
                return null;
            }
        }

        return 'The CI4 migration history record is missing.';
    }

    private function tableExists(BaseConnection $db, string $table): bool
    {
        return $db->query(
            'SELECT 1
               FROM INFORMATION_SCHEMA.TABLES
              WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = ?
              LIMIT 1',
            [$table]
        )->getRowArray() !== null;
    }

    private function hasCompatibleUsersPrimaryKey(?array $schema): bool
    {
        if ($schema === null || ($schema['COLUMN_KEY'] ?? '') !== 'PRI') {
            return false;
        }

        $columnType = strtolower((string) preg_replace('/\(\d+\)/', '', $schema['COLUMN_TYPE'] ?? ''));
        $columnType = str_replace(' ', '', $columnType);

        return $columnType === 'intunsigned'
            && strtolower((string) ($schema['ENGINE'] ?? '')) === 'innodb';
    }

    private function normalizeColumnType(string $type): string
    {
        $type = strtolower($type);
        $type = preg_replace('/\bint\(\d+\)/', 'int', $type) ?? $type;

        return trim(preg_replace('/\s+/', ' ', $type) ?? $type);
    }

    private function abort(string $message): int
    {
        CLI::error($message);

        return EXIT_ERROR;
    }
}
<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit\Tests;

use PHPUnit\Framework\Attributes\Test;

use SATHub\PHPUnit\BaseDatabase;

class DatabaseTest extends BaseDatabase
{
    protected function getConnection(): \PDO {
        return new \PDO('mysql:host=localhost;dbname=sathub_phpunit', 'phpunit', 'testing');
    }

    protected function initData(): void {
        $this->executeMysqlDump(__DIR__ . '/data/database-test.sql');
    }

    #[Test]
    public function databaseIsAvailable(): void {
        $this->assertTrue($this->isDatabaseAvailable());
    }
}

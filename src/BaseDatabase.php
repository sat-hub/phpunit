<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit;

use PHPUnit\Framework\Attributes\Before;

abstract class BaseDatabase extends Base
{
    use AssertionsMysql;

    #[Before]
    public function checkDatabaseAvailability(): void {
        if (!$this->isDatabaseAvailable()) {
            $this->markTestSkipped('Database is not available');
        }
    }
}

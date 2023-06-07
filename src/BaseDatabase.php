<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit;

abstract class BaseDatabase extends Base
{
	use AssertionsMysql;

	public function setUp(): void {
		parent::setUp();
		$this->initDatabaseOnSetup();
		if (!$this->isDatabaseAvailable()) {
			$this->markTestSkipped('Database is not available');
		}
	}
}

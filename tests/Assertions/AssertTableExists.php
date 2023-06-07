<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit\Tests\Assertions;

use PHPUnit\Framework\ExpectationFailedException;
use SATHub\PHPUnit\AssertionsMysql;

use SATHub\PHPUnit\Tests\DatabaseTest;

class AssertTableExists extends DatabaseTest
{
	use AssertionsMysql;

	/**
	 * @test
	 */
	public function assertTableExistsSucceeds(): void {
		$this->assertTableExists('assertion');
	}

	/**
	 * @test
	 */
	public function assertTableExistsFails(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertTableExists('assetion');
	}
}

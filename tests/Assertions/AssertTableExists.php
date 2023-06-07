<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit\Tests\Assertions;

use PHPUnit\Framework\Attributes\Test;

use PHPUnit\Framework\ExpectationFailedException;
use SATHub\PHPUnit\AssertionsMysql;

use SATHub\PHPUnit\Tests\DatabaseTest;

class AssertTableExists extends DatabaseTest
{
	use AssertionsMysql;

	#[Test]
	public function assertTableExistsSucceeds(): void {
		$this->assertTableExists('assertion');
	}

	#[Test]
	public function assertTableExistsFails(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertTableExists('assetion');
	}
}

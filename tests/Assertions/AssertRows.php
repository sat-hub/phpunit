<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit\Tests\Assertions;

use PHPUnit\Framework\ExpectationFailedException;

use SATHub\PHPUnit\AssertionsMysql;

use SATHub\PHPUnit\Tests\DatabaseTest;

class AssertRows extends DatabaseTest
{
	use AssertionsMysql;

	/**
	 * @test
	 */
	public function assertRowsSucceeds(): void {
		$this->assertRows(2, 'assertion');
	}

	/**
	 * @test
	 */
	public function assertRowsFailes(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertRows(1, 'assertion');
	}
}

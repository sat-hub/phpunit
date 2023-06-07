<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit\Tests\Assertions;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

use SATHub\PHPUnit\Assertions;

class AssertObjectHasMethodTest extends TestCase
{
	use Assertions;

	#[Test]
	public function assertObjectHasMethodSucceeds(): void {
		$this->assertObjectHasMethod(__FUNCTION__, $this);
	}

	#[Test]
	public function assertObjectHasMethodFailsIfMethodDoesNotExist(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertObjectHasMethod('nonExistingMethod', $this);
	}

	#[Test]
	public function assertObjectHasMethodFailsForNonObject(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertObjectHasMethod('toString', 'string');
	}

	#[Test]
	public function assertObjectHasMethodFailsForInvalidMethodName(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertObjectHasMethod('I-am-!nvalid', $this);
	}
}

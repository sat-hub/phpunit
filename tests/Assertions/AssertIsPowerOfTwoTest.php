<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit\Tests\Assertions;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

use SATHub\PHPUnit\Assertions;

class AssertIsPowerOfTwoTest extends TestCase
{
	use Assertions;

	#[Test]
	public function assertIsPowerOfTwoSucceeds(): void {
		$this->assertIsPowerOfTwo(1);
		$this->assertIsPowerOfTwo(2);
		$this->assertIsPowerOfTwo(8);
		$this->assertIsPowerOfTwo(8192);
		$this->assertIsPowerOfTwo(65536 * 65536 * 65536);
	}

	#[Test]
	public function assertIsPowerOfTwoForZero(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertIsPowerOfTwo(0);
	}

	#[Test]
	public function assertIsPowerOfTwoForNegativeValue(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertIsPowerOfTwo(-4);
	}

	#[Test]
	public function assertIsPowerOfTwoFailsForFloat(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertIsPowerOfTwo(4.0);
	}

	#[Test]
	public function assertIsPowerOfTwoFailsForString(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertIsPowerOfTwo('4');
	}
}

<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit\Tests\Assertions;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

use SATHub\PHPUnit\Assertions;

use SATHub\PHPUnit\Tests\Mock\Mock;

class AssertArrayTest extends TestCase
{
	use Assertions;

	#[Test]
	public function assertArrayWithEmptyArray(): void {
		$this->assertArray([]);
	}

	#[Test]
	public function assertCountParameterIsRequired(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertArray([735, -2673]);
	}

	#[Test]
	public function assertArrayWithArrayOfClassInstances(): void {
		$this->assertArray([new Mock(), new Mock()], 2, Mock::class);
	}

	#[Test]
	public function assertArrayWithArrayOfMixedClasses(): void {
		$this->assertArray([new Mock(), new \stdClass()], 2);
	}

	#[Test]
	public function assertArrayWithArrayOfMixedClassesFails(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertArray([new Mock(), new \stdClass()], 2, Mock::class);
	}

	#[Test]
	public function assertArrayWithArrayOfStdClass(): void {
		$this->assertArray([new \stdClass()], 1, \stdClass::class);
		$this->assertArray([new \stdClass()], 1, 'stdClass');
		$this->assertArray([new \stdClass()], 1, '\\stdClass');
	}
}

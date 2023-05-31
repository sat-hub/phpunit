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
	public function assertArrayWithEmptyArray(): void
	{
		$this->assertArray([]);
	}

	#[Test]
	public function assertArrayWithArrayOfIntegers(): void
	{
		$this->assertArray([735, -2673], 2, 'int');
	}

	#[Test]
	public function assertCountParameterIsRequired(): void
	{
		$this->expectException(ExpectationFailedException::class);

		$this->assertArray([735, -2673]);
	}

	#[Test]
	public function assertArrayWithArrayOfStrings(): void
	{
		$this->assertArray(['735', '', __CLASS__], 3, 'string');
	}

	#[Test]
	public function assertArrayWithArrayOfObjects(): void
	{
		$this->assertArray([new \stdClass(), $this, new Mock()], 3, 'object');
	}

	#[Test]
	public function assertArrayWithArrayOfClassInstances(): void
	{
		$this->assertArray([new Mock(), new Mock()], 2, Mock::class);
	}

	#[Test]
	public function assertArrayWithArrayOfMixedClasses(): void
	{
		$this->assertArray([new Mock(), new \stdClass()], 2);
	}

	#[Test]
	public function assertArrayWithArrayOfMixedClassesFails(): void
	{
		$this->expectException(ExpectationFailedException::class);

		$this->assertArray([new Mock(), new \stdClass()], 2, Mock::class);
	}
}

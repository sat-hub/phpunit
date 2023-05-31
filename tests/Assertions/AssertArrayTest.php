<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit\Tests\Assertions;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

use SATHub\PHPUnit\Assertions;

use SATHub\PHPUnit\Tests\Mock\Mock;

class AssertArrayTest extends TestCase
{
	use Assertions;

	/**
	 * @test
	 */
	public function assertArrayWithEmptyArray(): void
	{
		$this->assertArray([]);
	}

	/**
	 * @test
	 */
	public function assertArrayWithArrayOfIntegers(): void
	{
		$this->assertArray([735, -2673], 2, 'int');
	}

	/**
	 * @test
	 */
	public function assertCountParameterIsRequired(): void
	{
		$this->expectException(ExpectationFailedException::class);

		$this->assertArray([735, -2673]);
	}

	/**
	 * @test
	 */
	public function assertArrayWithArrayOfStrings(): void
	{
		$this->assertArray(['735', '', __CLASS__], 3, 'string');
	}

	/**
	 * @test
	 */
	public function assertArrayWithArrayOfObjects(): void
	{
		$this->assertArray([new \stdClass(), $this, new Mock()], 3, 'object');
	}

	/**
	 * @test
	 */
	public function assertArrayWithArrayOfClassInstances(): void
	{
		$this->assertArray([new Mock(), new Mock()], 2, Mock::class);
	}

	/**
	 * @test
	 */
	public function assertArrayWithArrayOfMixedClasses(): void
	{
		$this->assertArray([new Mock(), new \stdClass()], 2);
	}

	/**
	 * @test
	 */
	public function assertArrayWithArrayOfMixedClassesFails(): void
	{
		$this->expectException(ExpectationFailedException::class);

		$this->assertArray([new Mock(), new \stdClass()], 2, Mock::class);
	}

	/**
	 * @test
	 */
	public function assertArrayWithArrayOfStdClass(): void
	{
		$this->assertArray([new \stdClass()], 1, \stdClass::class);
		$this->assertArray([new \stdClass()], 1, 'stdClass');
		$this->assertArray([new \stdClass()], 1, '\\stdClass');
	}
}

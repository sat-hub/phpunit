<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit\Tests\Assertions;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

use SATHub\PHPUnit\Assertions;

use SATHub\PHPUnit\Tests\Mock\PropertyObject;

class AssertObjectHasPropertyTest extends TestCase
{
	use Assertions;

	/**
	 * @test
	 */
	public function assertObjectHasPropertySucceeds(): void {
		$this->assertObjectHasProperty('property', new PropertyObject());
	}

	/**
	 * @test
	 */
	public function assertObjectHasMethodFailsIfMethodDoesNotExist(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertObjectHasProperty('nonExistingProperty', new PropertyObject());
	}
}

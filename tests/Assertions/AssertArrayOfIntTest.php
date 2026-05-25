<?php
declare(strict_types = 1);
namespace Assertions;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use SATHub\PHPUnit\Assertions;

class AssertArrayOfIntTest extends TestCase
{
	use Assertions;

	#[Test]
	public function assertArrayWithArrayOfIntegers(): void {
		$this->assertArrayOfInt([735, -2673], 2);
	}
}

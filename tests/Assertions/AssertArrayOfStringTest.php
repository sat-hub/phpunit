<?php
declare(strict_types = 1);
namespace Assertions;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use SATHub\PHPUnit\Assertions;

class AssertArrayOfStringTest extends TestCase
{
	use Assertions;

	#[Test]
	public function assertArrayWithArrayOfStrings(): void {
		$this->assertArrayOfString(['735', '', __CLASS__], 3);
	}
}

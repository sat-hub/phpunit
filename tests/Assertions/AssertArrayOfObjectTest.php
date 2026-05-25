<?php
declare(strict_types = 1);
namespace Assertions;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use SATHub\PHPUnit\Assertions;

use SATHub\PHPUnit\Tests\Mock\Mock;

class AssertArrayOfObjectTest extends TestCase
{
	use Assertions;

	#[Test]
	public function assertArrayWithArrayOfObjects(): void {
		$this->assertArrayOfObject([new \stdClass(), $this, new Mock()], 3);
	}
}

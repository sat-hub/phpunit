<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit\Tests\Assertions;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use SATHub\PHPUnit\Assertions;

class PassTest extends TestCase
{
	use Assertions;

	#[Test]
	public function passSucceeds(): void {
		$this->pass();
	}
}

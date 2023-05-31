<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit\Tests\Functions;

use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function SATHub\PHPUnit\getClass;

class GetClassTest extends TestCase
{
	#[Before]
	public function requireFunctions(): void
	{
		require_once __DIR__ . '/../../src/Functions.php';
	}

	#[Test]
	public function getClassReturnsCorrectClassName(): void {
		$this->assertSame('GetClassTest', getClass($this));
	}
}

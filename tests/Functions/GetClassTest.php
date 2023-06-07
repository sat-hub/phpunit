<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit\Tests\Functions;

use PHPUnit\Framework\TestCase;

use function SATHub\PHPUnit\getClass;

class GetClassTest extends TestCase
{
	protected function setUp(): void {
		parent::setUp();
		require_once __DIR__ . '/../../src/Functions.php';
	}

	/**
	 * @test
	 */
	public function getClassReturnsCorrectClassName(): void {
		$this->assertSame('GetClassTest', getClass($this));
	}
}

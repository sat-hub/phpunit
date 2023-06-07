<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit\Tests\Functions;

use PHPUnit\Framework\TestCase;

use function SATHub\PHPUnit\str_starts_with;

class StrStartsWithTest extends TestCase
{
	protected function setUp(): void {
		parent::setUp();
		require_once __DIR__ . '/../../src/Functions.php';
	}

	/**
	 * @test
	 */
	public function strStartsWithReturnsTrue(): void {
		$this->assertTrue(str_starts_with('MyString', 'My'));
	}

	/**
	 * @test
	 */
	public function strStartsWithReturnsFalse(): void {
		$this->assertFalse(str_starts_with('MyString', 'Mys'));
		$this->assertFalse(str_starts_with('MyString', 'my'));
		$this->assertFalse(str_starts_with('MyString', 'String'));
	}
}

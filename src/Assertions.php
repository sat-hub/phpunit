<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit;

use PHPUnit\Framework\Assert;

trait Assertions
{
	/**
	 * Assert that the actual value is an array containing an exact number of elements that may have a defined type.
	 */
	public static function assertArray(mixed $actual, int $count = 0, ?string $type = null, string $message = ''): void {
		Assert::assertIsArray($actual, $message);
		$message = $message ?? 'Expected array of ' . $count . ' elements.';
		Assert::assertSame($count, count($actual), $message);
		if ($type) {
			if (str_contains($type, '\\')) {
				Assert::assertContainsOnlyInstancesOf($type, $actual);
			} else {
				Assert::assertContainsOnly($type, $actual, true);
			}
		}
	}

	/**
	 * Assert that array has key and value.
	 */
	public static function assertArrayKey(mixed $actual, mixed $key, mixed $value, string $message = ''): void {
		Assert::assertIsArray($actual, $message);
		Assert::assertArrayHasKey($key, $actual, $message);
		$actualValue = $actual[$key];
		$message     = $message ?? 'Expected array key ' . $key . ' has value ' . $value . ' (actual value is ' . $actualValue . ').';
		Assert::assertSame($value, $actualValue, $message);
	}

	/**
	 * Pass a test that does not assert anything, just checking for exceptions.
	 */
	public function pass(): void {
		$this->expectNotToPerformAssertions();
	}

	/**
	 * Mark a test incomplete.
	 */
	protected function incomplete(string $message = 'is incomplete'): void {
		$message = trim($message, ' .');
		Assert::markTestIncomplete('Test ' . getClass($this) . '() ' . $message . '.');
	}
}

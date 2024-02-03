<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit\Tests\Assertions;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

use SATHub\PHPUnit\Assertions;

class AssertArrayKeyTest extends TestCase
{
	use Assertions;

	private const KEY = 'key';

	private const INT = 123;

	private const STRING = 'value';

	#[Test]
	public function assertArrayKeySucceeds(): void {
		$this->assertArrayKey([self::KEY => self::INT], self::KEY, self::INT);
	}

	#[Test]
	public function assertArrayKeyIgnoresAdditionalKeys(): void {
		$this->assertArrayKey([self::KEY => self::INT, 'key2' => self::STRING], self::KEY, self::INT);
	}

	#[Test]
	public function assertArrayKeyWithEmptyArray(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertArrayKey([], 'key', null);
	}

	#[Test]
	public function assertArrayKeyFailsIfValueIsDifferent(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertArrayKey([self::KEY => self::INT], self::KEY, self::STRING);
	}

	#[Test]
	public function assertArrayKeyFailsIfKeyIsMissing(): void {
		$this->expectException(ExpectationFailedException::class);

		$this->assertArrayKey([self::KEY => self::INT], 'key2', self::INT);
	}
}

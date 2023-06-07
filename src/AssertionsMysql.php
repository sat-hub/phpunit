<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit;

use PHPUnit\Framework\Assert;

trait AssertionsMysql
{
	use Assertions;
	use DatabaseMysql;

	public static function assertTableExists(string $table): void {
		$statement = self::$connection->query("SHOW TABLES LIKE '" . $table . "'");
		$rows      = $statement ? $statement->fetchAll(\PDO::FETCH_COLUMN) : null;

		Assert::assertInstanceOf(\PDOStatement::class, $statement, 'Could not look up table ' . $table . '.');
		Assert::assertIsArray($rows, 'Error looking up table ' . $table . '.');

		$n = count($rows);
		switch ($n) {
			case 1 :
				Assert::assertArrayHasKey(0, $rows, 'Error fetching row of table status for ' . $table . '.');
				Assert::assertSame($table, $rows[0], 'Error fetching row of table status for ' . $table . '.');
				break;
			case 0 :
				Assert::fail('Expected that table ' . $table . ' exists, but it does not.');
			default :
				Assert::fail('Error looking up table ' . $table . '.');
		}
	}

	public static function assertRows(int $expected, string $table): void {
		self::assertTableExists($table);

		$n = self::countRows($table);

		Assert::assertSame($expected, $n, 'Table ' . $table . ' has ' . $n . ' rows, but ' . $expected . ' were expected.');
	}

	protected static function countRows(string $table): int {
		$statement = self::$connection->query('SELECT COUNT(*) FROM ' . $table);
		$rows      = $statement ? $statement->fetchAll(\PDO::FETCH_COLUMN) : null;

		Assert::assertInstanceOf(\PDOStatement::class, $statement, 'Could not fetch row count of table ' . $table . '.');
		Assert::assertIsArray($rows, 'Error fetching row count of table ' . $table . '.');
		Assert::assertArrayHasKey(0, $rows, 'Error fetching row count of table ' . $table . '.');

		$count = (int)$rows[0];

		Assert::assertGreaterThanOrEqual(0, $count, 'Invalid row count of table ' . $table . '.');

		return $count;
	}

	protected function executeMysqlDump(string $path): void {
		$fileName = basename($path);
		Assert::assertFileExists($path, 'Database dump file ' . $fileName . ' does not exist.');

		/** @var resource $file */
		$file = fopen($path, 'r');
		Assert::assertIsResource($file, 'Could not open dump file ' . $fileName);

		require_once __DIR__ . '/Functions.php';
		$command = '';
		while (!feof($file)) {
			$line = trim((string)fgets($file));
			if (!$line || str_starts_with($line, '--')) {
				continue;
			}
			$command .= $line;
			if (str_ends_with($line, ';')) {
				if (str_starts_with($command, 'CREATE') || str_starts_with($command, 'DROP') || str_starts_with($command, 'INSERT')) {
					Assert::assertNotFalse(self::$connection->exec($command), 'Could not execute ' . $command . '.');
				}
				$command = '';
			}
		}

		Assert::assertEmpty($command, 'Last command is open: ' . $command);
	}
}

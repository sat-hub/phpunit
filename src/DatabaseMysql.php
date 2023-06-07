<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit;

use PHPUnit\Framework\Attributes\Before;

use SATHub\PHPUnit\Exception\DatabaseException;

trait DatabaseMysql
{
	protected bool $initDatabaseOnSetup = true;

	private static bool $isDatabaseChecked = false;

	private bool $isDatabaseAvailable = false;

	private static \PDO $connection;

	/**
	 * @throws \PDOException
	 */
	#[Before]
	public function initDatabaseOnSetup(): void {
		if (!self::$isDatabaseChecked) {
			try {
				self::$connection = $this->getConnection();

				if ($this->initDatabaseOnSetup) {
					$this->initDatabaseTables();
				}

				$this->isDatabaseAvailable = true;
			} catch (\PDOException $e) {
				if (!in_array($e->getCode(), [1044, 2002])) {
					throw $e;
				}
			}
			self::$isDatabaseChecked = true;
		}
	}

	/**
	 * @throws \PDOException
	 */
	abstract protected function getConnection(): \PDO;

	abstract protected function initData(): void;

	protected function isDatabaseAvailable(): bool {
		return $this->isDatabaseAvailable;
	}

	/**
	 * @throws DatabaseException
	 */
	protected function initDatabaseTables(): void {
		if (self::$connection->exec('SET FOREIGN_KEY_CHECKS = 0') === false) {
			throw new DatabaseException('Could not disable foreign key checks.');
		}

		$this->dropAllTables();
		$this->initData();

		if (self::$connection->exec('SET FOREIGN_KEY_CHECKS = 1') === false) {
			throw new DatabaseException('Could not enable foreign key checks.');
		}
	}

	protected function dropAllTables(): void {
		$statement = self::$connection->query('SHOW TABLES');
		$tables    = $statement?->fetchAll(\PDO::FETCH_COLUMN);
		if (!$statement || !is_array($tables)) {
			throw new DatabaseException('Could not fetch tables.');
		}

		foreach ($tables as $table) {
			if (self::$connection->exec('DROP TABLE ' . $table) === false) {
				throw new DatabaseException('Could not drop table ' . $table . '.');
			}
		}
	}

	protected function executeMysqlDump(string $path): void {
		$fileName = basename($path);
		$this->assertFileExists($path, 'Database dump file ' . $fileName . ' does not exist.');

		/** @var resource $file */
		$file = fopen($path, 'r');
		$this->assertIsResource($file, 'Could not open dump file ' . $fileName);

		$command = '';
		while (!feof($file)) {
			$line = trim((string)fgets($file));
			if (!$line || str_starts_with($line, '--')) {
				continue;
			}
			$command .= $line;
			if (str_ends_with($line, ';')) {
				if (str_starts_with($command, 'CREATE') || str_starts_with($command, 'DROP') || str_starts_with($command, 'INSERT')) {
					$this->assertNotFalse(self::$connection->exec($command), 'Could not execute ' . $command . '.');
				}
				$command = '';
			}
		}

		$this->assertEmpty($command, 'Last command is open: ' . $command);
	}
}

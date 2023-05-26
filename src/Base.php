<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit;

use PHPUnit\Framework\TestCase;

abstract class Base extends TestCase
{
	use Assertions;
}

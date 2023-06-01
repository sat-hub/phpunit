<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit\Tests\Mock;

class PropertyObject extends Mock
{
	/**
	 * @var mixed
	 */
	public $property;

	public function __construct($property = null)
	{
		$this->property = $property;
	}
}

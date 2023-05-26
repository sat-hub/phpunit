<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit;

/**
 * Return the class name of an object without its namespace.
 */
function getClass(object|string $object): string {
	$class = is_object($object) ? $object::class : $object;
	$i     = strrpos($class, '\\');
	return $i > 0 ? substr($class, $i + 1) : $class;
}

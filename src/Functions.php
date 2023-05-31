<?php
declare(strict_types = 1);
namespace SATHub\PHPUnit;

/**
 * Return the class name of an object without its namespace.
 *
 * @param object|string $object
 */
function getClass($object): string {
	$class = is_object($object) ? get_class($object) : $object;
	$i     = strrpos($class, '\\');
	return $i > 0 ? substr($class, $i + 1) : $class;
}

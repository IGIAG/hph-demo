<?php
/**
 */

namespace php;

use \haxe\ds\StringMap;

/**
 * Platform-specific PHP Library. Provides some platform-specific functions
 * for the PHP target, such as conversion from Haxe types to native types
 * and vice-versa.
 */
class Lib {
	/**
	 * @param array $arr
	 * 
	 * @return StringMap
	 */
	public static function hashOfAssociativeArray ($arr) {
		#/usr/share/haxe/std/php/Lib.hx:102: characters 3-32
		$result = new StringMap();
		#/usr/share/haxe/std/php/Lib.hx:103: characters 19-36
		$result->data = $arr;
		#/usr/share/haxe/std/php/Lib.hx:104: characters 3-16
		return $result;
	}

	/**
	 * Print the specified value on the default output followed by
	 * a newline character.
	 * 
	 * @param mixed $v
	 * 
	 * @return void
	 */
	public static function println ($v) {
		#/usr/share/haxe/std/php/Lib.hx:47: characters 3-11
		echo(\Std::string($v));
		#/usr/share/haxe/std/php/Lib.hx:48: characters 3-14
		echo("\x0A");
	}
}

Boot::registerClass(Lib::class, 'php.Lib');

<?php
/**
 */

namespace haxe\_Int32;

use \php\Boot;

final class Int32_Impl_ {
	/**
	 * @var int
	 */
	static public $extraBits;

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function mul ($a, $b) {
		#/usr/share/haxe/std/haxe/Int32.hx:87: characters 3-95
		return (($a * ($b & 65535) + ((($a * (Boot::shiftRightUnsigned($b, 16))) << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
	}

	/**
	 * Compare `a` and `b` in unsigned mode.
	 * 
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function ucompare ($a, $b) {
		#/usr/share/haxe/std/haxe/Int32.hx:255: lines 255-256
		if ($a < 0) {
			#/usr/share/haxe/std/haxe/Int32.hx:256: characters 11-32
			if ($b < 0) {
				#/usr/share/haxe/std/haxe/Int32.hx:256: characters 19-28
				return ((((~$b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) - ((~$a << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
			} else {
				#/usr/share/haxe/std/haxe/Int32.hx:256: characters 31-32
				return 1;
			}
		}
		#/usr/share/haxe/std/haxe/Int32.hx:257: characters 10-30
		if ($b < 0) {
			#/usr/share/haxe/std/haxe/Int32.hx:257: characters 18-20
			return -1;
		} else {
			#/usr/share/haxe/std/haxe/Int32.hx:257: characters 23-30
			return (($a - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
	}

	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


		self::$extraBits = \PHP_INT_SIZE * 8 - 32;
	}
}

Boot::registerClass(Int32_Impl_::class, 'haxe._Int32.Int32_Impl_');
Int32_Impl_::__hx__init();

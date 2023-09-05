<?php
/**
 */

use \php\Boot;

/**
 * The Date class provides a basic structure for date and time related
 * information. Date instances can be created by
 * - `new Date()` for a specific date,
 * - `Date.now()` to obtain information about the current time,
 * - `Date.fromTime()` with a given timestamp or
 * - `Date.fromString()` by parsing from a String.
 * There are some extra functions available in the `DateTools` class.
 * In the context of Haxe dates, a timestamp is defined as the number of
 * milliseconds elapsed since 1st January 1970 UTC.
 * ## Supported range
 * Due to platform limitations, only dates in the range 1970 through 2038 are
 * supported consistently. Some targets may support dates outside this range,
 * depending on the OS at runtime. The `Date.fromTime` method will not work with
 * timestamps outside the range on any target.
 */
final class Date {
	/**
	 * @var float
	 */
	public $__t;

	/**
	 * @param float $t
	 * 
	 * @return Date
	 */
	public static function fromPhpTime ($t) {
		#/usr/share/haxe/std/php/_std/Date.hx:112: characters 3-41
		$d = new Date(2000, 1, 1, 0, 0, 0);
		#/usr/share/haxe/std/php/_std/Date.hx:113: characters 3-12
		$d->__t = $t;
		#/usr/share/haxe/std/php/_std/Date.hx:114: characters 3-11
		return $d;
	}

	/**
	 * Creates a Date from the timestamp (in milliseconds) `t`.
	 * 
	 * @param float $t
	 * 
	 * @return Date
	 */
	public static function fromTime ($t) {
		#/usr/share/haxe/std/php/_std/Date.hx:118: characters 3-41
		$d = new Date(2000, 1, 1, 0, 0, 0);
		#/usr/share/haxe/std/php/_std/Date.hx:119: characters 3-19
		$d->__t = $t / 1000;
		#/usr/share/haxe/std/php/_std/Date.hx:120: characters 3-11
		return $d;
	}

	/**
	 * Returns a Date representing the current local time.
	 * 
	 * @return Date
	 */
	public static function now () {
		#/usr/share/haxe/std/php/_std/Date.hx:108: characters 3-48
		return Date::fromPhpTime(round(microtime(true), 3));
	}

	/**
	 * Creates a new date object from the given arguments.
	 * The behaviour of a Date instance is only consistent across platforms if
	 * the the arguments describe a valid date.
	 * - month: 0 to 11 (note that this is zero-based)
	 * - day: 1 to 31
	 * - hour: 0 to 23
	 * - min: 0 to 59
	 * - sec: 0 to 59
	 * 
	 * @param int $year
	 * @param int $month
	 * @param int $day
	 * @param int $hour
	 * @param int $min
	 * @param int $sec
	 * 
	 * @return void
	 */
	public function __construct ($year, $month, $day, $hour, $min, $sec) {
		#/usr/share/haxe/std/php/_std/Date.hx:30: characters 3-53
		$this->__t = mktime($hour, $min, $sec, $month + 1, $day, $year);
	}

	/**
	 * Returns the hours of `this` Date (0-23 range) in the local timezone.
	 * 
	 * @return int
	 */
	public function getHours () {
		#/usr/share/haxe/std/php/_std/Date.hx:55: characters 10-34
		return (int)(date("G", (int)($this->__t)));
	}

	/**
	 * Returns the minutes of `this` Date (0-59 range) in the local timezone.
	 * 
	 * @return int
	 */
	public function getMinutes () {
		#/usr/share/haxe/std/php/_std/Date.hx:59: characters 10-34
		return (int)(date("i", (int)($this->__t)));
	}

	/**
	 * Returns the seconds of `this` Date (0-59 range) in the local timezone.
	 * 
	 * @return int
	 */
	public function getSeconds () {
		#/usr/share/haxe/std/php/_std/Date.hx:63: characters 10-34
		return (int)(date("s", (int)($this->__t)));
	}

	/**
	 * Returns the timestamp (in milliseconds) of `this` date.
	 * On cpp and neko, this function only has a second resolution, so the
	 * result will always be a multiple of `1000.0`, e.g. `1454698271000.0`.
	 * To obtain the current timestamp with better precision on cpp and neko,
	 * see the `Sys.time` API.
	 * For measuring time differences with millisecond accuracy on
	 * all platforms, see `haxe.Timer.stamp`.
	 * 
	 * @return float
	 */
	public function getTime () {
		#/usr/share/haxe/std/php/_std/Date.hx:34: characters 3-22
		return $this->__t * 1000.0;
	}
}

Boot::registerClass(Date::class, 'Date');

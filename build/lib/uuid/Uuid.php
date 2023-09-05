<?php
/**
 */

namespace uuid;

use \haxe\_Int64\Int64_Impl_;
use \haxe\_Int64\___Int64;
use \php\Boot;
use \haxe\Exception;
use \haxe\Int64Helper;
use \haxe\_Int32\Int32_Impl_;

class Uuid {
	/**
	 * @var ___Int64
	 */
	static public $rndSeed;
	/**
	 * @var ___Int64
	 */
	static public $state0;
	/**
	 * @var ___Int64
	 */
	static public $state1;

	/**
	 * @param int $len
	 * @param string $alphabet
	 * @param \Closure $randomFunc
	 * 
	 * @return string
	 */
	public static function nanoId ($len = 21, $alphabet = "_-0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", $randomFunc = null) {
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:240: lines 240-259
		if ($len === null) {
			$len = 21;
		}
		if ($alphabet === null) {
			$alphabet = "_-0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		}
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:241: characters 3-52
		if ($randomFunc === null) {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:241: characters 29-52
			$randomFunc = Boot::getStaticClosure(Uuid::class, 'randomByte');
		}
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:242: characters 3-32
		if ($alphabet === null) {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:242: characters 27-32
			throw Exception::thrown("Alphabet cannot be null");
		}
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:243: characters 3-62
		if ((mb_strlen($alphabet) === 0) || (mb_strlen($alphabet) >= 256)) {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:243: characters 57-62
			throw Exception::thrown("Alphabet must contain between 1 and 255 symbols");
		}
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:244: characters 3-24
		if ($len <= 0) {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:244: characters 19-24
			throw Exception::thrown("Length must be greater than zero");
		}
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:245: characters 3-86
		$mask = (2 << (int)(\floor(\log(mb_strlen($alphabet) - 1) / \log(2)))) - 1;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:246: characters 3-65
		$step = (int)(\ceil(1.6 * $mask * $len / mb_strlen($alphabet)));
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:247: characters 3-28
		$sb = new \StringBuf();
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:248: lines 248-257
		while (mb_strlen($sb->b) !== $len) {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:249: characters 13-17
			$_g = 0;
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:249: characters 17-21
			$_g1 = $step;
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:249: lines 249-256
			while ($_g < $_g1) {
				#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:249: characters 13-21
				$i = $_g++;
				#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:250: characters 5-28
				$rnd = $randomFunc();
				#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:251: characters 5-33
				$aIndex = $rnd & $mask;
				#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:252: lines 252-255
				if ($aIndex < mb_strlen($alphabet)) {
					#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:253: characters 21-52
					$sb->add(($aIndex < 0 ? "" : \mb_substr($alphabet, $aIndex, 1)));
					#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:254: characters 21-48
					if (mb_strlen($sb->b) === $len) {
						#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:254: characters 43-48
						break;
					}
				}
			}
		}
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:258: characters 3-23
		return $sb->b;
	}

	/**
	 * @return int
	 */
	public static function randomByte () {
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:60: characters 3-33
		return Uuid::randomFromRange(0, 255);
	}

	/**
	 * @param int $min
	 * @param int $max
	 * 
	 * @return int
	 */
	public static function randomFromRange ($min, $max) {
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:49: characters 3-25
		$s1 = Uuid::$state0;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:50: characters 3-25
		$s0 = Uuid::$state1;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:51: characters 3-9
		Uuid::$state0 = $s0;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:52: characters 9-17
		$b = 23;
		$b &= 63;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:52: characters 3-17
		$b1 = null;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:52: characters 9-17
		if ($b === 0) {
			$this1 = new ___Int64($s1->high, $s1->low);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:52: characters 3-17
			$b1 = $this1;
		} else if ($b < 32) {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:52: characters 9-17
			$this1 = new ___Int64((((($s1->high << $b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) | Boot::shiftRightUnsigned($s1->low, (32 - $b))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, ($s1->low << $b << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:52: characters 3-17
			$b1 = $this1;
		} else {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:52: characters 9-17
			$this1 = new ___Int64(($s1->low << ($b - 32) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, 0);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:52: characters 3-17
			$b1 = $this1;
		}
		$this1 = new ___Int64((($s1->high ^ $b1->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, (($s1->low ^ $b1->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
		$s1 = $this1;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 12-19
		$a_high = (($s1->high ^ $s0->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		$a_low = (($s1->low ^ $s0->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 23-32
		$b = 18;
		$b &= 63;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 12-33
		$b1 = null;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 23-32
		if ($b === 0) {
			$this1 = new ___Int64($s1->high, $s1->low);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 12-33
			$b1 = $this1;
		} else if ($b < 32) {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 23-32
			$this1 = new ___Int64(Boot::shiftRightUnsigned($s1->high, $b), (((($s1->high << (32 - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) | Boot::shiftRightUnsigned($s1->low, $b)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 12-33
			$b1 = $this1;
		} else {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 23-32
			$this1 = new ___Int64(0, Boot::shiftRightUnsigned($s1->high, ($b - 32)));
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 12-33
			$b1 = $this1;
		}
		$a_high1 = (($a_high ^ $b1->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		$a_low1 = (($a_low ^ $b1->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 37-45
		$b = 5;
		$b &= 63;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 12-46
		$b1 = null;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 37-45
		if ($b === 0) {
			$this1 = new ___Int64($s0->high, $s0->low);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 12-46
			$b1 = $this1;
		} else if ($b < 32) {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 37-45
			$this1 = new ___Int64(Boot::shiftRightUnsigned($s0->high, $b), (((($s0->high << (32 - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) | Boot::shiftRightUnsigned($s0->low, $b)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 12-46
			$b1 = $this1;
		} else {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 37-45
			$this1 = new ___Int64(0, Boot::shiftRightUnsigned($s0->high, ($b - 32)));
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 12-46
			$b1 = $this1;
		}
		$this1 = new ___Int64((($a_high1 ^ $b1->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, (($a_low1 ^ $b1->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:53: characters 3-9
		Uuid::$state1 = $this1;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:54: characters 22-33
		$a = Uuid::$state1;
		$high = (($a->high + $s0->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		$low = (($a->low + $s0->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if (Int32_Impl_::ucompare($low, $a->low) < 0) {
			$ret = $high++;
			#/usr/share/haxe/std/haxe/Int64.hx:264: characters 4-8
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:54: characters 22-33
		$this1 = new ___Int64($high, $low);
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:54: characters 21-52
		$x = $max - $min + 1;
		$this2 = new ___Int64($x >> 31, $x);
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:54: characters 3-58
		$result = Int64_Impl_::divMod($this1, $this2)->modulus->low;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:55: characters 12-43
		if ($result < 0) {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:55: characters 27-34
			$result = -$result;
		}
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:56: characters 3-22
		return $result + $min;
	}

	/**
	 * @param ___Int64 $index
	 * 
	 * @return ___Int64
	 */
	public static function splitmix64_seed ($index) {
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:42: characters 31-65
		$b_high = -1640531527;
		$b_low = 2135587861;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:42: characters 23-65
		$high = (($index->high + $b_high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		$low = (($index->low + $b_low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if (Int32_Impl_::ucompare($low, $index->low) < 0) {
			$ret = $high++;
			#/usr/share/haxe/std/haxe/Int64.hx:264: characters 4-8
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:42: characters 23-65
		$this1 = new ___Int64($high, $low);
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:42: characters 3-67
		$result = $this1;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:43: characters 23-35
		$b = 30;
		$b &= 63;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:43: characters 13-36
		$b1 = null;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:43: characters 23-35
		if ($b === 0) {
			$this1 = new ___Int64($result->high, $result->low);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:43: characters 13-36
			$b1 = $this1;
		} else if ($b < 32) {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:43: characters 23-35
			$this1 = new ___Int64((($result->high >> $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, (((($result->high << (32 - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) | Boot::shiftRightUnsigned($result->low, $b)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:43: characters 13-36
			$b1 = $this1;
		} else {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:43: characters 23-35
			$this1 = new ___Int64((($result->high >> 31) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, (($result->high >> ($b - 32)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:43: characters 13-36
			$b1 = $this1;
		}
		$a_high = (($result->high ^ $b1->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		$a_low = (($result->low ^ $b1->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:43: characters 40-74
		$b_high = -1084733587;
		$b_low = 484763065;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:43: characters 12-74
		$mask = 65535;
		$al = $a_low & $mask;
		$ah = Boot::shiftRightUnsigned($a_low, 16);
		$bl = $b_low & $mask;
		$bh = Boot::shiftRightUnsigned($b_low, 16);
		$p00 = Int32_Impl_::mul($al, $bl);
		$p10 = Int32_Impl_::mul($ah, $bl);
		$p01 = Int32_Impl_::mul($al, $bh);
		$p11 = Int32_Impl_::mul($ah, $bh);
		$low = $p00;
		$high = ((((($p11 + (Boot::shiftRightUnsigned($p01, 16))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) + (Boot::shiftRightUnsigned($p10, 16))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/usr/share/haxe/std/haxe/Int64.hx:302: characters 3-6
		$p01 = ($p01 << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/usr/share/haxe/std/haxe/Int64.hx:303: characters 3-6
		$low = (($low + $p01) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:43: characters 12-74
		if (Int32_Impl_::ucompare($low, $p01) < 0) {
			$ret = $high++;
			#/usr/share/haxe/std/haxe/Int64.hx:305: characters 4-8
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/usr/share/haxe/std/haxe/Int64.hx:306: characters 3-6
		$p10 = ($p10 << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/usr/share/haxe/std/haxe/Int64.hx:307: characters 3-6
		$low = (($low + $p10) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:43: characters 12-74
		if (Int32_Impl_::ucompare($low, $p10) < 0) {
			$ret = $high++;
			#/usr/share/haxe/std/haxe/Int64.hx:309: characters 4-8
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:43: characters 12-74
		$high = (($high + (((Int32_Impl_::mul($a_low, $b_high) + Int32_Impl_::mul($a_high, $b_low)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		$this1 = new ___Int64($high, $low);
		$result = $this1;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:44: characters 23-35
		$b = 27;
		$b &= 63;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:44: characters 13-36
		$b1 = null;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:44: characters 23-35
		if ($b === 0) {
			$this1 = new ___Int64($result->high, $result->low);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:44: characters 13-36
			$b1 = $this1;
		} else if ($b < 32) {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:44: characters 23-35
			$this1 = new ___Int64((($result->high >> $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, (((($result->high << (32 - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) | Boot::shiftRightUnsigned($result->low, $b)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:44: characters 13-36
			$b1 = $this1;
		} else {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:44: characters 23-35
			$this1 = new ___Int64((($result->high >> 31) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, (($result->high >> ($b - 32)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:44: characters 13-36
			$b1 = $this1;
		}
		$a_high = (($result->high ^ $b1->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		$a_low = (($result->low ^ $b1->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:44: characters 40-74
		$b_high = -1798288965;
		$b_low = 321982955;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:44: characters 12-74
		$mask = 65535;
		$al = $a_low & $mask;
		$ah = Boot::shiftRightUnsigned($a_low, 16);
		$bl = $b_low & $mask;
		$bh = Boot::shiftRightUnsigned($b_low, 16);
		$p00 = Int32_Impl_::mul($al, $bl);
		$p10 = Int32_Impl_::mul($ah, $bl);
		$p01 = Int32_Impl_::mul($al, $bh);
		$p11 = Int32_Impl_::mul($ah, $bh);
		$low = $p00;
		$high = ((((($p11 + (Boot::shiftRightUnsigned($p01, 16))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) + (Boot::shiftRightUnsigned($p10, 16))) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/usr/share/haxe/std/haxe/Int64.hx:302: characters 3-6
		$p01 = ($p01 << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/usr/share/haxe/std/haxe/Int64.hx:303: characters 3-6
		$low = (($low + $p01) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:44: characters 12-74
		if (Int32_Impl_::ucompare($low, $p01) < 0) {
			$ret = $high++;
			#/usr/share/haxe/std/haxe/Int64.hx:305: characters 4-8
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/usr/share/haxe/std/haxe/Int64.hx:306: characters 3-6
		$p10 = ($p10 << 16 << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/usr/share/haxe/std/haxe/Int64.hx:307: characters 3-6
		$low = (($low + $p10) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:44: characters 12-74
		if (Int32_Impl_::ucompare($low, $p10) < 0) {
			$ret = $high++;
			#/usr/share/haxe/std/haxe/Int64.hx:309: characters 4-8
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		}
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:44: characters 12-74
		$high = (($high + (((Int32_Impl_::mul($a_low, $b_high) + Int32_Impl_::mul($a_high, $b_low)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		$this1 = new ___Int64($high, $low);
		$result = $this1;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:45: characters 20-32
		$b = 31;
		$b &= 63;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:45: characters 10-33
		$b1 = null;
		#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:45: characters 20-32
		if ($b === 0) {
			$this1 = new ___Int64($result->high, $result->low);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:45: characters 10-33
			$b1 = $this1;
		} else if ($b < 32) {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:45: characters 20-32
			$this1 = new ___Int64((($result->high >> $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, (((($result->high << (32 - $b) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits) | Boot::shiftRightUnsigned($result->low, $b)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:45: characters 10-33
			$b1 = $this1;
		} else {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:45: characters 20-32
			$this1 = new ___Int64((($result->high >> 31) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, (($result->high >> ($b - 32)) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:45: characters 10-33
			$b1 = $this1;
		}
		$this1 = new ___Int64((($result->high ^ $b1->high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits, (($result->low ^ $b1->low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits);
		return $this1;
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


		self::$rndSeed = Int64Helper::fromFloat(\microtime(true) * 1000);
		self::$state0 = Uuid::splitmix64_seed(Uuid::$rndSeed);
		$a = Uuid::$rndSeed;
		$x = \mt_rand(0, 9999);
		$b_high = $x >> 31;
		$b_low = $x;
		$high = (($a->high + $b_high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		$low = (($a->low + $b_low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if (Int32_Impl_::ucompare($low, $a->low) < 0) {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:38: characters 38-65
			$ret = $high++;
			#/usr/share/haxe/std/haxe/Int64.hx:264: characters 4-8
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		};
		$a_high = $high;
		$a_low = $low;
		$b_high = 0;
		$b_low = 1;
		$high = (($a_high + $b_high) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		$low = (($a_low + $b_low) << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		if (Int32_Impl_::ucompare($low, $a_low) < 0) {
			#/home/igiag/haxe-files/uuid/2,4,1/src/uuid/Uuid.hx:38: characters 38-69
			$ret = $high++;
			#/usr/share/haxe/std/haxe/Int64.hx:264: characters 4-8
			$high = ($high << Int32_Impl_::$extraBits) >> Int32_Impl_::$extraBits;
		};
		$this1 = new ___Int64($high, $low);
		self::$state1 = Uuid::splitmix64_seed($this1);
	}
}

Boot::registerClass(Uuid::class, 'uuid.Uuid');
Uuid::__hx__init();

<?php
/**
 */

namespace haxe\io;

use \php\_Boot\HxAnon;
use \php\Boot;
use \haxe\Exception;
use \php\_Boot\HxString;
use \haxe\exceptions\NotImplementedException;

/**
 * An Input is an abstract reader. See other classes in the `haxe.io` package
 * for several possible implementations.
 * All functions which read data throw `Eof` when the end of the stream
 * is reached.
 */
class Input {
	/**
	 * Read and return `nbytes` bytes.
	 * 
	 * @param int $nbytes
	 * 
	 * @return Bytes
	 */
	public function read ($nbytes) {
		#/usr/share/haxe/std/haxe/io/Input.hx:146: characters 3-31
		$s = Bytes::alloc($nbytes);
		#/usr/share/haxe/std/haxe/io/Input.hx:147: characters 3-13
		$p = 0;
		#/usr/share/haxe/std/haxe/io/Input.hx:148: lines 148-154
		while ($nbytes > 0) {
			#/usr/share/haxe/std/haxe/io/Input.hx:149: characters 4-36
			$k = $this->readBytes($s, $p, $nbytes);
			#/usr/share/haxe/std/haxe/io/Input.hx:150: lines 150-151
			if ($k === 0) {
				#/usr/share/haxe/std/haxe/io/Input.hx:151: characters 5-10
				throw Exception::thrown(Error::Blocked());
			}
			#/usr/share/haxe/std/haxe/io/Input.hx:152: characters 4-10
			$p += $k;
			#/usr/share/haxe/std/haxe/io/Input.hx:153: characters 4-15
			$nbytes -= $k;
		}
		#/usr/share/haxe/std/haxe/io/Input.hx:155: characters 3-11
		return $s;
	}

	/**
	 * Read and return one byte.
	 * 
	 * @return int
	 */
	public function readByte () {
		#/usr/share/haxe/std/haxe/io/Input.hx:53: characters 10-15
		throw new NotImplementedException(null, null, new _HxAnon_Input0("haxe/io/Input.hx", 53, "haxe.io.Input", "readByte"));
	}

	/**
	 * Read `len` bytes and write them into `s` to the position specified by `pos`.
	 * Returns the actual length of read data that can be smaller than `len`.
	 * See `readFullBytes` that tries to read the exact amount of specified bytes.
	 * 
	 * @param Bytes $s
	 * @param int $pos
	 * @param int $len
	 * 
	 * @return int
	 */
	public function readBytes ($s, $pos, $len) {
		#/usr/share/haxe/std/haxe/io/Input.hx:65: characters 3-15
		$k = $len;
		#/usr/share/haxe/std/haxe/io/Input.hx:66: characters 3-69
		$b = $s->b;
		#/usr/share/haxe/std/haxe/io/Input.hx:67: lines 67-68
		if (($pos < 0) || ($len < 0) || (($pos + $len) > $s->length)) {
			#/usr/share/haxe/std/haxe/io/Input.hx:68: characters 4-9
			throw Exception::thrown(Error::OutsideBounds());
		}
		#/usr/share/haxe/std/haxe/io/Input.hx:69: lines 69-83
		try {
			#/usr/share/haxe/std/haxe/io/Input.hx:70: lines 70-82
			while ($k > 0) {
				#/usr/share/haxe/std/haxe/io/Input.hx:74: characters 5-27
				$val = $this->readByte();
				$b->s[$pos] = \chr($val);
				#/usr/share/haxe/std/haxe/io/Input.hx:80: characters 5-10
				++$pos;
				#/usr/share/haxe/std/haxe/io/Input.hx:81: characters 5-8
				--$k;
			}
		} catch(\Throwable $_g) {
			#/usr/share/haxe/std/haxe/io/Input.hx:69: lines 69-83
			if (!(Exception::caught($_g)->unwrap() instanceof Eof)) {
				throw $_g;
			}
		}
		#/usr/share/haxe/std/haxe/io/Input.hx:84: characters 3-17
		return $len - $k;
	}

	/**
	 * Read a line of text separated by CR and/or LF bytes.
	 * The CR/LF characters are not included in the resulting string.
	 * 
	 * @return string
	 */
	public function readLine () {
		#/usr/share/haxe/std/haxe/io/Input.hx:177: characters 3-31
		$buf = new BytesBuffer();
		#/usr/share/haxe/std/haxe/io/Input.hx:178: characters 3-16
		$last = null;
		#/usr/share/haxe/std/haxe/io/Input.hx:179: characters 3-9
		$s = null;
		#/usr/share/haxe/std/haxe/io/Input.hx:180: lines 180-190
		try {
			#/usr/share/haxe/std/haxe/io/Input.hx:181: lines 181-182
			while (true) {
				#/usr/share/haxe/std/haxe/io/Input.hx:181: characters 11-30
				$last = $this->readByte();
				#/usr/share/haxe/std/haxe/io/Input.hx:181: lines 181-182
				if (!($last !== 10)) {
					break;
				}
				#/usr/share/haxe/std/haxe/io/Input.hx:182: characters 5-22
				$buf->b = ($buf->b . \chr($last));
			}
			#/usr/share/haxe/std/haxe/io/Input.hx:183: characters 4-33
			$s = $buf->getBytes()->toString();
			#/usr/share/haxe/std/haxe/io/Input.hx:184: lines 184-185
			if (HxString::charCodeAt($s, mb_strlen($s) - 1) === 13) {
				#/usr/share/haxe/std/haxe/io/Input.hx:185: characters 5-24
				$s = \mb_substr($s, 0, -1);
			}
		} catch(\Throwable $_g) {
			#/usr/share/haxe/std/haxe/io/Input.hx:186: characters 12-13
			$_g1 = Exception::caught($_g)->unwrap();
			#/usr/share/haxe/std/haxe/io/Input.hx:180: lines 180-190
			if (($_g1 instanceof Eof)) {
				#/usr/share/haxe/std/haxe/io/Input.hx:186: characters 12-13
				$e = $_g1;
				#/usr/share/haxe/std/haxe/io/Input.hx:187: characters 4-33
				$s = $buf->getBytes()->toString();
				#/usr/share/haxe/std/haxe/io/Input.hx:188: lines 188-189
				if (mb_strlen($s) === 0) {
					#/usr/share/haxe/std/haxe/io/Input.hx:189: characters 37-42
					throw Exception::thrown($e);
				}
			} else {
				#/usr/share/haxe/std/haxe/io/Input.hx:180: lines 180-190
				throw $_g;
			}
		}
		#/usr/share/haxe/std/haxe/io/Input.hx:191: characters 3-11
		return $s;
	}
}

class _HxAnon_Input0 extends HxAnon {
	function __construct($fileName, $lineNumber, $className, $methodName) {
		$this->fileName = $fileName;
		$this->lineNumber = $lineNumber;
		$this->className = $className;
		$this->methodName = $methodName;
	}
}

Boot::registerClass(Input::class, 'haxe.io.Input');

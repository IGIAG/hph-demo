<?php
/**
 */

namespace php;

use \haxe\io\_BytesData\Container;
use \haxe\Exception;
use \php\_Boot\HxString;
use \haxe\ds\StringMap;
use \haxe\io\Bytes;

/**
 * This class is used for accessing the local Web server and the current
 * client request and information.
 */
class Web {
	/**
	 * @var bool
	 */
	static public $isModNeko;

	/**
	 * Returns an hashtable of all Cookies sent by the client.
	 * Modifying the hashtable will not modify the cookie, use `php.Web.setCookie()`
	 * instead.
	 * 
	 * @return StringMap
	 */
	public static function getCookies () {
		#/usr/share/haxe/std/php/Web.hx:338: characters 3-45
		return Lib::hashOfAssociativeArray($_COOKIE);
	}

	/**
	 * Get the HTTP method used by the client.
	 * 
	 * @return string
	 */
	public static function getMethod () {
		#/usr/share/haxe/std/php/Web.hx:471: lines 471-474
		if (isset($_SERVER["REQUEST_METHOD"])) {
			#/usr/share/haxe/std/php/Web.hx:472: characters 11-36
			return $_SERVER["REQUEST_METHOD"];
		} else {
			#/usr/share/haxe/std/php/Web.hx:474: characters 4-15
			return null;
		}
	}

	/**
	 * Get the multipart parameters as an hashtable. The data
	 * cannot exceed the maximum size specified.
	 * 
	 * @param int $maxSize
	 * 
	 * @return StringMap
	 */
	public static function getMultipart ($maxSize) {
		#/usr/share/haxe/std/php/Web.hx:378: characters 3-35
		$h = new StringMap();
		#/usr/share/haxe/std/php/Web.hx:379: characters 3-28
		$buf = null;
		#/usr/share/haxe/std/php/Web.hx:380: characters 3-22
		$curname = null;
		#/usr/share/haxe/std/php/Web.hx:381: lines 381-394
		Web::parseMultipart(function ($p, $_) use (&$buf, &$maxSize, &$curname, &$h) {
			#/usr/share/haxe/std/php/Web.hx:382: lines 382-383
			if ($curname !== null) {
				#/usr/share/haxe/std/php/Web.hx:383: characters 5-35
				$h->data[$curname] = $buf->b;
			}
			#/usr/share/haxe/std/php/Web.hx:384: characters 4-15
			$curname = $p;
			#/usr/share/haxe/std/php/Web.hx:385: characters 4-25
			$buf = new \StringBuf();
			#/usr/share/haxe/std/php/Web.hx:386: characters 4-31
			$maxSize = $maxSize - \strlen($p);
			#/usr/share/haxe/std/php/Web.hx:387: lines 387-388
			if ($maxSize < 0) {
				#/usr/share/haxe/std/php/Web.hx:388: characters 5-10
				throw Exception::thrown("Maximum size reached");
			}
		}, function ($str, $pos, $len) use (&$buf, &$maxSize) {
			#/usr/share/haxe/std/php/Web.hx:390: characters 4-18
			$maxSize -= $len;
			#/usr/share/haxe/std/php/Web.hx:391: lines 391-392
			if ($maxSize < 0) {
				#/usr/share/haxe/std/php/Web.hx:392: characters 5-10
				throw Exception::thrown("Maximum size reached");
			}
			#/usr/share/haxe/std/php/Web.hx:393: characters 4-40
			$s = $str->toString();
			#/usr/share/haxe/std/php/Web.hx:393: characters 4-7
			$buf1 = $buf;
			#/usr/share/haxe/std/php/Web.hx:393: characters 4-40
			$buf1->b = ($buf1->b??'null') . (\mb_substr($s, $pos, $len)??'null');
		});
		#/usr/share/haxe/std/php/Web.hx:395: lines 395-396
		if ($curname !== null) {
			#/usr/share/haxe/std/php/Web.hx:396: characters 4-34
			$h->data[$curname] = $buf->b;
		}
		#/usr/share/haxe/std/php/Web.hx:397: characters 3-11
		return $h;
	}

	/**
	 * Returns the original request URL (before any server internal redirections).
	 * 
	 * @return string
	 */
	public static function getURI () {
		#/usr/share/haxe/std/php/Web.hx:115: characters 3-41
		$s = $_SERVER["REQUEST_URI"];
		#/usr/share/haxe/std/php/Web.hx:116: characters 3-25
		return (HxString::split($s, "?")->arr[0] ?? null);
	}

	/**
	 * Parse the multipart data. Call `onPart` when a new part is found
	 * with the part name and the filename if present
	 * and `onData` when some part data is readed. You can this way
	 * directly save the data on hard drive in the case of a file upload.
	 * 
	 * @param \Closure $onPart
	 * @param \Closure $onData
	 * 
	 * @return void
	 */
	public static function parseMultipart ($onPart, $onData) {
		#/usr/share/haxe/std/php/Web.hx:407: lines 407-410
		$collection = $_POST;
		foreach ($collection as $key => $value) {
			$value1 = $value;
			#/usr/share/haxe/std/php/Web.hx:408: characters 4-19
			$onPart($key, "");
			#/usr/share/haxe/std/php/Web.hx:409: characters 4-10
			$onData1 = $onData;
			#/usr/share/haxe/std/php/Web.hx:409: characters 11-32
			$s = $value1;
			$tmp = \strlen($s);
			#/usr/share/haxe/std/php/Web.hx:409: characters 4-51
			$onData1(new Bytes($tmp, new Container($s)), 0, \strlen($value1));
		}
		#/usr/share/haxe/std/php/Web.hx:412: lines 412-413
		if (!isset($_FILES)) {
			#/usr/share/haxe/std/php/Web.hx:413: characters 4-10
			return;
		}
		#/usr/share/haxe/std/php/Web.hx:414: lines 414-456
		$collection = $_FILES;
		foreach ($collection as $key => $value) {
			unset($part);
			$part = $key;
			#/usr/share/haxe/std/php/Web.hx:415: lines 415-448
			$handleFile = function ($tmp, $file, $err) use (&$onData, &$part, &$onPart) {
				#/usr/share/haxe/std/php/Web.hx:416: characters 5-29
				$fileUploaded = true;
				#/usr/share/haxe/std/php/Web.hx:417: lines 417-434
				if ($err > 0) {
					#/usr/share/haxe/std/php/Web.hx:418: lines 418-433
					if ($err === 1) {
						#/usr/share/haxe/std/php/Web.hx:420: characters 8-13
						throw Exception::thrown("The uploaded file exceeds the max size of " . (\ini_get("upload_max_filesize")??'null'));
					} else if ($err === 2) {
						#/usr/share/haxe/std/php/Web.hx:422: characters 8-13
						throw Exception::thrown("The uploaded file exceeds the max file size directive specified in the HTML form (max is" . (\ini_get("post_max_size")??'null') . ")");
					} else if ($err === 3) {
						#/usr/share/haxe/std/php/Web.hx:424: characters 8-13
						throw Exception::thrown("The uploaded file was only partially uploaded");
					} else if ($err === 4) {
						#/usr/share/haxe/std/php/Web.hx:426: characters 8-20
						$fileUploaded = false;
					} else if ($err === 6) {
						#/usr/share/haxe/std/php/Web.hx:428: characters 8-13
						throw Exception::thrown("Missing a temporary folder");
					} else if ($err === 7) {
						#/usr/share/haxe/std/php/Web.hx:430: characters 8-13
						throw Exception::thrown("Failed to write file to disk");
					} else if ($err === 8) {
						#/usr/share/haxe/std/php/Web.hx:432: characters 8-13
						throw Exception::thrown("File upload stopped by extension");
					}
				}
				#/usr/share/haxe/std/php/Web.hx:435: lines 435-447
				if ($fileUploaded) {
					#/usr/share/haxe/std/php/Web.hx:436: characters 6-24
					$onPart($part, $file);
					#/usr/share/haxe/std/php/Web.hx:437: lines 437-446
					if ("" !== $file) {
						#/usr/share/haxe/std/php/Web.hx:438: characters 7-31
						$h = \fopen($tmp, "r");
						#/usr/share/haxe/std/php/Web.hx:439: characters 7-24
						$bsize = 8192;
						#/usr/share/haxe/std/php/Web.hx:440: lines 440-444
						while (!\feof($h)) {
							#/usr/share/haxe/std/php/Web.hx:441: characters 8-41
							$buf = \fread($h, $bsize);
							#/usr/share/haxe/std/php/Web.hx:442: characters 8-35
							$size = \strlen($buf);
							#/usr/share/haxe/std/php/Web.hx:443: characters 8-14
							$onData1 = $onData;
							#/usr/share/haxe/std/php/Web.hx:443: characters 15-34
							$handleFile = \strlen($buf);
							#/usr/share/haxe/std/php/Web.hx:443: characters 8-44
							$onData1(new Bytes($handleFile, new Container($buf)), 0, $size);
						}
						#/usr/share/haxe/std/php/Web.hx:445: characters 7-16
						\fclose($h);
					}
				}
			};
			#/usr/share/haxe/std/php/Web.hx:449: lines 449-455
			if (\is_array($value["name"])) {
				#/usr/share/haxe/std/php/Web.hx:450: characters 19-43
				$data = \array_keys($value["name"]);
				$_g_current = 0;
				$_g_length = \count($data);
				$_g_data = $data;
				#/usr/share/haxe/std/php/Web.hx:450: lines 450-452
				while ($_g_current < $_g_length) {
					$index = $_g_data[$_g_current++];
					#/usr/share/haxe/std/php/Web.hx:451: characters 6-84
					$handleFile($value["tmp_name"][$index], $value["name"][$index], $value["error"][$index]);
				}
			} else {
				#/usr/share/haxe/std/php/Web.hx:454: characters 5-62
				$handleFile($value["tmp_name"], $value["name"], $value["error"]);
			}
		}
	}

	/**
	 * Tell the client to redirect to the given url ("Location" header).
	 * 
	 * @param string $url
	 * 
	 * @return void
	 */
	public static function redirect ($url) {
		#/usr/share/haxe/std/php/Web.hx:123: characters 3-29
		\header("Location: " . ($url??'null'));
	}

	/**
	 * Set a Cookie value in the HTTP headers. Same remark as `php.Web.setHeader()`.
	 * 
	 * @param string $key
	 * @param string $value
	 * @param \Date $expire
	 * @param string $domain
	 * @param string $path
	 * @param bool $secure
	 * @param bool $httpOnly
	 * 
	 * @return void
	 */
	public static function setCookie ($key, $value, $expire = null, $domain = null, $path = null, $secure = null, $httpOnly = null) {
		#/usr/share/haxe/std/php/Web.hx:345: characters 3-67
		$t = ($expire === null ? 0 : (int)(($expire->getTime() / 1000.0)));
		#/usr/share/haxe/std/php/Web.hx:346: lines 346-347
		if ($path === null) {
			#/usr/share/haxe/std/php/Web.hx:347: characters 4-14
			$path = "/";
		}
		#/usr/share/haxe/std/php/Web.hx:348: lines 348-349
		if ($domain === null) {
			#/usr/share/haxe/std/php/Web.hx:349: characters 4-15
			$domain = "";
		}
		#/usr/share/haxe/std/php/Web.hx:350: lines 350-351
		if ($secure === null) {
			#/usr/share/haxe/std/php/Web.hx:351: characters 4-18
			$secure = false;
		}
		#/usr/share/haxe/std/php/Web.hx:352: lines 352-353
		if ($httpOnly === null) {
			#/usr/share/haxe/std/php/Web.hx:353: characters 4-20
			$httpOnly = false;
		}
		#/usr/share/haxe/std/php/Web.hx:354: characters 3-59
		\setcookie($key, $value, $t, $path, $domain, $secure, $httpOnly);
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

		#/usr/share/haxe/std/php/Web.hx:480: characters 3-27
		Web::$isModNeko = 0 !== \strncasecmp(\PHP_SAPI, "cli", 3);

	}
}

Boot::registerClass(Web::class, 'php.Web');
Web::__hx__init();

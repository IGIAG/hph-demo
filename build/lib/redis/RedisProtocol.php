<?php
/**
 */

namespace redis;

use \php\Boot;
use \haxe\Exception;
use \haxe\io\Output;
use \haxe\io\Input;

class RedisProtocol {
	/**
	 * @var string
	 */
	static public $EOL = "\x0D\x0A";

	/**
	 * @var Input
	 */
	public $input;
	/**
	 * @var Output
	 */
	public $output;

	/**
	 * @param Input $input
	 * @param Output $output
	 * 
	 * @return void
	 */
	public function __construct ($input, $output) {
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:42: characters 9-27
		$this->input = $input;
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:43: characters 9-29
		$this->output = $output;
	}

	/**
	 * @return string
	 */
	public function receiveBulk () {
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:72: characters 9-37
		$line = $this->input->readLine();
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:73: lines 73-74
		if (\mb_substr($line, 0, 1) === "-") {
			#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:74: characters 13-18
			throw Exception::thrown(new RedisError($line));
		}
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:76: characters 9-48
		$len = \Std::parseInt(\mb_substr($line, 1, null));
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:77: lines 77-78
		if ($len === -1) {
			#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:78: characters 13-24
			return null;
		}
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:80: characters 9-46
		$ret = $this->input->read($len)->toString();
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:81: lines 81-82
		if (mb_strlen($ret) !== $len) {
			#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:82: characters 13-18
			throw Exception::thrown(new RedisError("-ERR response length mismatch"));
		}
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:83: characters 9-22
		$this->input->read(2);
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:85: characters 9-19
		return $ret;
	}

	/**
	 * @return int
	 */
	public function receiveInt () {
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:108: characters 9-37
		$line = $this->input->readLine();
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:109: lines 109-110
		if (\mb_substr($line, 0, 1) === "-") {
			#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:110: characters 13-18
			throw Exception::thrown(new RedisError($line));
		}
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:112: characters 9-44
		return \Std::parseInt(\mb_substr($line, 1, null));
	}

	/**
	 * @return string
	 */
	public function receiveSingleLine () {
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:63: characters 9-37
		$line = $this->input->readLine();
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:64: lines 64-65
		if (\mb_substr($line, 0, 1) === "-") {
			#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:65: characters 13-18
			throw Exception::thrown(new RedisError($line));
		}
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:67: characters 16-30
		return \mb_substr($line, 1, null);
	}

	/**
	 * @param string $arg
	 * 
	 * @return string
	 */
	public function sendBulkArg ($arg) {
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:48: characters 9-50
		return "\$" . (mb_strlen($arg)??'null') . (RedisProtocol::$EOL??'null') . ($arg??'null') . (RedisProtocol::$EOL??'null');
	}

	/**
	 * @param string $cmd
	 * @param string[]|\Array_hx $args
	 * 
	 * @return void
	 */
	public function sendMultiBulkCommand ($cmd, $args) {
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:53: characters 9-34
		$sb = new \StringBuf();
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:54: characters 9-44
		$sb->add("*" . ($args->length + 1) . (RedisProtocol::$EOL??'null'));
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:55: characters 9-33
		$sb->add($this->sendBulkArg($cmd));
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:56: lines 56-57
		$_g = 0;
		while ($_g < $args->length) {
			#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:56: characters 14-16
			$ii = ($args->arr[$_g] ?? null);
			#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:56: lines 56-57
			++$_g;
			#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:57: characters 13-36
			$sb->add($this->sendBulkArg($ii));
		}
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisProtocol.hx:58: characters 9-42
		$this->output->writeString($sb->b);
	}
}

Boot::registerClass(RedisProtocol::class, 'redis.RedisProtocol');

<?php
/**
 */

namespace redis;

use \php\Boot;
use \sys\net\Socket;
use \haxe\Exception;
use \sys\net\Host;

class Redis {
	/**
	 * @var RedisProtocol
	 */
	public $protocol;
	/**
	 * @var Socket
	 */
	public $socket;

	/**
	 * @param string $host
	 * @param int $port
	 * @param float $timeout
	 * 
	 * @return void
	 */
	public function __construct ($host = "localhost", $port = 6379, $timeout = 100) {
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:58: lines 58-68
		if ($host === null) {
			$host = "localhost";
		}
		if ($port === null) {
			$port = 6379;
		}
		if ($timeout === null) {
			$timeout = 100;
		}
		try {
			#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:60: characters 4-25
			$this->socket = new Socket();
			#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:61: characters 4-30
			$this->socket->setTimeout($timeout);
			#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:62: characters 4-40
			$this->socket->connect(new Host($host), $port);
			#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:63: characters 4-61
			$this->protocol = new RedisProtocol($this->socket->input, $this->socket->output);
		} catch(\Throwable $_g) {
			#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:58: lines 58-68
			if (is_string(Exception::caught($_g)->unwrap())) {
				#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:67: characters 4-9
				throw Exception::thrown(new RedisError("-ERR unable to open connection"));
			} else {
				#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:58: lines 58-68
				throw $_g;
			}
		}
	}

	/**
	 * @param string $key
	 * 
	 * @return bool
	 */
	public function exists ($key) {
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:86: characters 3-49
		$this->protocol->sendMultiBulkCommand("EXISTS", \Array_hx::wrap([$key]));
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:87: characters 3-36
		return $this->protocol->receiveInt() === 1;
	}

	/**
	 * @param string $key
	 * 
	 * @return string
	 */
	public function get ($key) {
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:215: characters 3-46
		$this->protocol->sendMultiBulkCommand("GET", \Array_hx::wrap([$key]));
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:216: characters 3-32
		return $this->protocol->receiveBulk();
	}

	/**
	 * @param string $key
	 * 
	 * @return int
	 */
	public function incr ($key) {
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:238: characters 3-47
		$this->protocol->sendMultiBulkCommand("INCR", \Array_hx::wrap([$key]));
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:239: characters 3-31
		return $this->protocol->receiveInt();
	}

	/**
	 * @param string $key
	 * @param string $value
	 * 
	 * @return bool
	 */
	public function set ($key, $value) {
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:293: characters 3-53
		$this->protocol->sendMultiBulkCommand("SET", \Array_hx::wrap([
			$key,
			$value,
		]));
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/Redis.hx:294: characters 3-44
		return $this->protocol->receiveSingleLine() === "OK";
	}
}

Boot::registerClass(Redis::class, 'redis.Redis');

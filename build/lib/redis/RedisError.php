<?php
/**
 */

namespace redis;

use \php\Boot;

class RedisError {
	/**
	 * @var string
	 */
	public $msg;

	/**
	 * @param string $str
	 * 
	 * @return void
	 */
	public function __construct ($str) {
		#/home/igiag/haxe-files/hxneko-redis/3,0,1/redis/RedisError.hx:37: characters 9-28
		$this->msg = \mb_substr($str, 5, null);
	}
}

Boot::registerClass(RedisError::class, 'redis.RedisError');

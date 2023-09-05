<?php
/**
 */

use \php\Boot;
use \redis\Redis;

class StatisticsMiddleware implements \IMiddleware {
	/**
	 * @return void
	 */
	public function __construct () {
	}

	/**
	 * @param string $input
	 * @param string[]|\Array_hx $params
	 * 
	 * @return string
	 */
	public function Output ($input, $params) {
		#src/Middlewares/StatisticsMiddleware.hx:9: characters 9-41
		$db = new Redis("localhost");
		#src/Middlewares/StatisticsMiddleware.hx:11: characters 9-25
		$db->incr("views");
		#src/Middlewares/StatisticsMiddleware.hx:13: characters 3-15
		return $input;
	}
}

Boot::registerClass(StatisticsMiddleware::class, 'StatisticsMiddleware');

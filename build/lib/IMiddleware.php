<?php
/**
 */

use \php\Boot;

interface IMiddleware {
	/**
	 * @param string $input
	 * @param string[]|\Array_hx $params
	 * 
	 * @return string
	 */
	public function Output ($input, $params) ;
}

Boot::registerClass(IMiddleware::class, 'IMiddleware');

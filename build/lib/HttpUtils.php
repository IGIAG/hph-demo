<?php
/**
 */

use \php\Boot;
use \php\Web;

class HttpUtils {
	/**
	 * @param string[]|\Array_hx $fieldNames
	 * 
	 * @return bool
	 */
	public static function VerifyFields ($fieldNames) {
		#src/HttpUtils.hx:5: lines 5-9
		$_g = 0;
		while ($_g < $fieldNames->length) {
			#src/HttpUtils.hx:5: characters 14-19
			$field = ($fieldNames->arr[$_g] ?? null);
			#src/HttpUtils.hx:5: lines 5-9
			++$_g;
			#src/HttpUtils.hx:6: lines 6-8
			if (!array_key_exists($field, Web::getMultipart(999)->data)) {
				#src/HttpUtils.hx:7: characters 17-29
				return false;
			}
		}
		#src/HttpUtils.hx:10: characters 9-20
		return true;
	}
}

Boot::registerClass(HttpUtils::class, 'HttpUtils');

<?php
/**
 */

use \php\Boot;
use \php\_Boot\HxString;
use \haxe\ds\StringMap;

class VariablesMiddleware implements \IMiddleware {
	/**
	 * @var StringMap
	 */
	public $Variables;

	/**
	 * @return void
	 */
	public function __construct () {
		#src/Middlewares/VariablesMiddleware.hx:2: characters 48-50
		$this->Variables = new StringMap();
	}

	/**
	 * @param string $name
	 * @param string $value
	 * 
	 * @return void
	 */
	public function AddVariable ($name, $value) {
		#src/Middlewares/VariablesMiddleware.hx:5: characters 9-34
		$this->Variables->data[$name] = $value;
	}

	/**
	 * @param string $input
	 * @param string[]|\Array_hx $params
	 * 
	 * @return string
	 */
	public function Output ($input, $params) {
		#src/Middlewares/VariablesMiddleware.hx:10: characters 9-53
		$input = $this->replacePlaceholders($input, $this->Variables);
		#src/Middlewares/VariablesMiddleware.hx:12: characters 9-21
		return $input;
	}

	/**
	 * @param string $input
	 * @param StringMap $values
	 * 
	 * @return string
	 */
	public function replacePlaceholders ($input, $values) {
		#src/Middlewares/VariablesMiddleware.hx:16: characters 21-34
		$data = array_values(array_map("strval", array_keys($values->data)));
		$key_current = 0;
		$key_length = count($data);
		$key_data = $data;
		while ($key_current < $key_length) {
			#src/Middlewares/VariablesMiddleware.hx:16: lines 16-23
			$key = $key_data[$key_current++];
			#src/Middlewares/VariablesMiddleware.hx:18: characters 13-42
			$placeholder = "@&" . ($key??'null');
			#src/Middlewares/VariablesMiddleware.hx:19: characters 13-47
			$replacement = ($values->data[$key] ?? null);
			#src/Middlewares/VariablesMiddleware.hx:20: characters 13-18
			$input = HxString::split($input, $placeholder)->join($replacement);
		}
		#src/Middlewares/VariablesMiddleware.hx:24: characters 9-21
		return $input;
	}
}

Boot::registerClass(VariablesMiddleware::class, 'VariablesMiddleware');

<?php
/**
 */

namespace sys\net;

use \sys\io\FileInput;
use \php\Boot;
use \haxe\Exception;
use \haxe\io\Output;
use \haxe\io\Error;
use \sys\io\FileOutput;
use \haxe\io\Input;

/**
 * A TCP socket class : allow you to both connect to a given server and exchange messages or start your own server and wait for connections.
 */
class Socket {
	/**
	 * @var mixed
	 */
	public $__s;
	/**
	 * @var Input
	 * The stream on which you can read available data. By default the stream is blocking until the requested data is available,
	 * use `setBlocking(false)` or `setTimeout` to prevent infinite waiting.
	 */
	public $input;
	/**
	 * @var Output
	 * The stream on which you can send data. Please note that in case the output buffer you will block while writing the data, use `setBlocking(false)` or `setTimeout` to prevent that.
	 */
	public $output;
	/**
	 * @var string
	 */
	public $protocol;
	/**
	 * @var mixed
	 */
	public $stream;

	/**
	 * @param bool $r
	 * @param int $code
	 * @param string $msg
	 * 
	 * @return void
	 */
	public static function checkError ($r, $code, $msg) {
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:150: lines 150-151
		if ($r !== false) {
			#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:151: characters 4-10
			return;
		}
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:152: characters 3-8
		throw Exception::thrown(Error::Custom("Error [" . ($code??'null') . "]: " . ($msg??'null')));
	}

	/**
	 * Creates a new unconnected socket.
	 * 
	 * @return void
	 */
	public function __construct () {
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:43: characters 3-53
		$this->input = new FileInput(null);
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:44: characters 3-55
		$this->output = new FileOutput(null);
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:45: characters 3-15
		$this->initSocket();
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:46: characters 3-19
		$this->protocol = "tcp";
	}

	/**
	 * @return void
	 */
	public function assignHandler () {
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:54: characters 3-37
		$this->stream = \socket_export_stream($this->__s);
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:55: characters 19-56
		$this->input->__f = $this->stream;
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:56: characters 19-58
		$this->output->__f = $this->stream;
	}

	/**
	 * Connect to the given server host/port. Throw an exception in case we couldn't successfully connect.
	 * 
	 * @param Host $host
	 * @param int $port
	 * 
	 * @return void
	 */
	public function connect ($host, $port) {
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:79: characters 3-48
		$r = \socket_connect($this->__s, $host->host, $port);
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:80: characters 3-40
		Socket::checkError($r, 0, "Unable to connect");
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:81: characters 3-18
		$this->assignHandler();
	}

	/**
	 * @return void
	 */
	public function initSocket () {
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:50: characters 3-53
		$this->__s = \socket_create(\AF_INET, \SOCK_STREAM, \SOL_TCP);
	}

	/**
	 * Gives a timeout (in seconds) after which blocking socket operations (such as reading and writing) will abort and throw an exception.
	 * 
	 * @param float $timeout
	 * 
	 * @return void
	 */
	public function setTimeout ($timeout) {
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:126: characters 3-28
		$s = (int)($timeout);
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:127: characters 3-45
		$ms = (int)((($timeout - $s) * 1000000));
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:128: characters 3-75
		$timeOut = [
			"sec" => $s,
			"usec" => $ms,
		];
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:129: characters 3-68
		$r = \socket_set_option($this->__s, \SOL_SOCKET, \SO_RCVTIMEO, $timeOut);
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:130: characters 3-52
		Socket::checkError($r, 0, "Unable to set receive timeout");
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:131: characters 3-63
		$r = \socket_set_option($this->__s, \SOL_SOCKET, \SO_SNDTIMEO, $timeOut);
		#/usr/share/haxe/std/php/_std/sys/net/Socket.hx:132: characters 3-49
		Socket::checkError($r, 0, "Unable to set send timeout");
	}
}

Boot::registerClass(Socket::class, 'sys.net.Socket');

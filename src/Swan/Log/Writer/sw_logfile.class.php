<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 foldmethod=marker: */
// +---------------------------------------------------------------------------
// | SWAN [ $_SWANBR_SLOGAN_$ ]
// +---------------------------------------------------------------------------
// | Copyright $_SWANBR_COPYRIGHT_$
// +---------------------------------------------------------------------------
// | Version  $_SWANBR_VERSION_$
// +---------------------------------------------------------------------------
// | Licensed ( $_SWANBR_LICENSED_URL_$ )
// +---------------------------------------------------------------------------
// | $_SWANBR_WEB_DOMAIN_$
// +---------------------------------------------------------------------------
 
namespace swan\log\writer;
use \swan\log\writer\exception\sw_exception;

/**
+------------------------------------------------------------------------------
* sw_logsvr 
+------------------------------------------------------------------------------
* 
* @uses sw
* @uses _abstract
* @package 
* @version $_SWANBR_VERSION_$
* @copyright Copyleft
* @author $_SWANBR_AUTHOR_$ 
+------------------------------------------------------------------------------
*/
class sw_logfile extends sw_abstract
{
	// {{{ const
	
	/**
	 * 最大允许写入的字节数 
	 */
	const MAX_LENGTH = 4096;

	// }}}
	// {{{ members
	
	/**
	 * 日志的 ID 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $__log_id = null;

	/**
	 * 格式化日志对象 
	 * 
	 * @var \swan\log\format\sw_abstract
	 * @access protected
	 */
	protected $__formatter = null;

	// }}}
	// {{{ functions
	// {{{ public function __construct()
	
	/**
	 * __construct 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(array $options)
	{
		if (!isset($options['log_id']) || ($options['log_id'] && !is_int($options['log_id']))) {
			throw new sw_exception('key `log_id` error'); 		
		}		
		$this->__log_id = $options['log_id'];

		if (!isset($options['formatter'])) {
			$this->__formatter = \swan\log\sw_log::format_factory('simple');
		} else {
			if (!($options['formatter'] instanceof \swan\log\format\sw_abstract)) {
				throw new sw_exception('unknow object');		
			}
			$this->__formatter = $options['formatter'];
		}

		if (!isset($options['log_file']) ||
			!file_exists(dirname($options['log_file']))) {
			throw new sw_exception('unkonw log file.');
		}

		$this->__stream = fopen($options['log_file'], 'a+');
	}

	// }}}
	// {{{ protected function _write()
	
	/**
	 * 写入日志服务器上 
	 * 
	 * @param array $event 
	 * @access protected
	 * @return void
	 */
	protected function _write($event)
	{
		$message = $this->__formatter->format($event);	
		$msg_len = strlen($message);
		if (self::MAX_LENGTH < $msg_len) {
			$message = substr($message, 0, self::MAX_LENGTH);
			$msg_len = self::MAX_LENGTH;	
		}

		$log_pack = "$message";
		if ( false == fwrite($this->__stream, $log_pack)) {
			throw new sw_exception('write log fail.');	
		}
	}

	// }}}
	// {{{ public function shutdown()
	
	/**
	 * shutdown 
	 * 
	 * @access public
	 * @return void
	 */
	public function shutdown()
	{
		if (isset($this->__stream) && is_resource($this->__stream)) {
			fclose($this->__stream);	
		}

		$this->__stream = null;
	}

	// }}}
	// }}}	
}

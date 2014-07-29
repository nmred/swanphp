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
 
namespace Swan\Log;

/**
+------------------------------------------------------------------------------
* 日志模块 
+------------------------------------------------------------------------------
* 
* @package 
* @version $_SWANBR_VERSION_$
* @copyright Copyleft
* @author $_SWANBR_AUTHOR_$ 
+------------------------------------------------------------------------------
*/
class Log
{
	// {{{ members
	
	/**
	 * 日志写入方式对象 
	 * 
	 * @var array
	 * @access protected
	 */
	protected $writer = array();

	/**
	 * 日志级别 
	 * 
	 * @var array
	 * @access protected
	 */
	protected static $priorities = array(
		LOG_EMERG   => 'EMERG',
		LOG_ALERT   => 'ALERT',
		LOG_CRIT    => 'CRIT',
		LOG_ERR     => 'ERR',
		LOG_WARNING => 'WARNING',
		LOG_NOTICE  => 'NOTICE',
		LOG_INFO    => 'INFO',
		LOG_DEBUG   => 'DEBUG',	
	);

	// }}}
	// {{{ functions
	// {{{ public function log()
	
	/**
	 * log 
	 * 
	 * @access public
	 * @return void
	 */
	public function log($message, $level)
	{
		if (empty($this->writer)) {
            throw new Exception\RuntimeException('write objects are empty');
		}

		if (!array_key_exists($level, self::$priorities)) {
            throw new Exception\RuntimeException('write objects are empty');
		}

		// 默认的格式
		$space = ' ';
		$microtimeArray = explode($space, microtime());
		$timestamp = date('c') . $space . $microtimeArray[1] . substr($microtimeArray[0], 1);
		$event = array(
			'timestamp'     => $timestamp,
			'message'       => $message,
			'priority'      => $level,
			'priorityName' => self::$priorities[$level],
			'pid'           => posix_getpid()
		);

		// 写日志
		foreach ($this->writer as $writer) {
			$writer->write($event);
		}
	}

	// }}}		
	// {{{ public function addWriter()
	
	/**
	 * 添加日志输出方式 
	 * 
	 * @param \Swan\Log\Writer\WriterAbstract $writer 
	 * @access public
	 * @return void
	 */
	public function addWriter(\Swan\Log\Writer\WriterAbstract $writer)
	{
		$this->writer[] = $writer;
	}

	// }}}
	// {{{ public function delAllWriter()
	
	/**
	 * 清除所有的 writer 
	 * 
	 * @access public
	 * @return void
	 */
	public function delAllWriter()
	{
		$this->writer = array();		
	}

	// }}}
	// }}}
}

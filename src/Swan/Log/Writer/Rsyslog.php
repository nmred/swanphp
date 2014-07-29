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
 
namespace Swan\Log\Writer;

/**
+------------------------------------------------------------------------------
* rsyslog 
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
class Rsyslog extends WriterAbstract
{
	// {{{ const
	
	/**
	 * 最大允许写入的字节数 
	 */
	const MAX_LENGTH = 4096;

	// }}}
	// {{{ members

    /**
     * rsyslog default params 
     * 
     * @var array
     */
    protected $defaultParams = array(
        'logId' => 0,
        'host'  => '127.0.0.1',
        'port'  => '8888', 
        'self'  => 'localhost',
    );
	
	/**
	 * 日志的 ID 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $logId = null;

	/**
	 * 格式化日志对象 
	 * 
	 * @var \Swan\Log\Format\FormatAbstract
	 * @access protected
	 */
	protected $formatter = null;

	/**
	 * rsyslogd 的主机名 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $host = null;

	/**
	 * rsyslogd 的端口 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $port = null;

	/**
	 * self 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $self = null;

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
        foreach ($this->defaultParams as $key => $value) {
            if (isset($options[$key])) {
                $this->$key = $value; 
            } else {
                $this->$key = $this->defaultParams[$key];   
            }
        }

		if (!isset($options['formatter']) && is_null($this->formatter)) {
			$this->formatter = \Swan\Log\Format\Simple();
		} else {
			if (!($options['formatter'] instanceof \Swan\Log\Format\FormatAbstract)) {
				throw new Exception\InvalidArgumentException('unknow object');		
			}
			$this->formatter = $options['formatter'];
		}
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
		$message = $this->formatter->format($event);	
		$msgLen = strlen($message);
		if (self::MAX_LENGTH < $msgLen) {
			$message = substr($message, 0, self::MAX_LENGTH);
			$msgLen  = self::MAX_LENGTH;	
		}

		$this->stream = stream_socket_client("udp://{$this->host}:{$this->port}", $errno, $errstr, 1);
		if (!$this->stream) {
			throw new Exception\InvalidArgumentException('Fail to open logsvr udp port');			
		}
			
		$logTime = date('M d H:i:s');
		$pid = posix_getpid();

		$logPack = "<134>$logTime {$this->self} {$this->logId}[$pid]: $message";
		if ( false == fwrite($this->stream, $log_pack)) {
			throw new Exception\RuntimeException('write log fail.');	
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
		if (isset($this->stream) && is_resource($this->stream)) {
			fclose($this->stream);	
		}

		$this->stream = null;
	}

	// }}}
	// }}}	
}

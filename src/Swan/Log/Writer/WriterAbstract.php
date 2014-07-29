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
* Writer 
+------------------------------------------------------------------------------
* 
* @package 
* @version $_SWANBR_VERSION_$
* @copyright Copyleft
* @author $_SWANBR_AUTHOR_$ 
+------------------------------------------------------------------------------
*/
abstract class WriterAbstract
{
	// {{{ members
	
	/**
	 * 日志内容格式化对象 
	 * 
	 * @var \Swan\Log\Format\FormatAbstract
	 * @access protected
	 */
	protected $formatter = null;	

	// }}}	
	// {{{ functions
	// {{{ public function setFormatter()
	
	/**
	 * 设置格式化日志的对象 
	 * 
	 * @param \Swan\Log\Format\FormatAbstract $format 
	 * @access public
	 * @return void
	 */
	public function setFormatter(\Swan\Log\Format\FormatAbstract $format)
	{
		$this->formatter = $format;	
	}

	// }}}
	// {{{ public function write()
	
	/**
	 * 写入日志 
	 * 
	 * @param array $event 
	 * @access public
	 * @return void
	 */
	public function write($event)
	{
		$this->_write($event);	
	}

	// }}}
	// {{{ public function shutdown()
	
	/**
	 * 写完关闭处理句柄 
	 * 
	 * @access public
	 * @return void
	 */
	public function shutdown()
	{
		
	}

	// }}}
	// {{{ abstract protected function _write()
	
	/**
	 * 写入日志的具体实现 
	 * 
	 * @param array $event 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function _write($event);

	// }}}
	// }}}
}

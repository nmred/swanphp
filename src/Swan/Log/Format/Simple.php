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

namespace Swan\Log\Format;

/**
+------------------------------------------------------------------------------
* Simple 
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
class Simple extends FormatAbstract
{
	// {{{ members
	
	/**
	 * 格式化字符串 
	 * 
	 * @var string
	 * @access protected
	 */
	protected $format = null;

	/**
	 * 默认日志格式 
	 * 
	 * @var string
	 * @access protected
	 */
	protected $formatDefault = "%timestamp% %priorityName% (%priority%) [%pid%]: %message%";

	// }}}
	// {{{ functions
	// {{{ public function __construct()
	
	/**
	 * __construct 
	 * 
	 * @param string $format 
	 * @access public
	 * @return void
	 */
	public function __construct($format = null)
	{	
		if (!isset($format)) {
			$format = $this->formatDefault  . PHP_EOL;	
		}
		if (!is_string($format)) {
			throw new Exception\RuntimeException('format must be string');	
		}

		$this->format = $format;
	}

	// }}}
	// {{{ public function format()
	
	/**
	 * 格式化日志内容 
	 * 
	 * @param array $events
	 * @access public
	 * @return void
	 */
	public function format($events)
	{
		if (!is_array($events)) {
			throw new Exception\RuntimeException('Param of format must be array');	
		}

		if (empty($events)) {
			return;	
		}

		$output = $this->format;
		foreach ($events as $key => $value) {
			// $value 可能是对象或数组
			if ((is_object($value) && !method_exists($value, '__toString')) || is_array($value)) {
				$value = gettype($value);
			} elseif (is_string($value)){
				$value = str_replace(array("\r", "\n"), '', $value);
			} else {
				// 主要用于把 Swan\Log\Message\MessageAbstract 对象转化为字符串
				$value = strval($value);
			}
			$output = str_replace("%$key%", $value, $output);
		}

		return $output;
	}

	// }}}
	// }}}
}

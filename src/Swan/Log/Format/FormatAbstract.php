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
* format 
+------------------------------------------------------------------------------
* 
* @package 
* @version $_SWANBR_VERSION_$
* @copyright Copyleft
* @author $_SWANBR_AUTHOR_$ 
+------------------------------------------------------------------------------
*/
abstract class FormatAbstract
{
	// {{{ members
	// }}}	
	// {{{ functions
	// {{{ abstract public function format()
	
	/**
	 * 格式化日志内容 
	 * 
	 * @param array $event 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract public function format($event);

	// }}}
	// }}}
}

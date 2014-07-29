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
 
namespace Swan\Log\Message;

/**
+------------------------------------------------------------------------------
* simple message 
+------------------------------------------------------------------------------
* 
* @uses sw
* @uses _abstract
* @package 
* @version $_SWANBR_VERSION_$
* @copyright $_SWANBR_COPYRIGHT_$
* @author $_SWANBR_AUTHOR_$ 
+------------------------------------------------------------------------------
*/
class Simple extends MessageAbstract
{
	// {{{ members

	/**
	 * __params 
	 * 
	 * @var array
	 * @access protected
	 */
	protected $__params = array(
		'message'   => '',
	);

	// }}}	
	// {{{ functions

	/**
	 * 装配日志信息 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function _assemble()
	{
		return $this->__params['message'];	
	}

	// }}}
}

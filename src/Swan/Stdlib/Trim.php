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

namespace Swan\Stdlib;
 
/**
+------------------------------------------------------------------------------
* Trim 
+------------------------------------------------------------------------------
* 
* @package 
* @version $_SWANBR_VERSION_$
* @copyright Copyleft
* @author $_SWANBR_AUTHOR_$ 
+------------------------------------------------------------------------------
*/
class Trim
{
	// {{{ functions
	
	/**
	 * 将数组执行 trim 操作 
	 * 
	 * @static
	 * @access public
	 * @return void
	 */
	public static function trimArray($array, $isUnsetEmpty = true)
	{	
		if (!is_array($array)) {
			return array();
		}

		$resArray = array();
		foreach ($array as $key => $value) {
			$value = trim($value);
			if ($isUnsetEmpty && '' === $value) {
				continue;
			}
			$resArray[$key] = $value;
		}
		return $resArray;	
	}

	// }}}	
}

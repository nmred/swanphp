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

namespace Mock\Loader;

/**
+------------------------------------------------------------------------------
* AutoLoader
+------------------------------------------------------------------------------
*
* @uses Mock\Loader
* @package
* @version $_SWANBR_VERSION_$
* @copyright $_SWANBR_COPYRIGHT_$
* @author $_SWANBR_AUTHOR_$
+------------------------------------------------------------------------------
*/
class AutoLoader extends \Swan\Loader\AutoLoader
{
    // {{{ members
    // }}}
    // {{{ functions
    // {{{ public function getNamespaces()

    /**
     * getNamespaces
     *
     * @access public
     * @return void
     */
    public function getNamespaces()
    {
        return $this->namespaces;
    }

    // }}}
    // }}}
}

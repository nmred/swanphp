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

namespace Swan\Loader\Exception;

/**
+------------------------------------------------------------------------------
* 运行异常
+------------------------------------------------------------------------------
*
* @package
* @version $_SWANBR_VERSION_$
* @copyright $_SWANBR_COPYRIGHT_$
* @author $_SWANBR_AUTHOR_$
+------------------------------------------------------------------------------
*/
class RuntimeException extends \RuntimeException implements ExceptionInterface
{
    // {{{ members

    /**
     * Usage
     *
     * @var string
     * @access protected
     */
    protected $usage = '';

    // }}}
    // {{{ functions
    // {{{ public function __construct()

    /**
     * __construct
     *
     * @param string $message
     * @param string $usage
     * @access public
     * @return void
     */
    public function __construct($message, $usage = '')
    {
        $this->usage = $usage;
        parent::__construct($message);
    }

    // }}}
    // {{{ public function getUsageMessage()

    /**
     * return the usage
     *
     * @access public
     * @return string
     */
    public function getUsageMessage()
    {
        return $this->usage;
    }

    // }}}
    // }}}
}

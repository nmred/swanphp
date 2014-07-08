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

namespace SwanTest\Stdlib;

use Swan\Stdlib\Trim;
use Swan\Test\Test;

/**
+------------------------------------------------------------------------------
* TrimTest
+------------------------------------------------------------------------------
*
* @package
* @version $_SWANBR_VERSION_$
* @copyright $_SWANBR_COPYRIGHT_$
+------------------------------------------------------------------------------
*/
class TrimTest extends Test
{
    // {{{ members
    // }}}
    // {{{ functions
    // {{{ public function testTrimArray()

    /**
     * testTrimArray
     *
     * @access public
     * @return void
     */
    public function testTrimArray()
    {
        $str = '   test | test1      |    |   test2  ';
        $except = array('test', 'test1', 'test2');

        $this->assertEquals($except, array_values(Trim::trimArray(explode('|', $str))));
    }

    // }}}
    // }}}
}

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

/**
+------------------------------------------------------------------------------
* 安装自动加载器
+------------------------------------------------------------------------------
*
* @package
* @version $_SWANBR_VERSION_$
* @copyright $_SWANBR_COPYRIGHT_$
* @author $_SWANBR_AUTHOR_$
+------------------------------------------------------------------------------
*/
include_once __DIR__ . '/../vendor/autoload.php';

$aa = Swan\Stdlib\Trim::trimArray(array());

$loader = new Swan\Loader\AutoLoader(
    array(
        Swan\Loader\Autoloader::LOAD_NS => array(
            'SwanTest' => __DIR__ . '/SwanTest',
        ),
    )
);
$loader->register();
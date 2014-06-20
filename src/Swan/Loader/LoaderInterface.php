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

namespace Swan\Loader;

use Traversable;

if (interface_exists('Swan\Loader\LoaderInterface')) return;

/**
* 自动加载 PHP 类的接口
*
* @package
* @version $_SWANBR_VERSION_$
* @copyright $_SWANBR_COPYRIGHT_$
* @author $_SWANBR_AUTHOR_$
*/
interface LoaderInterface
{

    /**
     * 设置参数
     *
     * @param  array|Traversable $options
     * @access public
     * @return void
     */
    public function setOptions($options);

    /**
     * autoload
     *
     * @param  string $class
     * @access public
     * @return mixed
     *         false [如果加载类失败]
     *         get_class($class) [如果成功]
     */
    public function autoload($class);

    /**
     * 注册 auto_loader 的方法通过 spl_autoload
     *
     * @access public
     * @return void
     */
    public function register();
}

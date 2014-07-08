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

namespace SwanTest\Loader;

use Swan\Test\Test;
use Swan\Loader\AutoLoader;
use Swan\Loader\Exception\InvalidArgumentException;

/**
+------------------------------------------------------------------------------
* AutoLoaderTest
+------------------------------------------------------------------------------
*
* @package
* @version $_SWANBR_VERSION_$
* @copyright $_SWANBR_COPYRIGHT_$
+------------------------------------------------------------------------------
*/
class AutoLoaderTest extends Test
{
    // {{{ members

    /**
     * loader 对象
     *
     * @var array
     * @access protected
     */
    protected $loader = array();

    /**
     * php include path
     *
     * @var string
     * @access protected
     */
    protected $includePath = '';

    // }}}
    // {{{ functions
    // {{{ public function setUp()

    /**
     * setUp
     *
     * @access public
     * @return void
     */
    public function setUp()
    {
        $this->loader = spl_autoload_functions();
        if (!is_array($this->loader)) {
            $this->loader = array();
        }

        $this->includePath = get_include_path();
    }

    // }}}
    // {{{ public function tearDown()

    /**
     * tearDown
     *
     * @access public
     * @return void
     */
    public function tearDown()
    {
        $loaders = spl_autoload_functions();
        if (is_array($loaders)) {
            foreach ($loaders as $loader) {
                spl_autoload_unregister($loader);
            }
        }

        foreach ($this->loader as $loader) {
            spl_autoload_register($loader);
        }

        set_include_path($this->includePath);
    }

    // }}}
    // {{{ public function testSetOptionsException()

    /**
     * testSetOptionsException
     *
     * @access public
     * @return void
     */
    public function testSetOptionsException()
    {
        $loader = new AutoLoader();

        $obj = new \stdClass;
        foreach (array(true, 'foo', $obj) as $arg) {
            try {
                $loader->setOptions($arg);
                $this->fail('setting options with invalid type should fail');
            } catch (\Swan\Loader\Exception\InvalidArgumentException $e) {
                $this->assertContains('array or Traversable.', $e->getMessage());
            }
        }
    }

    // }}}
    // {{{ public function testSetOptionsArray()

    /**
     * testSetOptionsArray
     *
     * @access public
     * @return void
     */
    public function testSetOptionsArray()
    {
        $options = array(
            'namespaces' => array(
                'swan_swan\\' => '.' . DIRECTORY_SEPARATOR,
            ),
        );

        $loader = new \Mock\Loader\AutoLoader($options);
        $this->assertEquals($options['namespaces'], $loader->getNamespaces());
    }

    // }}}
    // {{{ public function testAutoLoadNamespace()

    /**
     * testAutoLoadNamespace
     *
     * @access public
     * @return void
     */
    public function testAutoLoadNamespace()
    {
        $loader = new \Mock\Loader\AutoLoader();

        $loader->registerNamespace('Mock\Loader', dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR);
        $loader->autoload('Mock\Loader\NamespaceTest');
        $this->assertTrue(class_exists('\Mock\Loader\NamespaceTest', false));
    }

    // }}}
    // {{{ public function testRegisterCallbackWithSplAutoload()

    /**
     * testRegisterCallbackWithSplAutoload
     *
     * @access public
     * @return void
     */
    public function testRegisterCallbackWithSplAutoload()
    {
        $loader = new \Mock\Loader\AutoLoader();
        $loader->register();
        $loaders = spl_autoload_functions();
        $this->assertGreaterThan($this->loader, $loaders);
    }

    // }}}
    // }}}
}

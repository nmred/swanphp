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

require_once __DIR__ . '/LoaderInterface.php';

/**
* 标准自动加载的实现类
*
* @uses sw_loader
* @package
* @version $_SWANBR_VERSION_$
* @copyright $_SWANBR_COPYRIGHT_$
* @author $_SWANBR_AUTHOR_$
*/
class AutoLoader implements LoaderInterface
{
    // {{{ consts

    const NS_SEPARATOR     = '\\';  // 命名空间的语法分隔符
    const LOAD_NS          = 'namespaces';
    const AUTOREGISTER_SW  = 'autoregister';

    // }}}
    // {{{ members

    /**
     * __namespaces
     *
     * @var array
     * @access protected
     */
    protected $__namespaces = array();

    // }}}
    // {{{ functions
    // {{{ public function __construct()

    /**
     * __construct
     *
     * @access public
     * @return void
     */
    public function __construct($options = null)
    {
        if (null !== $options) {
            $this->setOptions($options);
        }
    }

    // }}}
    // {{{ public function setOptions()

    /**
     * setOptions
     *
     * @param array|Traversable $options
     * @access public
     * @return sw_auto
     */
    public function setOptions($options)
    {
        if (!is_array($options) && !($options instanceof \Traversable)) {
            throw new Exception\InvalidArgumentException('options must be either an array or Traversable. ');
        }

        foreach ($options as $type => $pairs) {
            switch ($type) {
                case self::AUTOREGISTER_SW:
                    if ($pairs) {
                        $this->registerNamespace('Swan', dirname(dirname(__DIR__)));
                    }
                    break;
                case self::LOAD_NS:
                    if (is_array($pairs) || $pairs instanceof \Traversable) {
                        $this->registerNamespaces($pairs);
                    }
                    break;
                default:
                    // 忽略
            }
        }

        return $this;
    }

    // }}}
    // {{{ public function registerNamespace()

    /**
     * 注册命名空间
     *
     * @param string $namespace
     * @param string $directory
     * @access public
     * @return sw_auto
     */
    public function registerNamespace($namespace, $directory)
    {
        $namespace = rtrim($namespace, self::NS_SEPARATOR) . self::NS_SEPARATOR;
        $this->__namespaces[$namespace] = $this->_normalizeDirectory($directory);
        return $this;
    }

    // }}}
    // {{{ public function registerNamespaces()

    /**
     * 批量注册命名空间
     *
     * @param array|Traversable $namespaces
     * @access public
     * @return sw_auto
     */
    public function registerNamespaces($namespaces)
    {
        if (!is_array($namespaces) && !$namespaces instanceof \Traversable) {
            throw new Exception\InvalidArgumentException('prefix pairs must be either an array or Traversable. ');
        }

        foreach ($namespaces as $namespace => $directory) {
            $this->registerNamespace($namespace, $directory);
        }

        return $this;
    }

    // }}}
    // {{{ public function register()

    /**
     * register
     *
     * @access public
     * @return void
     */
    public function register()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

    // }}}
    // {{{ public function autoload()

    /**
     * autoload
     *
     * @param string $class
     * @access public
     * @return boolean|string
     */
    public function autoload($class)
    {
        if (false !== strpos($class, self::NS_SEPARATOR)) {
            if ($this->_loadClass($class, self::LOAD_NS)) {
                return $class;
            }
        }

        return false;
    }

    // }}}
    // {{{ protected function _loadClass()

    /**
     * 加载类
     *
     * @param string $class
     * @param string $type
     * @access protected
     * @return boolean
     */
    protected function _loadClass($class, $type)
    {
        if (!in_array($type, array(self::LOAD_NS))) {
            throw new Exception\InvalidArgumentException('invalid namespace type.');
        }

        $attribute = '__' . $type;
        foreach ($this->{$attribute} as $leader => $path) {
            if (0 === strpos($class, $leader)) {
                $filename = $this->_transformClassNameToFileName($class, $path);
                if (file_exists($filename)) {
                    return require_once $filename;
                }

                return false;
            }
        }

        return false;
    }

    // }}}
    // {{{ protected function _transformClassNameToFileName()

    /**
     * 将类名转化为文件名
     *
     * @param string $class
     * @param string $directory
     * @access protected
     * @return string
     */
    protected function _transformClassNameToFileName($class, $directory)
    {
        $matches = array();
        preg_match('/(?P<namespace>.+\\\)?(?P<class>[^\\\]+$)/', $class, $matches);

        $class     = (isset($matches['class'])) ? $matches['class'] : '';
        $namespace = (isset($matches['namespace'])) ? $matches['namespace'] : '';

        return $directory
             . str_replace(self::NS_SEPARATOR, '/', $namespace)
             . $class
             . '.class.php';
    }

    // }}}
    // {{{ protected function _normalize_directory()

    /**
     * 统一目录的编写规范 /usr/swan . \usr\swan 最后加上/ \
     *
     * @param  string $directory
     * @access protected
     * @return string
     */
    protected function _normalizeDirectory($directory)
    {
        $last = $directory[strlen($directory) - 1];
        if (in_array($last, array('/', '\\'))) {
            $directory[strlen($directory) - 1] = DIRECTORY_SEPARATOR;
            return $directory;
        }

        $directory .= DIRECTORY_SEPARATOR;
        return $directory;
    }

    // }}}
    // }}}
}

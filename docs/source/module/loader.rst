自动加载机制
===============================

从 SwanPHP 2.0 开始编码遵守 PSR-2 规范，意味着支持 PSR-0 自动加载方式， 故在此规范基础上有两种方式 autoloader

- 使用 composer 自带的 autoloader 

- 使用 `Swan\\Loader\\AutoLoader`

Swan\\Loader\\AutoLoader 使用
--------------------------------

实例：

.. code-block:: php
   :linenos:

    <?php
    $loader = new Swan\Loader\AutoLoader(
        array(
            Swan\Loader\Autoloader::LOAD_NS => array(
                'SwanTest' => __DIR__ . '/SwanTest',
                'Mock'     => __DIR__ , 
            ),  
        )   
    );  
    $loader->register();

创建 Loader 对象指定数据的格式：

key 有两种方式分布是 `Swan\\Loader\\Autoloader::LOAD_NS` 和 `Swan\\Loader\\Autoloader::AUTOREGISTER_SW`
，AUTOREGISTER\_SW 方式是自动加载 Swan 框架库，value 是 `true`
, LOAD\_NS 方式是加载命名空间类库， value 是 `array('命名空间名' => '对应类库的顶级目录')`

支持方法
-------------

1. setOptions() 设置参数

参数必须是一个 Array 或 `Traversable`, Key 应该是上面支持的两种 `AUTOREGISTER\_SW` / `LOAD\_NS`

2. registerNamespace() 注册一个命名空间

将一个命名空间和对应的目录关联起来，在 `__construct` 和 setOptions 函数都会调用该函数


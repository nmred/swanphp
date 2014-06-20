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

namespace Swan\Test;

use Swan\Db\Db;
use Swan\Test\Exception\Exception;
use PDO;

/**
* 支持数据库单元测试的抽象类
*
* @package
* @version $_SWANBR_VERSION_$
* @copyright $_SWANBR_COPYRIGHT_$
* @author $_SWANBR_AUTHOR_$
*/
abstract class TestDb extends \PHPUnit_Extensions_Database_TestCase
{
    // {{{ members

    /**
     * 数据库连接
     *
     * @var mixed
     * @access protected
     */
    protected $__db = null;

    // }}}
    // {{{ functions
    // {{{ protected function setUp()

    /**
     * setUp
     *
     * @access protected
     * @return void
     */
    protected function setUp()
    {
        $this->__db = Db::singleton();
        parent::setUp();
    }

    // }}}
    // {{{ protected function getConnection()

    /**
     * 获取
     *
     * @access protecetd
     * @return \PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    protected function getConnection()
    {
        $conn = $this->__db->getConnection();
        return $this->createDefaultDBConnection($conn);
    }

    // }}}
    // {{{ protected function getDataSet()

    /**
     * 设置测试的数据集
     *
     * @access protected
     * @return \PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected function getDataSet()
    {
        $xml_data = $this->get_data_set();
        if (!isset($xml_data)) {
            throw new sw_exception("must defined data xml.");
        }

        if (is_array($xml_data)) {
            $composite_ds = new \PHPUnit_Extensions_Database_DataSet_CompositeDataSet(array());
            foreach ($xml_data as $file_path) {
                $ds = $this->createXMLDataSet($file_path);
                $composite_ds->addDataSet($ds);
            }

            return $composite_ds;
        } else {
            return $this->createXMLDataSet($xml_data);
        }
    }

    // }}}
    // {{{ public function array_to_dbset()

    /**
     * 数组转化为数据集
     *
     * @param array $data
     * @access public
     * @return void
     */
    public function array_to_dbset($data)
    {
        return new sw_array_set($data);
    }

    // }}}
    // {{{ abstract public function get_data_set()

    /**
     * 获取数据集文件
     *
     * @access public
     * @return mixed
     */
    abstract public function get_data_set();

    // }}}
    // }}}
}

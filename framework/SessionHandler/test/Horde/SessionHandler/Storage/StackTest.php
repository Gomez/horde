<?php
/**
 * Prepare the test setup.
 */
require_once dirname(__FILE__) . '/Base.php';

/**
 * Copyright 2012-2015 Horde LLC (http://www.horde.org/)
 *
 * @author     Jan Schneider <jan@horde.org>
 * @category   Horde
 * @package    Horde_SessionHandler
 * @subpackage UnitTests
 * @license    http://www.horde.org/licenses/lgpl21 LGPL 2.1
 */
class Horde_SessionHandler_Storage_StackTest extends Horde_SessionHandler_Storage_Base
{
    public static $reason;

    public function testWrite()
    {
        $this->_write();
    }

    /**
     * @depends testWrite
     */
    public function testRead()
    {
        $this->_read();
    }

    /**
     * @depends testWrite
     */
    public function testReopen()
    {
        $this->_reopen();
    }

    /**
     * @depends testWrite
     */
    public function testList()
    {
        $this->_list();
    }

    /**
     * @depends testList
     */
    public function testDestroy()
    {
        $this->_destroy();
    }

    /**
     * @depends testDestroy
     */
    public function testGc()
    {
        $this->_gc();
    }

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $storage1 = new Horde_SessionHandler_Storage_File(array(
            'path' => self::$dir
        ));
        $storage2 = new Horde_SessionHandler_Storage_File(array(
            'path' => Horde_Util::createTempDir()
        ));

        self::$handler = new Horde_SessionHandler_Storage_Stack(array(
            'stack' => array(
                $storage1,
                $storage2
            )
        ));
    }

    public function setUp()
    {
        if (!self::$handler) {
            $this->markTestSkipped(self::$reason);
        }
    }
}

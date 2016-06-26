<?php
/**
* 单例模式
* 
* @author Nutto nutto.pan@gmail.com
*/

class TaskManager {
    // 存放唯一实例
    private static $tm = null;
    private $id = null;
    private static $taskNo = 0;

    // 为了禁止使用new实例化,将构造函数私有化
    private function __construct()
    {
        $this->id = rand(1000, 9999);
    }

    // 通过静态方法获得对象
    public static function getInstance()
    {
        self::$taskNo++;
        if (self::$tm == null) {
            self::$tm = new TaskManager();
        }

        return self::$tm;
    }

    public function getId()
    {
        return $this->id;
    }

    public static function getTaskNo()
    {
        return self::$taskNo;
    }
}

$t1 = TaskManager::getInstance();
$t2 = TaskManager::getInstance();
$t3 = TaskManager::getInstance();
$t4 = TaskManager::getInstance();
$t5 = TaskManager::getInstance();

echo $t1 === $t2;
echo $t2 === $t3;
echo $t3 === $t4;
echo $t4 === $t5;
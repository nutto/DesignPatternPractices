<?php
/**
 * 接口工厂模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 抽象公文接口
interface OfficialDocument {
    public function doClone();
    public function display();
}

// 可行性分析报告类
class FAR implements OfficialDocument {
    public function doClone() {
        return clone $this;
    }

    public function display() {
        echo "<可行性分析报告>\n";
    }
}

// 软件需求规格说明书类
class SRS implements OfficialDocument {
    public function doClone() {
        return clone $this;
    }

    public function display() {
        echo "<软件需求规格说明书>\n";
    }
}

// 原型管理器(使用饿汉单例模式)
class PrototypeManager {
    // 定义一个array,用于存储对象
    private $ht = array();
    private static $pm;

    // 初始化公文对象
    private function __construct() {
        $this->ht['far'] = new FAR();
        $this->ht['srs'] = new SRS();
    }

    // 增加新的公文对象
    public function addOfficialDocument($key, $doc) {
        $this->ht[$key] = $doc;
    }

    // 通过浅克隆获取新的公文对象
    public function getOfficialDocument($key) {
        if (isset($this->ht[$key])) {
            return clone $this->ht[$key];
        } else {
            return null;
        }
    }

    public static function getPrototypeManager() {
        if (!isset(self::$pm)) {
            self::$pm = new PrototypeManager();
        }
        return self::$pm;
    }
}

class Client {
    public static function main() {
        $pm = PrototypeManager::getPrototypeManager();

        $doc1 = $pm->getOfficialDocument('far');
        $doc1->display();
        $doc2 = $pm->getOfficialDocument('far');
        $doc2->display();
        var_dump($doc1 === $doc2);
        $doc3 = $pm->getOfficialDocument('srs');
        $doc3->display();
        $doc4 = $pm->getOfficialDocument('srs');
        $doc4->display();
        var_dump($doc3 === $doc4);
    }
}


Client::main();
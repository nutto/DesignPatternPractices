<?php
/**
 * 迭代器模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 抽象聚合类
abstract class AbstractObjectList {
    protected $objects = array();

    public function __construct($objects) {
        $this->objects = $objects;
    }

    public function addObject($obj) {
        if (is_object($obj)) {
            $key = spl_object_hash($obj);
            $this->objects[$key] = $obj;
        }
    }

    public function removeObject($obj) {
        if (is_object($obj)) {
            $key = spl_object_hash($obj);
            unset($this->objects[$key]);
        }
    }

    public function getObjects() {
        return $this->objects;
    }

    // 声明创建迭代器对象的抽象工厂方法
    public abstract function createIterator();
}

// 具体聚合类,商品数据类
class ProductList extends AbstractObjectList {
    public function __construct($products) {
        parent::__construct($products);
    }

    // 实现创建迭代器对象的具体工厂方法
    public function createIterator() {
        return new ProductIterator($this);
    }
}

// 抽象迭代器
interface AbstractIterator {
    public function next();  // 移至下一个元素
    public function isLast();  // 判断是否为最后一个元素
    public function previous();  // 移动至上一个元素
    public function isFirst();  // 判断是否第一个元素
    public function getNextItem();  // 获取下一个元素
    public function getPreviousItem();  // 获取上一个元素
}

// 具体迭代器: 商品迭代器
class ProductIterator implements AbstractIterator {
    private $productList;
    private $products;
    private $key_array = array();  // 对游标和元素键名的一个映射
    private $cursor1;  // 定义一个游标,用于记录正向遍历的位置
    private $cursor2;  // 定义一个游标,用于记录逆向遍历的位置

    public function __construct($list) {
        $this->productList = $list;
        $this->products = $list->getObjects();  // 获取集合对象
        $this->cursor1 = 0;  // 设置正向遍历游标的初始值
        $this->cursor2 = sizeof($this->products) - 1;  // 设置逆向遍历游标的初始值

        if (!empty($this->products)) {
            $this->key_array = array_keys($this->products);
        }
    }

    public function next() {
        if($this->cursor1 < sizeof($this->products)) {
            $this->cursor1++;
        }
    }

    public function isLast() {
        return ($this->cursor1 == sizeof($this->products));
    }

    public function previous() {
        if ($this->cursor2 > -1) {
            $this->cursor2--;
        }
    }

    public function isFirst() {
        return ($this->cursor2 == -1);
    }

    public function getNextItem() {
        return $this->products[$this->key_array[$this->cursor1]];
    }

    public function getPreviousItem() {
        return $this->products[$this->key_array[$this->cursor2]];
    }
}



class Client {
    public static function main() {
        $products = array();
        $products[] = '倚天剑';
        $products[] = '屠龙刀';
        $products[] = '断肠草';
        $products[] = '葵花宝典';
        $products[] = '四十二章经';

        $list = new ProductList($products);  // 创建聚合对象
        $iterator = $list->createIterator();  // 创建迭代器

        // 正向遍历
        while (!$iterator->isLast()) {
            echo "{$iterator->getNextItem()}\n";
            $iterator->next();
        }

        echo "\n-----------------------------------------------------\n\n";

        // 逆向遍历
        while (!$iterator->isFirst()) {
            echo "{$iterator->getPreviousItem()}\n";
            $iterator->previous();
        }
    }
}

Client::main();
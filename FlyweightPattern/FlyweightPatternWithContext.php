<?php
/**
 * 带有外部状态的享元模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 外部状态:坐标类
class Coordinates {
    private $x;
    private $y;

    public function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX() {
        return $this->x;
    }

    public function getY() {
        return $this->y;
    }

    public function setX($x) {
        $this->x = $x;
    }

    public function setY($y) {
        $this->y = $y;
    }
}

abstract class IgoChessman {
    abstract public function getColor();

    public function display($coord) {
        echo "棋子颜色: {$this->getColor()} ,棋子的位置: {$coord->getX()}, {$coord->getY()}\n";
    }
}

// 具体享元类: 黑色棋子类
class BlackIgoChessman extends IgoChessman {
    public function getColor() {
        return '黑色';
    }
}

// 具体享元类: 白色棋子类
class WhiteIgoChessman extends IgoChessman {
    public function getColor() {
        return '白色';
    }
}

// 享元工厂类: 围棋棋子工厂类,使用单例模式进行设计
class IgoChessmanFatory {
    private static $instance;

    private static $ht;  // 使用Hash table来存储享元对象

    // 禁止用new方法来实例化
    private function __construct() {
        self::$ht = array();
        $black = new BlackIgoChessman();
        $white = new WhiteIgoChessman();

        self::$ht['black'] = $black;
        self::$ht['white'] = $white;
    }

    // 返回享元工厂类的唯一实例
    public function getIstance() {
        if (!isset(self::$instance)) {
            self::$instance = new IgoChessmanFatory();
        }
        return self::$instance;
    }

    // 通过key来获取存储在Hash Table中的享元对象
    public static function getIgoChemessman($color) {
        return self::$ht[$color];
    }
}


class Client {
    public static function main() {
        // 获取享元工厂
        $factory = IgoChessmanFatory::getIstance();

        // 通过享元工厂获取三个黑子
        $black1 = $factory->getIgoChemessman('black');
        $black2 = $factory->getIgoChemessman('black');
        $black3 = $factory->getIgoChemessman('black');
        echo '判断两颗黑子是否相同:' . ($black1 === $black2) . "\n";

        // 通过享元工厂获取两个白子
        $white1 = $factory->getIgoChemessman('white');
        $white2 = $factory->getIgoChemessman('white');
        echo '判断两颗白子是否相同:' . ($white1 === $white2) . "\n";

        // 显示棋子
        $black1->display(new Coordinates(1, 2));
        $black2->display(new Coordinates(3, 4));
        $black3->display(new Coordinates(1, 3));
        $white1->display(new Coordinates(2, 5));
        $white2->display(new Coordinates(2, 4));
    }
}

Client::main();






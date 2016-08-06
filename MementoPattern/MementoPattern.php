<?php
/**
 * 备忘录模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 原发器: 象棋棋子类
class Chessman {
    private $label;
    private $x;
    private $y;

    public function __construct($label, $x, $y) {
        $this->label = $label;
        $this->x = $x;
        $this->y = $y;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function setX($x) {
        $this->x = $x;
    }

    public function setY($y) {
        $this->y = $y;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getX() {
        return $this->x;
    }

    public function getY() {
        return $this->y;
    }

    // 保存状态
    public function save() {
        return new ChessmanMemento($this->label, $this->x, $this->y);
    }

    // 恢复状态
    public function restore($memento) {
        $this->label = $memento->getLabel();
        $this->x = $memento->getX();
        $this->y = $memento->getY();
    }
}

// 备忘录: 想起棋子备忘录类
class ChessmanMemento {
    private $label;
    private $x;
    private $y;

    public function __construct($label, $x, $y) {
        $this->label = $label;
        $this->x = $x;
        $this->y = $y;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function setX($label) {
        $this->x = $x;
    }

    public function setY($label) {
        $this->y = $y;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getX() {
        return $this->x;
    }

    public function getY() {
        return $this->y;
    }
}

// 负责人: 象棋棋子备忘录管理类
class MementoCaretaker {
    private $memento;

    public function getMemento() {
        return $this->memento;
    }

    public function setMemento($memento) {
        $this->memento = $memento;
    }
}

class Client {
    public static function main() {
        $mc = new MementoCaretaker();

        $chess = new Chessman('车', 1, 1);
        Client::display($chess);
        $mc->setMemento($chess->save());  // 保存状态
        $chess->setY(4);
        Client::display($chess);
        $mc->setMemento($chess->save());  // 保存状态
        $chess->setX(5);
        Client::display($chess);
        echo "-- 悔棋 --\n";
        $chess->restore($mc->getMemento());  // 恢复状态
        Client::display($chess);
    }

    public static function display($chess) {
        echo "棋子{$chess->getLabel()},当前位置为: 第{$chess->getX()}行, 第{$chess->getY()}列\n";
    }
}

Client::main();

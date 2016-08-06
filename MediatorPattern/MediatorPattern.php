<?php
/**
 * 中介者模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 抽象中介者
abstract class Mediator {
    public abstract function componentChanged($c);
}

// 具体中介者
class ConreteMediator extends Mediator {
    // 维持对各个同事对象的引用
    public $add_button;
    public $list;
    public $user_name_textbox;
    public $cb;

    // 封装同事对象之间的交互
    public function componentChanged($c) {
        // 单击按钮
        if ($c === $this->add_button) {
            echo "-- 单机增加按钮 --\n";
            $this->list->update();
            $this->cb->update();
            $this->user_name_textbox->update();
        }
        // 从列表框选择客户
        else if ($c === $this->list) {
            echo "-- 从列表框选择客户 --\n";
            $this->cb->update();
            $this->user_name_textbox->setText();
        }
        // 从组合框选择客户
        else if ($c == $this->cb) {
            echo "-- 从组合框选择客户 --\n";
            $this->cb->update();
            $this->user_name_textbox->setText();
        }
    }
}

// 抽象同时类: 抽象组件类
abstract class Component {
    protected $mediator;

    public function setMediator($mediator) {
        $this->mediator = $mediator;
    }

    // 转发调用
    public function changed() {
        $this->mediator->componentChanged($this);
    }

    abstract public function update();
}

// 具体同时类: 按钮类
class Button extends Component {

    public function update() {
        // 按钮不产生响应
    }
}

// 具体同时类: 列表框类
class ListBox extends Component {

    public function update() {
        echo "列表框增加一项\n";
    }

    public function select() {
        echo "列表框选中一项\n";
    }
}

// 具体同时类: 组合框类
class ComboBox extends Component {

    public function update() {
        echo "组合框增加一项\n";
    }

    public function select() {
        echo "组合框选中一项\n";
    }
}

// 具体同时类: 组合框类
class TextBox extends Component {

    public function update() {
        echo "文本框被重置\n";
    }

    public function setText() {
        echo "文本框显示\n";
    }
}

class Client {
    public static function main() {
        // 定义中介者对象
        $mediator = new ConreteMediator();

        // 定义同事对象
        $add_bt = new Button();
        $list = new ListBox();
        $cb = new ComboBox();
        $username_tb = new TextBox();

        $add_bt->setMediator($mediator);
        $list->setMediator($mediator);
        $cb->setMediator($mediator);
        $username_tb->setMediator($mediator);

        $mediator->add_button = $add_bt;
        $mediator->list = $list;
        $mediator->cb = $cb;
        $mediator->user_name_textbox = $username_tb;

        $add_bt->changed();
        echo "---------------------------------------------\n";
        $list->changed();
    }
}

Client::main();

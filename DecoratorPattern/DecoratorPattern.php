<?php
/**
 * 透明的装饰器模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 抽象构件类
abstract class Component {
    abstract public function display();
}

// 具体构件类: 窗体类
class Window extends Component {
    public function display() {
        echo "显示窗体\n";
    }
}

// 具体构件类： 文本框类
class TextBox extends Component {
    public function display() {
        echo "显示文本框\n";
    }
}

// 具体构件类: 列表框类
class ListBox extends Component {
    public function display() {
        echo "显示列表框\n";
    }
}

class ComponentDecorator extends Component {
    private $component;

    // 使用构造注入，注入抽象构件类型对象
    public function __construct(Component $component) {
        $this->component = $component;
    }

    public function display() {
        $this->component->display();
    }
}

// 具体装饰类，滚动条装饰类
class ScrollBarDecorator extends ComponentDecorator {
    public function __construct(Component $component) {
        parent::__construct($component);
    }

    public function display() {
        $this->setScrollBar();
        parent::display();
    }

    public function setScrollBar() {
        echo "为构件增加滚动条\n";
    }
}

// 具体装饰类，黑色边框装饰类
class BlackBorderDecorator extends ComponentDecorator {
    public function __construct(Component $component) {
        parent::__construct($component);
    }

    public function display() {
        $this->setBlackBorder();
        parent::display();
    }

    public function setBlackBorder() {
        echo "为构件增加黑色边框\n";
    }
}


class Client {
    public static function main() {
        $component = new Window();
        $component = new ScrollBarDecorator($component);
        $component = new BlackBorderDecorator($component); // 可以不断地被装饰类进行装饰

        $component->display();
    }
}

$client_obj = new Client();

$client_obj->main();
<?php
/**
 * 抽象工厂模式
 *
 * 坏处: 如果要增加新的产品就要修改抽象工厂类和所有的具体工厂类
 *       不太符合开闭原则
 *
 * @author Nutto <nutto.pan@gmail.com>
 */


// 抽象产品:按钮接口
interface Button {
    public function display();
}

// 具体产品: Spring按钮类
class SpringButton implements Button {
    public function display() {
        echo "显示浅绿色按钮\n";
    }
}
// 具体产品: Summer按钮类
class SummerButton implements Button {
    public function display() {
        echo "显示蓝色按钮\n";
    }
}

// 抽象产品: 文本框接口
interface TextField {
    public function display();
}

// 具体产品: Spring文本框类
class SpringTextField implements TextField {
    public function display() {
        echo "显示浅绿色边框文本框\n";
    }
}

// 具体产品: Summer 文本框类
class SummerTextField implements TextField {
    public function display() {
        echo "显示蓝色边框文本框\n";
    }
}

// 抽象产品类: 组合框接口
interface ComboBox {
    public function display();
}

// 具体产品: Spring 组合框类
class SpringComboBox implements ComboBox {
    public function display() {
        echo "显示浅绿色边框组合框\n";
    }
}

// 具体产品: Summer组合框类
class SummerComboBox implements ComboBox {
    public function display() {
        echo "显示蓝色边框组合框\n";
    }
}

// 抽象工厂: 界面皮肤工厂接口
interface SkinFactory {
    public function createButton();
    public function createTextField();
    public function createComboBox();
}

// 具体工厂类: Spring皮肤工厂
class SpringSkinFactory implements SkinFactory {
    public function createButton() {
        return new SpringTextField();
    }
    public function createTextField() {
        return new SpringButton();
    }
    public function createComboBox() {
        return new SpringComboBox();
    }
}

// 具体工厂类: Summer皮肤工厂
class SummerSkinFactory implements SkinFactory {
    public function createButton() {
        return new SummerTextField();
    }
    public function createTextField() {
        return new SummerButton();
    }
    public function createComboBox() {
        return new SummerComboBox();
    }
}


class Client {
    public static function main() {
        $factory = new SpringSkinFactory();

        $bt = $factory->createButton();
        $tf = $factory->createTextField();
        $cb = $factory->createComboBox();

        $bt->display();
        $tf->display();
        $cb->display();
    }
}


Client::main();


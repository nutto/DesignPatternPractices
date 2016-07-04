<?php
/**
 * 半透明的装饰器模式
 *
 * 半透明的装饰器模式和透明的装饰器模式最大的区别在于
 * 扩充子类装饰器功能之后，半透明装饰器不使用抽象构件
 * 中声明的方法来调用新增的方法。
 *
 * 这样的好处在于可以独立使用新增的业务方法，坏处在于
 * 不能不断地使用装饰类进行装饰
 *
 * 但对于PHP这种弱类型的语言来说，其实差别并不是十分大
 *
 * @author Nutto <nutto.pan@gmail.com>
 */


// 抽象构件类
abstract class Document {
    abstract public function display();
}

// 具体构件类: 采购单
class PurchaseRequest extends Document {
    public function display() {
        echo "显示采购单\n";
    }
}

// 具体构件类： 请假条
class LeaveRequest extends Document {
    public function display() {
        echo "显示请假条\n";
    }
}

class Decorator extends Document {
    private $document;

    // 使用构造注入，注入抽象构件类型对象
    public function __construct(Document $document) {
        $this->document = $document;
    }

    public function display() {
        $this->document->display();
    }
}

// 具体装饰类: 批准
class Approver extends Decorator {
    public function __construct(Document $document) {
        parent::__construct($document);
    }

    public function display() {
        parent::display();
    }

    public function approve() {
        echo "批准\n";
    }
}

// 具体装饰类，删除
class Deleter extends Decorator {
    public function __construct(Document $document) {
        parent::__construct($document);
    }

    public function display() {
        parent::display();
    }

    public function delete() {
        echo "删除\n";
    }
}


class Client {
    public static function main() {
        $document = new PurchaseRequest();
        $document = new Approver($document);  // 只能进行一次装饰

        $document->display();
        $document->approve();
    }
}

$client_obj = new Client();

$client_obj->main();
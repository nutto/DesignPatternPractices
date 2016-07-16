<?php
/**
 * 职责链模式
 *
 * 这个是纯的职责链模式
 * 一个具体处理者对象只能在两个行为中选择一个:要么承担全部责任,要么将责任推到下一家
 * ,不能够出现处理者对象在承担了一部分或全部责任后又将责任向下传递的情况.
 *
 * 还有不纯的职责链模式
 * 允许某个请求被一个具体处理者部分处理后再向下传递,或者一个具体处理者处理完某个请求后
 * 其后继者可以继续处理这个请求,而且一个请求可以最终不被任何处理者对象接收(就像Javascript的
 * 事件冒泡机制)
 * 
 * @author Nutto <nutto.pan@gmail.com>
 */


class PurchaseRequest {
    private $amount;  //采购金额
    private $number;  // 采购单号
    private $purpose;  // 采购目的

    public function __construct($amount, $number, $purpose) {
        $this->amount = $amount;
        $this->number = $number;
        $this->purpose = $purpose;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setNumber($number) {
        $this->number = $number;
    }

    public function getNumber() {
        return $this->number;
    }

    public function setPurpose($purpose) {
        $this->purpose = $purpose;
    }

    public function getPurpose() {
        return $this->purpose;
    }
}

// 抽象处理者: 审批者类
abstract class Approver {
    protected $successor;  // 定以后的后继对象
    protected $name;  // 审批者姓名

    public function __construct($name) {
        $this->name = $name;
    }

    // 设置后继者
    public function setSuccessor($successor) {
        $this->successor = $successor;
    }

    // 抽象请求处理方法
    public abstract function processRequest($request);
}

// 具体处理者: 主任类
class Director extends Approver {
    public function __construct($name) {
        parent::__construct($name);
    }

    public function processRequest($request) {
        if ($request->getAmount() < 50000) {
            echo "主任{$this->name}审批采购单: {$request->getNumber()}, 金额:{$request->getAmount()}元"
            . ", 采购目的:{$request->getPurpose()}.\n";  // 处理请求
        } else {
            $this->successor->processRequest($request);  // 交给后继的处理者处理请求
        }
    }
}

// 具体处理者: 副董事长
class VicePresident extends Approver {
    public function __construct($name) {
        parent::__construct($name);
    }

    public function processRequest($request) {
        if ($request->getAmount() < 100000) {
            echo "副董事长{$this->name}审批采购单: {$request->getNumber()}, 金额:{$request->getAmount()}元"
            . ", 采购目的:{$request->getPurpose()}.\n";  // 处理请求
        } else {
            $this->successor->processRequest($request);  // 交给后继的处理者处理请求
        }
    }
}

// 具体处理者: 董事长
class President extends Approver {
    public function __construct($name) {
        parent::__construct($name);
    }

    public function processRequest($request) {
        if ($request->getAmount() < 500000) {
            echo "董事长{$this->name}审批采购单: {$request->getNumber()}, 金额:{$request->getAmount()}元"
            . ", 采购目的:{$request->getPurpose()}.\n";  // 处理请求
        } else {
            $this->successor->processRequest($request);  // 交给后继的处理者处理请求
        }
    }
}

// 具体处理者: 董事会
class Congress extends Approver {
    public function __construct($name) {
        parent::__construct($name);
    }

    // 终止式类
    public function processRequest($request) {
        echo "董事会{$this->name}审批采购单: {$request->getNumber()}, 金额:{$request->getAmount()}元"
        . ", 采购目的:{$request->getPurpose()}.\n";  // 处理请求
    }
}

// 客户端类
class Client {
    public static function main() {
        $args = func_get_args();

        $wjzhang = new Director('张无忌');
        $gyang = new VicePresident('杨过');
        $jguo = new President('郭靖');
        $metting = new Congress('董事会');

        // 创建职责链
        $wjzhang->setSuccessor($gyang);
        $gyang->setSuccessor($jguo);
        $jguo->setSuccessor($metting);

        // 创建采购单
        $pr1 = new PurchaseRequest(45000, 1001, '购买倚天剑');
        $wjzhang->processRequest($pr1);
        $pr2 = new PurchaseRequest(60000, 1002, '购买屠龙刀');
        $wjzhang->processRequest($pr2);
        $pr3 = new PurchaseRequest(160000, 1003, '购买倚天屠龙记');
        $wjzhang->processRequest($pr3);
        $pr4 = new PurchaseRequest(800000, 1004, '购买金庸');
        $wjzhang->processRequest($pr4);
    }
}

$client_obj = new Client();

$client_obj->main();
<?php
/**
 * 状态模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 环境类： 银行账户
class Account {
     private $state;  // 维持一个对抽象状态对象的引用
     private $owner;  // 开户名
     private $balance = 0;  // 账户余额

     public function __construct($owner, $balance) {
        $this->owner = $owner;
        $this->balance = $balance;
        $this->state = new NormalState($this);  // 设置初始状态
        echo "{$this->owner}开户，初始金额为{$this->balance}\n";
        echo "---------------------------------\n";
     }

     public function getBalance() {
        return $this->balance;
     }

     public function setBalance($balance) {
        $this->balance = $balance;
     }

     public function setState($state) {
        $this->state = $state;
     }

     public function deposit($amount) {
        echo "{$this->owner}存款{$amount}\n";
        $this->state->deposit($amount);  // 调用状态对象的depost()方法
        echo "现在余额为{$this->balance}\n";
        echo "现在账户状态为{$this->state->getState()}\n";
        echo "----------------------------------------\n";
     }

     public function withdraw($amount) {
        echo "{$this->owner}取款{$amount}\n";
        $this->state->withdraw($amount);  // 调用状态对象的withdraw()方法
        echo "现在余额为{$this->balance}\n";
        echo "现在账户状态为{$this->state->getState()}\n";
        echo "----------------------------------------\n";
     }

     public function computeInterest() {
        $this->state->computeInterest();  // 调用状态对象的computeInterest() 方法
     }
}

// 抽象状态类
abstract class AccountState {
    protected $acc;
    protected $state;
    abstract public function deposit($amount);
    abstract public function withdraw($amount);
    abstract public function computeInterest();
    abstract public function stateCheck();

    public function getState() {
        return $this->state;
    }
}

// 具体状态类： 正常状态
class NormalState extends AccountState {
    protected $state = '正常';

    public function __construct($i) {
        if ($i instanceof Account) {
            $this->acc = $i;
        } elseif ($i instanceof AccountState) {
            $this->acc = $i->acc;
        }
    }

    public function deposit($amount) {
        $this->acc->setBalance($this->acc->getBalance() + $amount);
        $this->stateCheck();
    }

    public function withdraw($amount) {
        $this->acc->setBalance($this->acc->getBalance() - $amount);
        $this->stateCheck();
    }

    public function computeInterest() {
        echo "正常状态，无需支付利息\n";
    }

    // 状态转换
    public function stateCheck() {
        if ($this->acc->getBalance() > -2000 && $this->acc->getBalance() <= 0) {
            $this->acc->setState(new OverdraftState($this));
        } else if ($this->acc->getBalance() == -2000) {
            $this->acc->setState(new RestricteState($this));
        } else if ($this->acc->getBalance() < -2000) {
            echo "操作受限\n";
        }
    }
}


// 具体状态类： 透支状态
class OverdraftState extends AccountState {
    protected $state = '透支';

    public function __construct($state) {
        $this->acc = $state->acc;
    }

    public function deposit($amount) {
        $this->acc->setBalance($this->acc->getBalance() + $amount);
        $this->stateCheck();
    }

    public function withdraw($amount) {
        $this->acc->setBalance($this->acc->getBalance() - $amount);
        $this->stateCheck();
    }

    public function computeInterest() {
        echo "计算利息\n";
    }

    // 状态转换
    public function stateCheck() {
        if ($this->acc->getBalance() > 0) {
            $this->acc->setState(new NormalState($this));
        } else if ($this->acc->getBalance() == -2000) {
            $this->acc->setState(new RestricteState($this));
        } else if ($this->acc->getBalance() < -2000) {
            echo "操作受限\n";
        }
    }
}

// 具体状态类： 受限状态
class RestricteState extends AccountState {
    protected $state = '受限';

    public function __construct($state) {
        $this->acc = $state->acc;
    }

    public function deposit($amount) {
        $this->acc->setBalance($this->acc->getBalance() + $amount);
        $this->stateCheck();
    }

    public function withdraw($amount) {
        echo "账号受限，取款失败\n";
    }

    public function computeInterest() {
        echo "计算利息\n";
    }

    // 状态转换
    public function stateCheck() {
        if ($this->acc->getBalance() > 0) {
            $this->acc->setState(new NormalState($this));
        } else if ($this->acc->getBalance() > -2000) {
            $this->acc->setState(new OverdraftState($this));
        }
    }
}

class Client {
    public static function main() {
        $acc = new Account('段誉', 0, 0);
        $acc->deposit(1000);
        $acc->withdraw(2000);
        $acc->deposit(3000);
        $acc->withdraw(4000);
        $acc->withdraw(1000);
        $acc->computeInterest();
    }
}

Client::main();









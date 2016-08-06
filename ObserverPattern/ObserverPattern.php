<?php
/**
 * 观察者模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 抽象观察类
interface Observer {
    public function getName();
    public function setName($name);
    public function help();  // 声明支援盟友的方式
    public function beAttacked($acc);  // 声明遭受攻击方法
}


// 具体观察者: 战队成员类
class Player implements Observer {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    // 职员盟友方法的实现
    public function help() {
        echo "坚持住,{$this->name}来救你了!\n";
    }

    // 遭受攻击方法的实现,当遭受攻击时将调用栈堆控制中心类的通知方法 notifyObserver() 
    // 来通知盟友
    public function beAttacked($acc) {
        echo "{$this->name}被攻击了!\n";
        $acc->notifyObserver($this->name);
    }
}

// 目标类: 战队控制中心类
abstract class AlyControlCenter {
    protected $ally_name;  // 战队名称
    protected $players = array();  // 定义一个集合用于存储战队成员

    public function setAllyName($ally_name) {
        $this->ally_name = $ally_name;
    }

    public function getAllyName() {
        return $this->ally_name;
    }

    // 注册方法
    public function join($obs) {
        echo "{$obs->getName()}加入{$this->ally_name}战队了!\n";
        $this->players[$obs->getName()] = $obs;
    }

    // 注销方法方法
    public function quit($obs) {
        echo "{$obs->getName()}推出了{$this->ally_name}战队!\n";
        unset($this->players[$obs->getName()]);
    }

    // 声明抽象通知方法
    abstract public function notifyObserver($name);
}

// 具体目标类: 具体战队控制中心
class ConcreteAllyControlCenter extends AlyControlCenter {
    public function __construct($ally_name) {
        echo "{$ally_name}创建成功!\n";
        echo "--------------------\n";
        $this->ally_name = $ally_name;
    }

    // 实现通知方法
    public function notifyObserver($name) {
        echo "{$this->ally_name}战队紧急通知,盟友{$name}遭受敌人攻击!\n";
        // 遍历观察者集合,调用每一个盟友(除了自己)的支援方法
        foreach ($this->players as $p) {
            if ($p->getName() != $name) {
                $p->help();
            }
        }
    }
}

class Client {
    public static function main() {
        // 定义观察目标对象
        $acc = new ConcreteAllyControlCenter('金庸群侠');

        // 定义观察者对象
        $player1 = new Player('杨过');
        $acc->join($player1);
        $player2 = new Player('令狐冲');
        $acc->join($player2);
        $player3 = new Player('张无忌');
        $acc->join($player3);
        $player4 = new Player('段誉');
        $acc->join($player4);

        // 某位成员受攻击
        $player3->beAttacked($acc);
    }
}


Client::main();

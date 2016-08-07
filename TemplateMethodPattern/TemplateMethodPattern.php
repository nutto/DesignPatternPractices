<?php
/**
 * 模板方法模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 抽象类： 账户类
abstract class Account {
    // 具体方法： 基本方法
    public function validate($account, $password) {
        echo "账号:{$account}\n";
        echo "密码:{$password}\n";
        if ($account == '张无忌' && $password == '123456') {
            return true;
        } else {
            return false;
        }
    }

    // 抽象方法： 基本方法
    abstract public function calculateInerest();

    // 具体方法： 基本方法
    public function display() {
        echo "显示利息！\n";
    }

    // 模板方法
    public function handle($account, $password) {
        if (!$this->validate($account, $password)) {
            echo "账户或者密码错误!";
            return;
        }
        $this->calculateInerest();
        $this->display();
    }
}

// 具体类： 活期账户类
class CurrentAccount extends Account {
    // 覆盖父类的抽象基本方法
    public function calculateInerest() {
        echo "按活期利率计算利息\n";
    }
}

// 具体类： 定期账户类
class SavingAccount extends Account {
    // 覆盖父类的抽象基本方法
    public function calculateInerest() {
        echo "按定期利率计算利息\n";
    }
}


class Client {
    public static function main() {
        $account = new CurrentAccount();
        $account->handle('张无忌', 123456);
    }
}


Client::main();

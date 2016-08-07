<?php
/**
 * 策略模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 环境类: 电影票类
class MovieTicket {
    private $price;
    private $discount;  // 维持一个对抽象折扣类的引用

    // 注入一个折扣类对象
    public function setPrice($price) {
        $this->price = $price;
    }

    public function getPrice() {
        // 调用折扣类的折扣价计算方式
        return $this->discount->calculate($this->price);
    }

    public function setDiscount($discount) {
        $this->discount = $discount;
    }
}

// 抽象策略类： 折扣类
interface Discount {
    public function calculate($price);
}

// 具体策略类： 学生票折扣类
class StudentDiscount implements Discount {
    public function calculate($price) {
        echo "学生票\n";
        return $price * 0.8;
    }
}

// 具体策略类： 儿童折扣类
class ChildrenDiscount implements Discount {
    public function calculate($price) {
        echo "儿童票\n";
        return $price - 10;
    }
}

// 具体策略类： VIP会员票折扣类
class VIPDiscount implements Discount {
    public function calculate($price) {
        echo "VIP票\n";
        echo "增加积分\n";
        return $price * 0.5;
    }
}


class Client {
    public static function main() {
        $mt = new MovieTicket();
        $originalPrice = 60;
        $currentPrice;

        $mt->setPrice($originalPrice);
        echo "原始价为：{$originalPrice}\n";
        echo "--------------------------------\n";

        $discount = new VIPDiscount();
        $mt->setDiscount($discount);  // 注入折扣对象

        $currentPrice = $mt->getPrice();
        echo "折扣后价为：{$currentPrice}";
    }
}

Client::main();

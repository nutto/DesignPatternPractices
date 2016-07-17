<?php
/**
 * 原型模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

interface Cloneable {
    public function doClone();
}

// 具体原型类: 工作周报 WeeklyLog
class WeeklyLog implements Cloneable {
    private $name;
    private $date;
    private $content;

    public function setName($name) {
        $this->name = $name;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getName() {
        return $this->name;
    }

    public function getDate() {
        return $this->date;
    }

    public function getContent() {
        return $this->content;
    }

    // 克隆方法 doClone()
    public function doClone() {
        try {
            $new_obj = new $this;
            $new_obj->setName($this->name);
            $new_obj->setDate($this->date);
            $new_obj->setContent($this->content);
            return $new_obj;
        } catch (Exception $e) {
            echo "复制对象失败\n";
            return false;
        }
    }
}

class Client {
    public static function main() {
        $log_previous = new WeeklyLog();  // 创建原型对象
        $log_previous->setName('张无忌');
        $log_previous->setDate('第12周');
        $log_previous->setContent('这周工作很忙,每天加班!');

        echo "******周报******\n";
        echo "周次: " . $log_previous->getName() . "\n";
        echo "姓名: " . $log_previous->getDate() . "\n";
        echo "内容: " . $log_previous->getContent() . "\n";
        echo "----------------\n";

        $log_new = $log_previous->doClone();
        $log_new->setDate('第13周');
        echo "******周报******\n";
        echo "周次: " . $log_new->getName() . "\n";
        echo "姓名: " . $log_new->getDate() . "\n";
        echo "内容: " . $log_new->getContent() . "\n";
        echo "----------------\n";
    }
}


Client::main();


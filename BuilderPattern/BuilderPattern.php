<?php
/**
 * 建造者模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */


// 复杂产品类： Actor角色类
class Actor{
    private $type;  // 角色类型
    private $sex;  // 性别
    private $face;  // 脸型
    private $costume;  // 服装
    private $hairstyle;  // 发型

    public function setType($type) {
        $this->type = $type;
    }

    public function setSex($sex) {
        $this->sex = $sex;
    }

    public function setFace($face) {
        $this->face = $face;
    }

    public function setCostume($costume) {
        $this->costume = $costume;
    }

    public function setHairstyle($hairstyle) {
        $this->hairstyle = $hairstyle;
    }

    public function getHairstyle() {
        return $this->hairstyle;
    }

    public function getType() {
        return $this->type;
    }

    public function getSex() {
        return $this->sex;
    }

    public function getFace() {
        return $this->face;
    }

    public function getCostume() {
        return $this->costume;
    }
}

// 角色建造者：抽象建造者
abstract class ActorBuilder {
    protected $actor;

    public abstract function buildType();
    public abstract function buildSex();
    public abstract function buildFace();
    public abstract function buildCostume();
    public abstract function buildHairstyle();

    // 工厂方法，返回一个完整的游戏角色对象
    public function createActor() {
        return $this->actor;
    }

    public function __construct() {
        $this->actor = new Actor();
    }
}

// 具体建造者：英雄角色建造器
class HeroBuilder extends ActorBuilder {
    public function buildType() {
        $this->actor->setType('英雄');
    }
    public function buildSex() {
        $this->actor->setSex('男');
    }
    public function buildFace() {
        $this->actor->setFace('英俊');
    }
    public function buildCostume() {
        $this->actor->setCostume('盔甲');
    }
    public function buildHairstyle() {
        $this->actor->setHairstyle('飘逸');
    }
}

// 具体建造者：天使角色建造器
class AngelBuilder extends ActorBuilder {
    public function buildType() {
        $this->actor->setType('天使');
    }
    public function buildSex() {
        $this->actor->setSex('女');
    }
    public function buildFace() {
        $this->actor->setFace('漂亮');
    }
    public function buildCostume() {
        $this->actor->setCostume('白裙');
    }
    public function buildHairstyle() {
        $this->actor->setHairstyle('披肩长发');
    }
}

// 具体建造者：天使角色建造器
class DevilBuilder extends ActorBuilder {
    public function buildType() {
        $this->actor->setType('恶魔');
    }
    public function buildSex() {
        $this->actor->setSex('姚');
    }
    public function buildFace() {
        $this->actor->setFace('丑陋');
    }
    public function buildCostume() {
        $this->actor->setCostume('黑衣');
    }
    public function buildHairstyle() {
        $this->actor->setHairstyle('光头');
    }
}

// 指挥者：游戏角色创建控制器
class ActorController {
    // 逐步构建复杂产品对象
    public function construct($ab) {
        $ab->buildType();
        $ab->buildSex();
        $ab->buildFace();
        $ab->buildCostume();
        $ab->buildHairstyle();

        $actor = $ab->createActor();
        return $actor;
    }
}

class Client {
    public static function main() {
        $ab = new AngelBuilder();  // 针对抽象建造者编程

        $ac = new ActorController();

        $actor = $ac->construct($ab);

        echo "{$actor->getType()} 的外观\n";
        echo "性别：{$actor->getSex()}\n";
        echo "面容：{$actor->getFace()}\n";
        echo "服装：{$actor->getCostume()}\n";
        echo "发型：{$actor->getHairstyle()}\n";
    }
}

Client::main();

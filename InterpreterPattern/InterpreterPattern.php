<?php
/**
 * 解析器模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

abstract class AbstractNode {
    abstract public function interpret();
}

class AndNode extends AbstractNode {
    private $left;  // And 的左表达式
    private $right;  // And 的右表达式

    public function __construct($left, $right) {
        $this->left = $left;
        $this->right = $right;
    }

    // And 表达式解析操作
    public function interpret() {
        return "{$this->left->interpret()}再{$this->right->interpret()}";
    }
}

// 非终结符表达式: 简单句子的解析
class SentenceNode extends AbstractNode {
    private $direction;
    private $action;
    private $distance;

    public function __construct($direction, $action, $distance) {
        $this->direction = $direction;
        $this->action = $action;
        $this->distance = $distance;
    }

    // 简单句子的解析操作
    public function interpret() {
        return $this->direction->interpret()
        . $this->action->interpret()
        . $this->distance->interpret();
    }
}

// 终结符表达式: 方向解析
class DirectionNode extends AbstractNode {
    private $direction;

    public function __construct($direction) {
        $this->direction = $direction;
    }

    // 方向表达式的解析操作
    public function interpret() {
        switch (strtolower($this->direction)) {
            case 'up':
                return '向上';
            case 'down':
                return '向下';
            case 'left':
                return '向左';
            case 'right':
                return '向右';
            default:
                return '无效指令';
        }
    }
}

// 终结符表达式: 动作解析
class ActionNode extends AbstractNode {
    private $action;

    public function __construct($action) {
        $this->action = $action;
    }

    // 动作(移动方式)表达式的解析操作
    public function interpret() {
        switch (strtolower($this->action)) {
            case 'move':
                return '移动';
            case 'run':
                return '快速移动';
            default:
                return '无效指令';
        }
    }
}


// 终结符表达式: 距离解析
class DistanceNode extends AbstractNode {
    private $distance;

    public function __construct($distance) {
        $this->distance = $distance;
    }

    // 动作(移动方式)表达式的解析操作
    public function interpret() {
        return $this->distance;
    }
}

// 指令处理类: 工具类
class InstructionHandle {
    private $node;

    public function handle($instruction) {
        $stack = array();  // 声明一个栈用于存储抽象语法树
        $words = explode(' ', $instruction);

        for($i = 0; $i < sizeof($words); $i++) {
            if (strtolower($words[$i]) == 'and') {
                $left = array_pop($stack);
                $word1 = $words[++$i];
                $direction = new DirectionNode($word1);
                $word2 = $words[++$i];
                $action = new ActionNode($word2);
                $word3 = $words[++$i];
                $distance = new DistanceNode($word3);
                $right = new SentenceNode($direction, $action, $distance);
                array_push($stack, new AndNode($left, $right));  // And 的非终结符表达式包含两个
                                                                 // Sentence 非终结符表达式
            } else {
                $word1 = $words[$i];
                $direction = new DirectionNode($word1);
                $word2 = $words[++$i];
                $action = new ActionNode($word2);
                $word3 = $words[++$i];
                $distance = new DistanceNode($word3);
                $left = new SentenceNode($direction, $action, $distance);
                array_push($stack, $left);
            }
        }
        $this->node = array_pop($stack);
    }

    public function output() {
        $result = $this->node->interpret();
        return $result;
    }
}


class Client {
    public static function main() {
        $instruction = 'up move 5m and down run 10m and left move 5m';
        $handler = new InstructionHandle();
        $handler->handle($instruction);
        $out_string = $handler->output();
        echo $out_string;
    }
}

Client::main();

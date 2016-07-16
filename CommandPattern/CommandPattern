<?php
/**
 * 命令模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 功能键设置窗口类
class FBSettingWindow {
    private $title;
    private $function_buttons = array();

    public function __construct($title) {
        $this->title = $title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

    public function addFunctionButton($fb) {
        if (is_object($fb)) {
            $object_hash = spl_object_hash($fb);
            $this->function_buttons[$object_hash] = $fb;
        }
    }

    public function removeFunctionButton($fb) {
        if (is_object($fb)) {
            $object_hash = spl_object_hash($fb);
            if (isset($this->function_buttons[$object_hash])) {
                unset($this->function_buttons[$object_hash]);
            }
        }
    }

    public function display() {
        echo "显示窗口: {$this->title}\n";
        echo "显示功能键:\n";
        foreach ($this->function_buttons as $button_hash => $button) {
            echo "{$button->getName()}\n";
        }
    }
}

// 请求发送者: 功能键类
class FunctionButton {
    private $name;
    private $command;

    public function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    // 为功能键注入命令
    public function setCommand($command) {
        $this->command = $command;
    }

    // 发送请求的方法
    public function onClick() {
        echo "点击功能键: {$this->name}\n";
        $this->command->execute();
    }
}

// 抽象命令类
abstract class Command {
    abstract public function execute();
}

// 具体命令类: 帮助命令类
class HelpCommand extends Command {
    private $hhObj;

    public function __construct() {
        $this->hhObj = new HelpHandle();
    }

    // 命令执行方式,将调用请求接受者的业务方法
    public function execute() {
        $this->hhObj->display();
    }
}

// 具体命令类: 最小化命令类
class MinmizeCommand extends Command {
    private $whObj;  // 维持对请求接受者的引用

    public function __construct() {
        $this->whObj = new WindowHandle();
    }

    // 命令的执行方法,将调用请求接收者的业务方法
    public function execute() {
        $this->whObj->minimize();
    }
}

// 请求接收者: 窗口处理类
class WindowHandle {
    public function minimize() {
        echo "将窗口最小化至托盘\n";
    }
}

// 请求接收者: 帮助文档处理类
class HelpHandle {
    public function display() {
        echo "显示帮助文档\n";
    }
}

// 客户类
class Client {
    public static function main() {
        $fbsw = new FBSettingWindow('功能键设置');

        $fb1 = new FunctionButton('功能键1');
        $fb2 = new FunctionButton('功能键2');

        $command1 = new HelpCommand();
        $command2 = new MinmizeCommand();

        // 将命令注入功能键
        $fb1->setCommand($command1);
        $fb2->setCommand($command2);

        $fbsw->addFunctionButton($fb1);
        // $fbsw->removeFunctionButton($fb1);
        $fbsw->addFunctionButton($fb2);
        $fbsw->display();

        // 调用功能键业务方法
        $fb1->onClick();
        $fb2->onClick();
    }
}



/*-----------------命令队列----------------*/
// class CommandQueeu {
//     // 定义一个数组来存储命令队列
//     private $commands = array();

//     public function addCommond($commond) {
//         if (is_object($command)) {
//             $obj_hash = spl_object_hash($command);
//             $this->commonds[$obj_hash] = $command;
//         }
//     }

//     public function removeCommond($command) {
//         if (is_object($commond)) {
//             if (isset($this->commonds[$obj_hash])) {
//                 unset($this->commonds[$obj_hash]);
//             }
//         }
//     }

//     public function execute() {
//         foreach ($this->commonds as $obj_hash => $command) {
//             $command->execute();
//         }
//     }
// }

// class Invoker {
//     private $command_queue;  // 维持一个CommandQueue对象的引用

//     // 构造注入
//     public function __construct($command_queue) {
//         $this->command_queue = $command_queue;
//     }

//     // 设值注入
//     public function setCommandQueue($command_queue) {
//         $this->command_queue = $command_queue;
//     }

//     // 调用 CommandQueue 类的 execute 方法
//     public function call() {
//         $this->command_queue->execute();
//     }
// }

Client::main();

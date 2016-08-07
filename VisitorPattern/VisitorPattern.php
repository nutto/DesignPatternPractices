<?php
/**
 * 访问者模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 抽象元素类: 员工类
interface Employee {
    public function accept($handler);  // 接受一个抽象访问者访问
}

// 具体元素类： 全职员工类
class FulltimeEmployee implements Employee {
    private $name;  // 员工姓名
    private $weekly_wage;  // 员工周薪
    private $work_time;  // 工作时间

    public function __construct($name, $weekly_wage, $work_time) {
        $this->name = $name;
        $this->weekly_wage = $weekly_wage;
        $this->work_time = $work_time;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setWeeklyWage($weekly_wage) {
        $this->weekly_wage = $weekly_wage;
    }

    public function setWorkTime($work_time) {
        $this->work_time = $work_time;
    }

    public function getName() {
        return $this->name;
    }

    public function getWeeklyWage() {
        return $this->weekly_wage;
    }

    public function getWorkTime() {
        return $this->work_time;
    }

    public function accept($handler) {
        $handler->visit($this);  // 调用访问者的访问方法
    }
}

// 具体元素类： 兼职员工类
class ParttimeEmployee implements Employee {
    private $name;  // 员工姓名
    private $weekly_wage;  // 员工周薪
    private $work_time;  // 工作时间

    public function __construct($name, $hour_wage, $work_time) {
        $this->name = $name;
        $this->hour_wage = $hour_wage;
        $this->work_time = $work_time;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setHourWage($hour_wage) {
        $this->hour_wage = $hour_wage;
    }

    public function setWorkTime($work_time) {
        $this->work_time = $work_time;
    }

    public function getName() {
        return $this->name;
    }

    public function getHourWage() {
        return $this->hour_wage;
    }

    public function getWorkTime() {
        return $this->work_time;
    }

    public function accept($handler) {
        $handler->visit($this);  // 调用访问者的访问方法
    }
}


// 抽象访问类：部门类
abstract class Department {
    // 声明一组重载的访问方法，用于访问不同类型的具体元素
    abstract public function visit($employee);
}

// 具体访问者类： 财务部类
class FADepartment extends Department {
    // 实现财务部对全职员工的访问
    public function visit($employee) {
        if ($employee instanceof FulltimeEmployee) {
            $work_time = $employee->getWorkTime();
            $weekly_wage = $employee->getWeeklyWage();
            if ($work_time > 40) {
                $weekly_wage = $weekly_wage + ($work_time - 40) * 100;
            } else if ($work_time < 40) {
                $weekly_wage = $weekly_wage - (40 - $work_time) * 80;
                if ($weekly_wage < 0) {
                    $weekly_wage = 0;
                }
            }
            echo "正式员工{$employee->getName()},实际工资为：{$weekly_wage}元\n";
        } else if ($employee instanceof ParttimeEmployee) {
            $work_time = $employee->getWorkTime();
            $hour_wage = $employee->getHourWage();
            echo "正式员工{$employee->getName()},实际工资为：{$hour_wage}元\n";
        }
    }
}


// 具体访问类: 人力资源部类
class HRDepartment extends Department {

    public function visit($employee) {
        if ($employee instanceof FulltimeEmployee) {
            // 实现人力资源部对全职员工的访问
            $work_time = $employee->getWorkTime();
            echo "正式员工{$employee->getName()},实际工作时间为{$work_time}小时\n";
            if ($work_time > 40) {
                $t = $work_time - 40;
                echo "正式员工{$employee->getName()},加班时间为:{$t}小时\n";
            } else if ($work_time < 40) {
                $t = 40 - $work_time;
                echo "正式员工{$employee->getName()},请假时间为:{$t}小时\n";
            }
        } else if ($employee instanceof ParttimeEmployee) {
            // 实现人力资源不对兼职员工的访问
            $work_time = $employee->getWorkTime();
            echo "临时工{$employee->getName()},实际工作时间为{$work_time}小时\n";
        }
    }
}

// 对象结构: 员工列表类
class EmploteeList {
    // 定义一个集合用于存储员工对象
    private $list = array();

    public function addEmployee($employee) {
        array_push($this->list, $employee);
    }

    // 遍历访问员工集合总中的每一个员工对象
    public function accept($handler) {
        foreach ($this->list as $e) {
            $e->accept($handler);
        }
    }
}


class Client {
    public static function main() {
        $list = new EmploteeList();

        $fte1 = new FulltimeEmployee('张无忌', 3200, 45);
        $fte2 = new FulltimeEmployee('杨过', 2000, 40);
        $fte3 = new FulltimeEmployee('段誉', 2400, 38);

        $pte1 = new ParttimeEmployee('洪七公', 80, 20);
        $pte2 = new ParttimeEmployee('郭靖', 60, 18);

        $list->addEmployee($fte1);
        $list->addEmployee($fte2);
        $list->addEmployee($fte3);
        $list->addEmployee($pte1);
        $list->addEmployee($pte2);

        $dep = new FADepartment();
        $list->accept($dep);
    }
}

Client::main();

















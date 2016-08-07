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

    public function getName($name) {
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
class FulltimeEmployee implements Employee {
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

    public function getName($name) {
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
        }
        echo "正式员工{$employee->getName()},实际工资为：{$weekly_wage}元\n";
    }
}


















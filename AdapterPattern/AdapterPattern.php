<?php
/**
 * 适配器模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 目标接口：抽象成绩操作类
interface ScoreOperation {
    public function sort($arr);  // 成绩排序
    public function search($arr, $key);  // 成绩查询
}

class QuickSort {
    public function __construct() {}

    public function quickSort($arr) {
        $this->sort($arr, 0, sizeof($arr) - 1);
        return $arr;
    }

    public function sort(&$arr, $p, $r) {
        $q = 0;
        if ($p < $r) {
            $q = $this->partition($arr, $p, $r);
            $this->sort($arr, $p, $q - 1);
            $this->sort($arr, $q + 1, $r);
        }
    }

    public function partition(&$arr, $p, $r) {
        $x = $arr[$r];
        $j = $p - 1;
        for ($i=$p; $i <= $r - 1; $i++) {
            if ($arr[$i] <= $x) {
                $j++;
                $this->swap($arr, $j, $i);
            }
        }
        $this->swap($arr, $j + 1, $r);
        return $j + 1;
    }

    public function swap(&$arr, $i, $j) {
        $t = $arr[$i];
        $arr[$i] = $arr[$j];
        $arr[$j] = $t;
    }
}

// 适配者： 二分法查找类
class BinarySearch {

    public function __construct() {}

    public function binarySearch($arr, $key) {
        $low = 0;
        $high = sizeof($arr) - 1;
        while ($low <= $high) {
            $mid = intval(($low + $high) / 2);
            $mid_val = $arr[$mid];
            if ($mid_val < $key) {
                $low = $mid + 1;
            } elseif ($mid_val > $key) {
                $high = $mid -1;
            } else {
                return 1;  // 找到的话返回元素1
            }
        }
        return -1;  // 找不到的话返回-1
    }
}

// 适配器：操作适配器
class OperationAdapter implements ScoreOperation {
    private $quicksort_obj;  // 定义适配者QuickSort对象
    private $binary_search_obj;  // 定义适配者BinarySearch对象

    public function __construct() {
        $this->quicksort_obj = new QuickSort();
        $this->binary_search_obj = new BinarySearch();
    }

    public function sort($arr) {
        return $this->quicksort_obj->quickSort($arr);  // 调用适配者类QuickSort的排序方法
    }

    public function search($arr, $key) {
        return $this->binary_search_obj->binarySearch($arr, $key);  // 调用适配者类BinarySearch的查找方法
    }
}

class Client {
    public static function main() {
        $operation = new OperationAdapter();  // 针对抽象目标接口编程

        $scores = array(84, 76, 50, 69, 90, 91, 88, 96);  // 定义成绩数组
        $result = array();
        $score;

        echo "成绩排序结果\n";
        $result = $operation->sort($scores);

        // 输出成绩
        echo join(',', $result) . "\n";

        echo "查找成绩为90：";
        $score = $operation->search($scores, 90);

        if ($score != -1) {
            echo "找到成绩90\n";
        } else {
            echo "没有找到成绩90\n";
        }

        $score = $operation->search($scores, 92);
        if ($score != -1) {
            echo "找到成绩92\n";
        } else {
            echo "没有找到成绩92\n";
        }
    }
}

Client::main();

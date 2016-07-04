<?php
/**
 * 接口工厂模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

interface Chart {
    public function display();
}

// 具体产品类：柱状图
class HistogramChart implements Chart {
    public function __construct () {
        echo "创建柱状图\n";
    }

    public function display() {
        echo "显示柱状图\n";
    }
}

// 具体产品类：饼状图
class PieChart implements Chart {
    public function __construct () {
        echo "创建饼状图\n";
    }

    public function display() {
        echo "显示饼状图\n";
    }
}

// 具体产品类：折线图
class LineChart implements Chart {
    public function __construct () {
        echo "创建折线图\n";
    }

    public function display() {
        echo "显示折线图\n";
    }
}

// 图表工厂类
class ChartFactory {
    // 静态工厂方法
    public static function getChart($type) {
        $chart = null;
        switch ($type) {
            case 'histogram':
                echo "初始化柱状图\n";
                $chart = new HistogramChart();
                break;
            case 'pie':
                echo "初始化饼状图\n";
                $chart = new PieChart();
                break;
            case 'line':
                echo "初始化折线图\n";
                $chart = new LineChart();
                break;
            default:
                echo "没有支持的图形类\n";
                break;
        }
        return $chart;
    }
}

class Client {
    public function main() {
        $chart = ChartFactory::getChart('line');
        $chart->display();
        $chart = ChartFactory::getChart('pie');
        $chart->display();
    }
}


/*------------------------------------------------------*/
/**
 * 以下为使用测试
 * 
 */


$client_obj = new Client();

$client_obj->main();





<?php
/**
 * 桥接模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 辅助类: 像素矩阵类
class Matrix {
    // 代码省略
}

// 抽象类: 抽象图像类
abstract class Image {
    protected $imp;

    public function setImageImp($imp) {
        $this->imp = $imp;
    }

    public abstract function parseFile($fileName);
}


// 实现类接口: 抽象操作系统实现类
interface ImageImp {
    public function doPaint($m);  // 显示像素矩阵m
}

// 具体实现类: Windows操作系统实现类
class WindowsImp implements ImageImp {
    public function doPaint($m) {
        // 调用Windows系统的绘制函数绘制像素矩阵
        echo "在Windows操作系统中显示图像:";
    }
}

// 具体实现类: Linux操作系统实现类
class LinuxImp implements ImageImp {
    public function doPaint($m) {
        // 调用Linux系统的绘制函数绘制像素矩阵
        echo "在Linux操作系统中显示图像:";
    }
}

// 具体实现类: Unix操作系统实现类
class UnixImp implements ImageImp {
    public function doPaint($m) {
        // 调用Unix系统的绘制函数绘制像素矩阵
        echo "在Unix操作系统中显示图像:";
    }
}

// 扩充抽象类:JPG格式图像
class JPGImage extends Image {
    public function parseFile($fileName) {
        // 模拟解析JPG文件并获得一个像素矩阵对象m
        $m = new Matrix();
        $this->imp->doPaint($m);
        echo "{$fileName},格式为JPG.";
    }
}

// 扩充抽象类:PNG格式图像
class PNGImage extends Image {
    public function parseFile($fileName) {
        // 模拟解析PNG文件并获得一个像素矩阵对象m
        $m = new Matrix();
        $this->imp->doPaint($m);
        echo "{$fileName},格式为PNG.";
    }
}

// 扩充抽象类:BMP格式图像
class BMPImage extends Image {
    public function parseFile($fileName) {
        // 模拟解析BMP文件并获得一个像素矩阵对象m
        $m = new Matrix();
        $this->imp->doPaint($m);
        echo "{$fileName},格式为BMP.";
    }
}

// 扩充抽象类:GIF格式图像
class GIFImage extends Image {
    public function parseFile($fileName) {
        // 模拟解析GIF文件并获得一个像素矩阵对象m
        $m = new Matrix();
        $this->imp->doPaint($m);
        echo "{$fileName},格式为GIF.";
    }
}


class Client {
    public static function main() {
        $image = new GIFImage();
        $imp = new LinuxImp();
        $image->setImageImp($imp);
        $image->parseFile('Good');
    }
}


Client::main();
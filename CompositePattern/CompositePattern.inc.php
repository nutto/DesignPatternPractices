<?php
/**
 * 组合模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 抽象构件: 抽象文件类
abstract class AbstractFile {
    public abstract function add($file);
    public abstract function remove($file);
    public abstract function getChild($i);
    public abstract function killVirus();
}

// 叶子构件: 图像文件类
class ImageFile extends AbstractFile {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function add($file) {
        echo "对不起不支持该方法!";
    }

    public function remove($file) {
        echo "对不起不支持该方法!";
    }

    public function getChild($file) {
        echo "对不起不支持该方法!";
    }

    public function killVirus() {
        echo "对图像文件[{$this->name}]进行杀毒!\n";
    }
}

// 叶子构件: 文本文件类
class TextFile extends AbstractFile {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function add($file) {
        echo "对不起不支持该方法!";
    }

    public function remove($file) {
        echo "对不起不支持该方法!";
    }

    public function getChild($file) {
        echo "对不起不支持该方法!";
    }

    public function killVirus() {
        echo "对文本文件[{$this->name}]进行杀毒!\n";
    }
}

// 叶子构件: 视频文件类
class VideoFile extends AbstractFile {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function add($file) {
        echo "对不起不支持该方法!";
    }

    public function remove($file) {
        echo "对不起不支持该方法!";
    }

    public function getChild($file) {
        echo "对不起不支持该方法!";
    }

    public function killVirus() {
        echo "对视频文件[{$this->name}]进行杀毒!\n";
    }
}

// 容器构件: 文件夹文件类
class Folder extends AbstractFile {
    // 定义集合fileList,用于存储 AbstractFile 类型的成员
    private $file_list = array();
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function add($file) {
        if (!is_object($file)) {
            return false;
        }
        $obj_hash = spl_object_hash($file);
        $this->file_list[$obj_hash] = $file;
    }

    public function remove($file) {
        if (!is_object($file)) {
            return false;
        }
        $obj_hash = spl_object_hash($file);
        if (isset($this->file_list[$obj_hash])) {
            unset($this->file_list[$obj_hash]);
        }
    }

    public function getChild($file) {
        if (!is_object($file)) {
            return false;
        }
        $obj_hash = spl_object_hash($file);
        return $this->file_list[$obj_hash];
    }

    public function killVirus() {
        echo "--->>对文件夹[{$this->name}]进行杀毒!<<---\n";  // 模拟杀毒

        // 递归调用成员构建的killVirus()方法
        foreach ($this->file_list as $item) {
            $item->killVirus();
        }
    }
}

class Client {
    public static function main() {
        // 针对抽象构件编程
        $folder1 = new Folder('Sunny的资料');
        $folder2 = new Folder('图像文件');
        $folder3 = new Folder('文本文件');
        $folder4 = new Folder('视频文件');

        $file1 = new ImageFile('小龙女.jpg');
        $file2 = new ImageFile('张无忌.jpg');
        $file3 = new TextFile('九阴真经.txt');
        $file4 = new TextFile('葵花宝典.txt');
        $file5 = new VideoFile('笑傲江湖.rmvb');


        $folder2->add($file1);
        $folder2->add($file2);
        $folder3->add($file3);
        $folder3->add($file4);
        $folder4->add($file5);
        $folder1->add($folder2);
        $folder1->add($folder3);
        $folder1->add($folder4);

        // 从'Sunny的资料'节点开始杀毒
        $folder1->killVirus();
    }
}

Client::main();

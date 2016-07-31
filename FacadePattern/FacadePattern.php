<?php
/**
 * 外观模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

class FileReader {
    public function read($text){
        echo "读取文件获取明文\n";
        if (empty($text)) {
            echo "文件格式错误\n";
        }
        return $text;
    }
}

// 子系统类： 数据加密类
class CipherMachine {
    public function encrypt($plain_text) {
        echo "数据加密，将明文转换为密文\n";
        $plain_text = '加密>>>' . $plain_text;
        echo $plain_text . "\n";
        return $plain_text;
    }
}

// 子系统类： 文件保存类
class FileWriter {
    public function write($encrypt_str, $file_name) {
        echo "保存密文，写入文件\n";
        echo "密文内容：{$encrypt_str}\n";
        echo "保存文件到路径：{$file_name}\n";
        if (empty($file_name)) {
            echo "文件不存在\n";
        }
        if (empty($encrypt_str)) {
            echo "文件格式不正确\n";
        }
    }
}

// 外观类：加密外观类
class EncryptFacade {
    // 维持对其他对象的引用
    private $reader;
    private $cipher;
    private $writer;

    public function __construct() {
        $this->reader = new FileReader();
        $this->cipher = new CipherMachine();
        $this->writer = new FileWriter();
    }

    // 调用其他对象的业务方法
    public function fileEncrypt($file_name_src, $file_name_des) {
        $plain_str = $this->reader->read('asdf');
        $encrypt_str = $this->cipher->encrypt($plain_str);
        $this->writer->write($encrypt_str, $file_name_des);
    }
}


class Client {
    public static function main() {
        $ef = new EncryptFacade();
        $ef->fileEncrypt('a/b/c.php', 'a/b/c.enc.php');
    }
}

Client::main();


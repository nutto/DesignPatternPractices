<?php
/**
 * 多态工厂模式(正式的工厂模式)
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 抽象产品:日志记录器接口
interface Logger {
    public function writeLog();
}

// 具体产品:数据库日志记录器
class DatabaseLogger implements Logger {
    public function writeLog() {
        echo "数据库日志记录\n";
    }
}

// 具体产品:文件体制记录器
class FileLogger implements Logger {
    public function writeLog() {
        echo "文件日志记录\n";
    }
}

// 抽象工厂: 日志记录器工厂接口
interface LoggerFactory {
    public function createLogger();
}

// 具体工厂: 数据库日志记录器工厂类
class DatabaseLoggerFactory implements LoggerFactory {
    public function createLogger() {
        echo "连接数据库\n";
        // 创建数据库日志记录器对象
        $logger = new DatabaseLogger();
        echo "初始化数据库日志记录器\n";
        return $logger;
    }
}

// 具体工厂类
class FileLoggerFactory implements LoggerFactory {
    public function createLogger() {
        // 创建文件日志记录器对象
        $logger = new FileLogger();
        echo "创建文件\n";
        return $logger;
    }
}


class Client {
    public static function main() {
        $factory = new FileLoggerFactory();
        $logger = $factory->createLogger();
        $logger->writeLog();
    }
}

Client::main();

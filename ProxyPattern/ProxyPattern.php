<?php
/**
 * 代理模式
 *
 * @author Nutto <nutto.pan@gmail.com>
 */

// 抽象主题类: 抽象查询类
interface Searcher {
    public function doSearch($user_id, $keyword);
}

// 业务类: 身份验证类
class AccessValidator {
    // 模拟实现登录验证
    public function validate($user_id) {
        echo "在数据库中验证用户{$user_id}是否为合法用户\n";

        if ($user_id == '杨过') {
            echo "验证成功\n";
            return true;
        } else {
            echo "验证失败\n";
            return false;
        }
    }
}

// 业务类: 日志记录
class Logger {
    // 模拟实现日志记录
    public function log($user_id) {
        echo "更新数据库,用户{$user_id}查询次数加1\n";
    }
}

// 真实主题类: 具体查询类
class RealSearcher implements Searcher {
    //模拟查询商务信息
    public function doSearch($user_id, $keyword) {
        echo "用户{$user_id}使用关键词{$keyword}查询商务信息\n";
        return '返回具体内容';
    }
}

// 代理主题类: 代理查询类
class ProxySearcher implements Searcher {
    private $searcher;
    private $validator;
    private $logger;

    public function __construct() {
        $this->searcher = new RealSearcher();  // 维持一个对真实主题的引用
    }

    //模拟查询商务信息
    public function doSearch($user_id, $keyword) {
        // 如果身份验证成功,则执行查询
        if ($this->validate($user_id)) {
            $result = $this->searcher->doSearch($user_id, $keyword);  // 调用真是主题对象的查询方法
            $this->log($user_id);
            return $result;
        } else {
            return null;
        }
    }

    // 创建访问验证对象并调用其validate()的方法实现身份验证
    public function validate($user_id) {
        $this->validator = new AccessValidator();
        return $this->validator->validate($user_id);
    }

    // 创建日志记录对象并调用其log()方法实现日志记录
    public function log($user_id) {
        $this->logger = new Logger();
        $this->logger->log($user_id);
    }
}

class Client {
    public static function main() {
        $searcher = new ProxySearcher();  // 客户端无须分辨真是主题类和代理类
        $result = $searcher->doSearch('杨过', '玉女心经');
    }
}

Client::main();

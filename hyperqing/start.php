<?php
/**
 * common.php
 * 项目核心库文件
 */

header('Content-Type: text/html;charset=utf8');

/**
 * 项目自动加载方法
 * @param $class
 * @throws ReflectionException
 */
function proj_autoloader($class)
{
    // 根命名空间=>根文件夹
    $psr4 = [
        'app' => 'application',
        'hyper' => 'hyperqing\\libary'
    ];
    // 取出根命名空间
    $path_info = explode('\\', $class);
    // 将根命名空间转为目录
    if (!isset($psr4[$path_info[0]])) {
        throw new \ReflectionException('命名空间未声明: ' . $path_info[0]);
    }
    $path_info[0] = $psr4[$path_info[0]];
    // 重新组装路径
    $class = implode('\\', $path_info);
    if (!file_exists(WEB_ROOT . '/' . $class . '.php')) {
        throw new \ReflectionException('自动加载文件时未找到：' . WEB_ROOT . '/' . $class . '.php');
    }
    require_once WEB_ROOT . '/' . $class . '.php';
}

// 注册加载方法
spl_autoload_register('proj_autoloader');

/**
 * 返回成功页面
 * @param string $info
 * @param string $url
 * @param int $wait_time
 */
function success(string $info, string $url = null, int $wait_time = 1)
{
    if ($url == null) {
        $url = $_SERVER['HTTP_REFERER'];
    }
    require WEB_ROOT . '/success.php';
    exit;
}

/**
 * 返回失败页面
 * @param string $info
 * @param string $url
 * @param int $wait_time
 */
function error(string $info, string $url = null, int $wait_time = 3)
{
    require WEB_ROOT . '/error.php';
    exit;
}

// 启动应用
\hyper\App::run();

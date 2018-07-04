<?php
/**
 * 自制Web框架项目
 * @author HyperQing
 * 20170525
 *
 * 框架特性：
 * MVC
 * 路由规则
 *
 * 框架核心文件夹：'项目根目录/hyperqing'
 * 应用文件夹：'项目根目录/application'
 */

// 网站根目录常量
define('WEB_ROOT', __DIR__);
// 配置目录常量
define('CONF_PATH', WEB_ROOT . '/config');
// 定义应用目录常量
define('APP_PATH', WEB_ROOT . '/application');
// 核心目录
define('HYPER_PATH', WEB_ROOT . '/hyperqing');
// 引入框架核心文件
require_once __DIR__ . '/hyperqing/start.php';

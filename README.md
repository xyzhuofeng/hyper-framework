# 自制Web框架项目

by HyperQing 2017-05-20

本项目以简单的通讯录为业务背景，从散乱的php文件改造成Web框架项目。

本项目不使用composer实现自动加载，以期尝试实践框架设计。

[TOC]

## 项目背景

- MVC框架原理演示
- 用于团队教学

## 涉及技术

- 单例模式的配置类和PDO驱动类
- 命名空间和自动加载
- MVC框架设计
- 网站单一入口原则
- 路由规则
- URL生成
- 支持PATH_INFO

## 版本要求

- PHP 7 or latest

## 用到的工具

- jQuery 3.2
- Bootstrap 3

## SQL

以简单通讯录增删查改操作展示业务场景示例。

```sql
CREATE TABLE contacts(
  id int PRIMARY KEY AUTO_INCREMENT COMMENT '联系人序号',
  name VARCHAR(15) COMMENT '姓名',
  phone CHAR(11) COMMENT '手机',
  email VARCHAR(100) COMMENT '邮箱'
)COMMENT '通讯录' ENGINE InnoDB CHAR SET utf8mb4;
```

## 框架用法

### 控制器

#### 控制器定义

一个典型的控制器类定义如下：
```php
namespace app\controller;

class Index
{
    public function index()
    {

    }
}
```
控制器类文件的实际位置是
```
application\index\controller\Index.php
```
控制器类可以无需继承任何类，命名空间默认以app为根命名空间。

控制器的根命名空间可以设置，例如我们在应用配置文件中修改：
```php
// 修改应用类库命名空间
'app_namespace' => 'application',
```

### 数据库

#### 获取连接对象

```php
Connection::instance();
```

### 配置

#### 配置目录

根目录下`config/config.php`文件( `CONF_PATH` )

#### 读取配置
```php
Config::get('配置名');
```

## 版权

仅供学习。
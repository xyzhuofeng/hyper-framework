# 自制Web框架项目

by HyperQing 2017-05-20

本项目以简单的通讯录为业务背景，从散乱的php文件改造成Web框架项目。

本项目不使用composer，以期尝试实践框架设计。

[TOC]

## 涉及技术

- 单例模式的配置类和PDO驱动类
- 命名空间和动加载
- MVC框架
- 网站单一入口
- 路由规则
- URL生成
- 支持PATHINFO

## 语言和工具

- PHP7
- jQuery
- Bootstrap

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

### 数据库

#### 获取连接对象

```php
Connection::getInstance();
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
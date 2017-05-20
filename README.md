# 简单通讯录项目
by HyperQing 2017-05-20

> 本项目不使用框架实现。

**关键字**

- PHP7
- jQuery
- Bootstrap

```sql
CREATE TABLE contacts(
  id int PRIMARY KEY AUTO_INCREMENT COMMENT '联系人序号',
  name VARCHAR(15) COMMENT '姓名',
  phone CHAR(11) COMMENT '手机',
  email VARCHAR(100) COMMENT '邮箱'
)COMMENT '通讯录' ENGINE InnoDB CHAR SET utf8mb4;
```

## 版权

仅供学习。
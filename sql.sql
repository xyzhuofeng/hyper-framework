CREATE TABLE contacts(
  contacts_id BIGINT PRIMARY KEY AUTO_INCREMENT COMMENT '联系人id',
  user_name VARCHAR(20) COMMENT '姓名',
  user_phone CHAR(11) COMMENT '手机',
  user_email VARCHAR(128) COMMENT '邮箱'
)COMMENT '通讯录' ENGINE = InnoDB CHAR SET utf8mb4;
<?php
/**
 * 新增联系人
 */

require_once __DIR__ . '/common.php';
// 检查请求类型
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    error('非法操作');
}

// 读入并过滤表单

$name = isset($_POST['name']) ? $_POST['name'] : null;
$phone = isset($_POST['phone']) ? $_POST['phone'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
// 插入数据

success('新增成功');

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
// 联系人必填
$name = addslashes(htmlspecialchars(trim($name)));
if (!$name || $name == '') {
    error('姓名不能为空');
}
// 提交了手机的情况，检查纯数字、长度
if ($phone && $phone != '') {
    if (!filter_var($phone, FILTER_VALIDATE_INT)) {
        error('手机格式错误');
    }
    if (strlen($phone) != 11) {
        error('手机长度为11位');
    }
}
// 提交了邮箱的情况，检查邮箱格式
if ($email && $email != '') {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        error('邮箱格式错误');
    }
}
// 插入数据
$data = [
    'name' => $name,
    'phone' => $phone,
    'email' => $email
];
$contacts = new Contacts();
if ($contacts->save($data)) {
    success('新增成功');
}
error('新增失败');

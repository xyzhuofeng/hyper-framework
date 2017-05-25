<?php
/**
 * 删除联系人
 */

require_once __DIR__ . '/hyperqing.php';
// 检查请求类型
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    error('非法操作');
}

// 读入并过滤表单
$id_list = isset($_POST['id_list']) ? $_POST['id_list'] : null;
// 过滤输入，转成整型
function setAlltoInt(&$value)
{
    $value = intval($value);
}
array_walk($id_list, 'setAlltoInt');
// 执行操作
$row = Contacts::deleteByIdList($id_list);
if ($row) {
    success('成功删除 ' . $row . ' 条记录');
}
error('删除失败');

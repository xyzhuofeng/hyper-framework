<?php
require_once __DIR__ . '/common.php';
// 过滤参数
$id = 0;
if (isset($_GET['id']) && $_GET['id'] !== '') {
    $id = intval($_GET['id']);
} else {
    error('非法操作');
}
// 查询记录
$result = Contacts::get($id);
if (!$result) {
    error('没有找到记录');
}
?>
<!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>编辑联系人</title>
  <link rel="stylesheet" href="./static/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 750px;
    }

    form {
      margin-top: 20px;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="page-header">
    <h2>编辑联系人</h2>
  </div>
  <div class="page-content">
    <button type="button" class="btn btn-default" onclick="window.history.go(-1)">
      <i class="glyphicon glyphicon-arrow-left"></i> 返回
    </button>
    <form action="./update.php" method="post" class="form-horizontal">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">联系人姓名</label>
        <div class="col-sm-5">
          <input class="form-control" type="text"
                 name="name" id="name" value="<?php echo $result['name'] ?>" placeholder="必填" required>
        </div>
      </div>
      <div class="form-group">
        <label for="phone" class="col-sm-2 control-label">手机</label>
        <div class="col-sm-5">
          <input class="form-control" type="text" name="phone" id="phone"
                 value="<?php echo $result['phone'] ?>" placeholder="选填"
                 minlength="11" maxlength="11">
        </div>
      </div>
      <div class="form-group">
        <label for="email" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-5">
          <input class="form-control" type="email"
                 name="email" id="email" value="<?php echo $result['email'] ?>"
                 placeholder="选填">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-5 col-sm-offset-2">
          <input type="submit" value="保存" class="btn btn-primary btn-block">
        </div>
      </div>
    </form>
  </div>
</div>
</body>
<script src="./static/js/jquery-3.1.1.min.js"></script>
<script src="./static/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</html>

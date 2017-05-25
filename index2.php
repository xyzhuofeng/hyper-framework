<?php
require_once __DIR__ . '/hyperqing.php';
// 过滤参数
if (isset($_GET['keyword']) && $_GET['keyword'] !== '') {
    $keyword = addslashes(htmlspecialchars(trim($_GET['keyword'])));
} else {
    $keyword = null;
}
// 获取数据
if ($keyword) {
    $result = Contacts::findByKeyword($keyword);
} else {
    // 设置每页的数量
    $perpage_count = 2;
    // 读取当前页码，无页码当第一页
    $page = 1;
    if (isset($_GET['page'])) {
        $page = intval($_GET['page']);
    }
    $start_index = ($page - 1) * $perpage_count;
    $pdo = DBDriver::getInstance();
    $state = $pdo->prepare("SELECT * FROM contacts LIMIT {$start_index},{$perpage_count}");
    $state->execute();
    $result = $state->fetchAll(PDO::FETCH_ASSOC);
    // 获取总记录数，这是为了计算分页条究竟要多长
    $state = $pdo->prepare("SELECT count(*) AS total FROM contacts");
    $state->execute();
    // 总记录数
    $total_count = $state->fetch(PDO::FETCH_ASSOC)['total'];
    $paginator = new Paginator(2, $total_count, $result, $page);
}
?>
<!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>首页</title>
  <link rel="stylesheet" href="./static/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 750px;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="page-header">
    <h1>通讯录</h1>
  </div>
  <div class="page-content">
    <div class="row">
      <div class="col-sm-6">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAdd">
          <i class="glyphicon glyphicon-plus"></i> 新增
        </button>
        <button class="btn btn-danger" onclick="submitForm('deleteForm')">
          <i class="glyphicon glyphicon-minus"></i> 删除
        </button>
      </div>
      <div class="col-sm-6 text-right">
        <form class="form-inline" action="./index.php" method="get">
          <input type="text" name="keyword" class="form-control" placeholder="输入关键字"
                 value="<?php echo $keyword ? $keyword : ''; ?>">
          <input type="submit" value="搜索" class="btn btn-default">
          <a href="./index.php">清除条件</a>
        </form>
      </div>
    </div>
    <table class="table table-hover">
      <thead>
      <tr>
        <th><input type="checkbox" onclick="selectAll(this,'id_list[]')"></th>
        <th>联系人</th>
        <th>手机</th>
        <th>邮箱</th>
        <th>操作</th>
      </tr>
      </thead>
      <tbody>
      <form action="./delete.php" method="post" id="deleteForm">
          <?php
          foreach ($paginator as $item) {
              echo <<<EOT
<tr>
  <td><input type="checkbox" name="id_list[]" value="{$item['id']}"></td>
  <td>{$item['name']}</td>
  <td>{$item['phone']}</td>
  <td>{$item['email']}</td>
  <td><a href="./edit.php?id={$item['id']}">编辑</a></td>
</tr>
EOT;
          }
          ?>
      </form>
      </tbody>
    </table>
      <?php
      if ($paginator->isEmpty()) {
          echo <<<EOD
<div class="text-center">
  <p class="help-block">没有找到记录</p>
</div>
EOD;
      }
      ?>
    <div class="text-center">
        <?php echo $paginator->render(); ?>
    </div>
  </div>
</div>
<!-- 新增联系人 -->
<div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">新增联系人</h4>
      </div>
      <form action="./save.php" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="name">联系人姓名</label>
            <input class="form-control" type="text"
                   name="name" id="name" placeholder="必填" required>
          </div>
          <div class="form-group">
            <label for="phone">手机</label>
            <input class="form-control" type="text" name="phone" id="phone"
                   placeholder="选填" minlength="11" maxlength="11">
          </div>
          <div class="form-group">
            <label for="email">邮箱</label>
            <input class="form-control" type="email"
                   name="email" id="email" placeholder="选填">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          <button type="submit" class="btn btn-primary">提交</button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
<script src="./static/js/jquery-3.1.1.min.js"></script>
<script src="./static/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script>
  /**
   * 全选/全不选checkbox
   * @param checkObject 全选多选框对象
   * @param checkArrayId 多选框组id如："box[]"
   */
  function selectAll(checkObject, checkArrayId) {
    if (checkObject.checked) {
      $("input[name='" + checkArrayId + "']").prop("checked", true);
    } else {
      $("input[name='" + checkArrayId + "']").prop("checked", false);
    }
  }

  /**
   * 提交表单
   * @param id 表单id
   */
  function submitForm(id) {
    document.getElementById(id).submit();
  }
</script>
</html>

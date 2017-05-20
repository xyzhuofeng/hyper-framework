<?php
require_once __DIR__ . '/common.php';
// 过滤参数
if (isset($_GET['keyword']) && $_GET['keyword'] !== '') {
    $keyword = addslashes(htmlspecialchars(trim($_GET['keyword'])));
} else {
    $keyword = null;
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
  <script src="./static/js/jquery-3.1.1.min.js"></script>
  <script src="./static/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
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
          <input type="text" name="keyword" class="form-control" placeholder="输入关键字" value="<?php echo $keyword ? $keyword : ''; ?>">
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
          if ($keyword) {
              $result =Contacts::findByKeyword($keyword);
          } else {
              $result = Contacts::all();
          }
          foreach ($result as $item) {
              echo <<<EOT
<tr>
  <td><input type="checkbox" name="id_list[]" value="{$item['id']}"></td>
  <td>{$item['name']}</td>
  <td>{$item['phone']}</td>
  <td>{$item['email']}</td>
  <td><a href="">编辑</a></td>
</tr>
EOT;
          }
          ?>
      </form>
      </tbody>
    </table>
    <div class="text-center">
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <li>
            <a href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li>
            <a href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
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
            <input class="form-control" type="text" name="name" id="name" placeholder="必填" required>
          </div>
          <div class="form-group">
            <label for="phone">手机</label>
            <input class="form-control" type="text" name="phone" id="phone" placeholder="选填" maxlength="11">
          </div>
          <div class="form-group">
            <label for="email">邮箱</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="选填">
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

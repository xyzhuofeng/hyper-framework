<!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>操作成功！</title>
</head>
<body>
<h1>:) <?php echo isset($info) ? $info : '未知错误'; ?></h1>
<h3>
  <span id="wait_time">
        <?php echo isset($wait_time) ? $wait_time : 3; ?>
  </span> 秒后返回，点击 <a href="<?php echo isset($url) ? $url : '#'; ?>">返回</a>
</h3>
<script>
  var time = <?php echo isset($wait_time) ? $wait_time : 3; ?>;
  var url = '<?php echo isset($url) ? $url : '#';?>';
  var interval = setInterval(function () {
    time -= 1;
    document.getElementById('wait_time').innerHTML = time;
    if (time === 0) {
      clearInterval(interval);
      window.location.href = url;
    }
  }, 1000);
</script>
</body>
</html>
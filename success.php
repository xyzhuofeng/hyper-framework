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
<h1>:) <?php echo $info; ?></h1>
<h3><span id="wait_time"><?php echo $wait_time; ?></span> 秒后返回，点击 <a href="">返回</a></h3>
<script>
  var time = <?php echo $wait_time;?>;
  var url = '<?php echo $url;?>';
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>基于密码漏洞</title>
</head>
<body>

<?php
if (isset($_COOKIE["user"])){
    echo "<h1>欢迎 " . $_COOKIE["user"] . "!</h1>";
}else{
    echo "<h1>未登录!</h1>";
}
?>

</body>
</html>
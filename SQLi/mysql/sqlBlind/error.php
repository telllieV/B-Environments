<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SQL 报错注入</title>
</head>
<body>
<form method="post">
    用户名：<input name="name" type="test"></br>
    密&nbsp&nbsp&nbsp码：<input name="pwd" type="password"></br>
    <button>登录</button>
</form>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', -1);
if( $_SERVER['REQUEST_METHOD'] === 'POST') {

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "myDB";

// 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }

// 查询数据库
    $sql = "SELECT name  FROM users WHERE name='" . $_POST['name'] ."' AND pwd = '".$_POST['pwd']."'";
    $result = $conn->query($sql);
    $conn->close();
    if(!$result){
        echo "数据错误";
        return;
    }


    echo "正在登录";

}
?>
</body>
</html>
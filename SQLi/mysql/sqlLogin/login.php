<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SQL 注入登录绕过</title>
</head>
<body>
<form  method="post">
    用户名：<input name="name" type="test"></br>
    密&nbsp&nbsp&nbsp码：<input name="pwd" type="password"></br>
    <button>登录</button>
</form>

<?php
if( $_SERVER['REQUEST_METHOD'] === 'POST') {
// 配置数据库
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

    if ($result->num_rows > 0) {
        // 输出数据
        while ($row = $result->fetch_assoc()) {
            setcookie( 'user',$row["name"],time()+1);
            header('Location: sqlLogin');
            exit;
        }
    } else {
        echo "用户名密码错误";
    }

}
?>
</body>
</html>
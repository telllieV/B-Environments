<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户名枚举</title>
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
    $sql = "SELECT name  FROM users WHERE name='" . $_POST['name'] ."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 输出数据
        while ($row = $result->fetch_assoc()) {
            $sql = "SELECT name  FROM users WHERE name='" . $row['name'] ."' AND pwd ='".$_POST['pwd']."'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                setcookie( 'user',$row["name"],time()+1);
                header('Location: index.php');
                $conn->close();
                exit;
            }else{
                echo  $_POST['name']."用户名密码无效";
            }
        }
    } else {
        echo  $_POST['name']."用户名密码无效。";
    }
    $conn->close();
}
?>
</body>
</html>
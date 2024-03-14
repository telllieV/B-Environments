<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>盲注-条件注入</title>
</head>
<body>

    <?php

    $id = @$_COOKIE["id"];
    if(!$id){
        $id = 1;
        setcookie( 'id',$id);
    }

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
    $sql = "SELECT name  FROM users WHERE id=".$id;

    $result = $conn->query($sql);
    $conn->close();

    if ($result->num_rows > 0) {
        echo "登录成功";
    } else {
        echo "用户不存在";
    }

    ?>

</body>
</html>
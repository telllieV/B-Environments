<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>单列中获取多个值</title>
</head>
<body>
<form method="get">
    id：<input name="id" type="number">
    <button>查询</button>
</form>

<?php
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
    $id =$_GET['id']?$_GET['id']:1;
    $sql = "SELECT title  FROM books WHERE id=" . $id ;
    $result = $conn->query($sql);
    $conn->close();

    if ($result->num_rows > 0) {
        // 输出数据
        while ($row = $result->fetch_assoc()) {
            echo "书名:".$row['title']."</br>";
        }
    } else {
        echo "书籍不存在";
    }

?>
</body>
</html>
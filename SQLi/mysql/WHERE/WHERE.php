<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>检索数据-WHERE子句</title>
</head>
<body>
<form action="/" method="get">
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
$sql = "SELECT name  FROM users WHERE id=".$_GET['id'];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        echo "name: " . $row["name"].  "<br>";
    }
} else {
    echo "0 结果";
}
$conn->close();
?>
</body>
</html>
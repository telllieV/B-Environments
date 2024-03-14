<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SQL 注入waf绕过</title>
</head>
<body>
<form  onsubmit="return false;">
    用户名：<input name="name" type="test"></br>
    密&nbsp&nbsp&nbsp码：<input name="pwd" type="password"></br>
    <button id="submitBtn" >登录</button>
</form>

<script>
    document.getElementById('submitBtn').addEventListener('click', function() {
        // 创建 XMLHttpRequest 对象
        var xhr = new XMLHttpRequest();

        // 配置 POST 请求
        xhr.open('POST', '/wafXML', true);
        xhr.setRequestHeader('Content-Type', 'text/xml');

        // 创建 XML 数据
        var xmlData = '<Login>' +
            '<name>' + document.getElementsByName('name')[0].value + '</name>' +
            '<pwd>' + document.getElementsByName('pwd')[0].value + '</pwd>' +
            '</Login>';

        // 定义响应处理函数
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('登录成功：', xhr.responseText);
            } else {
                console.error('登录失败：', xhr.status);
            }
        };

        // 发送 XML 数据
        xhr.send(xmlData);
    });

</script>

<?php
if( $_SERVER['REQUEST_METHOD'] === 'POST') {
    // 接收传送的数据
    $fileContent = file_get_contents("php://input");

    if(strpos($fileContent,' ')!==false){
        echo "检测到攻击";
        return;
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

// 先把xml转换为simplexml对象，再把simplexml对象转换成json，再将json转换成数组。
    $value_array = json_decode(json_encode(simplexml_load_string($fileContent, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

// 获取值，进行业务处理
    $name = $value_array['name'];
    $pwd = $value_array['pwd'];

// 查询数据库
    $sql = "SELECT name  FROM users WHERE name='" . $name ."' AND pwd = '".$pwd."'";

    $result = $conn->query($sql);
    $conn->close();

    if ($result->num_rows > 0) {
        // 输出数据
        while ($row = $result->fetch_assoc()) {
            echo $row['name']."\n";
        }
        echo "用户名密码正确";
    } else {
        echo "用户名密码错误";
    }


}
?>
</body>
</html>
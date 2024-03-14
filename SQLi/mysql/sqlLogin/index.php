<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SQL 注入登录绕过</title>
</head>
<body>

    <?php
    if (isset($_COOKIE["user"])){
        echo "<h1>欢迎 " . $_COOKIE["user"] . "!</h1>";
    }else{
        header('Location: /SQLi/mysql/sqlLogin/login.php');
    }
    ?>

</body>
</html>
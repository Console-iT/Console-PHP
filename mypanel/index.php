<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>个人中心 - Console PHP</title>        
        <link href="/src/css/main.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <p>
        <?php
        // put your code here
        $thispage = htmlspecialchars($_SERVER["REQUEST_URI"]);
        if (isset($_COOKIE["name"]))
            echo '您好，<a href="/mypanel/">' . $_COOKIE["name"] . '</a> | <a href="/logout.php">退出</a>';
        else
            echo '<script Language="JavaScript">window.location.href("login.php?previous=' . $thispage . '&redirect=true");</script>';
        if (isset($_GET["mode"])) { $mode = $_GET["mode"]; } else { $mode = "profile"; }
        ?>
        </p>
    <h1>个人中心</h1>
    <p> </p>
    <p> <!--TODO：将导航栏改为以 JavaScript 方式实现，点击导航栏的链接以更改 iframe 中加载的页面。-->
        <?php
        if ($mode == "profile") echo '<b>基本资料</b>';
        else echo '<a href="?mode=profile">基本资料</a>';
        if ($mode == "school") echo ' | <b>我的学校</b>';
        else echo ' | <a href="?mode=school">我的学校</a>';
        if ($mode == "experience") echo ' | <b>参会经历</b>';
        else echo ' | <a href="?mode=experience">参会经历</a>';?>
    </p>
    <?php 
        echo '<iframe src="' . $mode . '.php" scrolling="no"></iframe>    '
    ?>    
    <p><a href="/">返回主页面</a></p>
    </body>
</html>

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
            echo '您好，<a href="/mypanel/">' . $_COOKIE["name"] . '</a> | <a href="logout.php">退出</a>';
        else
            echo '<script Language="JavaScript">window.location.href("login.php?previous=' . $thispage . '&redirect=true");</script>';
        if (isset($GET["mode"])) $mode = $GET["mode"]; else $mode = "profile";
        ?>
        </p>
    <h1>个人中心</h1>
    <p> </p>
    <p> <!--TODO：将导航栏改为以 JavaScript 方式实现，点击导航栏的链接以更改 iframe 中加载的页面。-->
        <?php
        $myself = htmlspecialchars($_SERVER["PHP_SELF"]);
        if ($mode == "profile") echo '<b>基本资料</b>';
        else echo '<a href="' . $myself . '">基本资料</a>';
        if ($mode == "school") echo ' | <b>我的学校</b>';
        else echo ' | <a href="' . $myself . '?mode=school">我的学校</a>';
        if ($mode == "experience") echo ' | <b>参会经历</b>';
        else echo ' | <a href="' . $myself . '?mode=experience">参会经历</a>';?>
    </p>
    <iframe src="profile.php" scrolling="no"></iframe>
    <table class="main">
        <tbody>
            <tr>
                <td class="option" colspan="3"><p>添加一个学校</p></td>
            </tr>
            <tr>
                <td class="subjects30"><p>学校名称</p></td>
                <td style="width: 20px"></td>
                <td class="option"><p><input style="width:400px" type="text" name="schoolname" maxlength="64" /></p></td>
            </tr>
            <tr>
                <td class="subjects30"><p>学校类型</p></td>
                <td style="width: 20px"></td>
                <td class="option"><p>
                        <input type="radio" name="typeSchool" <?php if (isset($typeSchool) && $typeSchool=="1") echo "checked";?> value="1">初级中学
                        <input type="radio" name="typeSchool" <?php if (isset($typeSchool) && $typeSchool=="2") echo "checked";?> value="2">高级中学
                        <input type="radio" name="typeSchool" <?php if (isset($typeSchool) && $typeSchool=="3") echo "checked";?> value="3">大学
                        <input type="radio" name="typeSchool" <?php if (isset($typeSchool) && $typeSchool=="4") echo "checked";?> value="4">研究生院
                        <input type="radio" name="typeSchool" <?php if (isset($typeSchool) && $typeSchool=="5") echo "checked";?> value="5">其他
                    </p></td>
            </tr>
            <tr>
                <td class="subjects30"><p>毕业年份</p></td>
                <td style="width: 20px"></td>
                <td class="option"><p><input style="width:60px" type="text" name="graduationYear" maxlength="4" /></p></td>
            </tr>
        </tbody>
    </table>
    <p><a href="/">返回主页面</a></p>
    </body>
</html>

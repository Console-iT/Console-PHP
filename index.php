<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Console PHP</title>        
        <link href="src/css/main.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <p>
        <?php
        // put your code here
        if (isset($_COOKIE["name"]))
            echo "您好，<a href=\"mypanel.php\">" . $_COOKIE["name"] . "</a> | <a href=\"logout.php\">退出</a>";
        else
            echo "<a href=\"login.php\">登录</a> | <a href=\"register.php\">注册</a>";
        ?>
        </p>
        <h1>Console PHP</h1>
        <p> </p>
        <p>PHP 是世界上最好的编程语言！</p>
        <table class="main">
            <tbody>
                <tr><td>
                        <h2>全站公告</h2>
                        <p>暂无最新公告。<br />当 Console iT 发布新的公告时，将在这里显示。<br />请特别留意此处的公告，因为它们往往非常重要。</p>                        
                        <p><a href="announcement.php">查看历史公告</a></p>
                    </td></tr>
            </tbody>
        </table>
        <?php 
        if (isset($_COOKIE["name"])) {
        echo '<table class="main">
            <tbody>
                <tr><td class="block" style="width: 50%;">
                        <h2>我学校的社团</h2>';
                        
                            include("db_predential.php");
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dusername, $dpassword);
                            $sqlfind = "SELECT school FROM users WHERE id = " . $_COOKIE["uid"];
                            $query = $conn->query($sqlfind);
                            $school = $query[0]['school'];
                            
                            if (empty($school)) 
                                echo "<p>请在个人资料页填写您的学校以查找您学校的模联社团。</p><p><a href=\"mypanel.php?mode=school&edit=true\">完善我的个人信息</a></p>";
                        
        echo '</td>
                    <td class="block" style="width: 50%;">
                        <h2>我参加的会议</h2>
                        <p>目前您没有报名任何会议。</p>
                        <p><a href="conflist.php">查看您所在地区的会议</a></p>
                    </td></tr>
            </tbody>
        </table>';
        }?>
    </body>
</html>

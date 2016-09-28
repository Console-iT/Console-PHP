<html>
<head>
    <title>注册新账户 - Console PHP</title>
    <link href="src/css/main.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <?php
    $email = $name = $pwd = $pwd2 = $password = "";
    $errMessage = "　";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
	$validate = true;	
        if (empty($_POST["agreement"])) 
        {
            $errMessage = "您必须同意 Console PHP 用户协议！";
	    $validate = false;
            $pwd = $pwd2 = $_POST["password"];
        }
        
	if (levenshtein($_POST["password"], $_POST["password2"]) != 0) 
        {
            $errMessage = "两次输入的密码不一致！";
	    $validate = false;
            $pwd = $pwd2 = "";
        }
		
	if (empty($_POST["password2"])) 
        {
            $errMessage = "请再次输入密码！";
	    $validate = false;
            $pwd = $_POST["password"];
        }
		
        if (empty($_POST["password"])) 
        {
            $errMessage = "请输入密码！";
	    $validate = false;
        } else {
            $password = md5($_POST["password"]);
        }

	if (empty(test_input($_POST["name"]))) 
        {
            $errMessage = "请输入姓名！";
	    $validate = false;
        }
        else 
        {
            $name = test_input($_POST["name"]);
        }
		
        if (empty($_POST["email"])) 
        {
            $errMessage = "请输入邮箱！";
	    $validate = false;
        }
        else 
        {
            $email = test_input($_POST["email"]);
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) 
            {
                $errMessage = "邮箱格式无效！";
		$validate = false;
                $email = "";
            }
        }
		
        if ($validate == true)
        {
            try
            {
                include("db_predential.php");
            
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dusername, $dpassword);
                
                $sqlfind = "SELECT COUNT(*) FROM users WHERE email = '$email'";
                
                $validate_email = $conn->query($sqlfind);
                $hasRegistered = $validate_email->fetchColumn();
                
                if ($hasRegistered > 0)
                {
                    $errMessage = "该 E-mail 已被注册！";
                    $email = "";
                }
                else
                {
                    $time = date("Y-m-d H:i:s");
                    $sql = "INSERT INTO users (fullName, password, email, dateJoined) VALUES ('$name', '$password', '$email', '$time')";
                    try
                    //$conn = null;
                    {
                        $count = $conn->exec($sql);
                        if ($count == 1)
                        {
                            setcookie("name",$name);                        
                            setcookie("user",$email);
                            setcookie("auth",true);
                            send_email($email, $name);
                            $sqlfind2 = "SELECT id FROM users WHERE email = '$email'";
                            foreach ($conn->query($sqlfind) as $row)
                            {                                          
                                setcookie("uid",$row['id']);                                
                            }
                            echo '<p>您已成功注册！如果浏览器没有自动跳转，请<a href="index.php">点击这里</a></p>'
                               . '<script Language="JavaScript">window.location.href("index.php");</script>';
                            die;
                        }
                        else 
                        {
                            $errMessage = "SQL 错误，注册未完成！";
                            $pwd = $pwd2 = $_POST["password"];
                        }
                    }
                    catch(PDOException $ex)
                    {
                        $errMessage =  $ex->getMessage();
                    }
                }
            } 
            catch (PDOException $e) 
            {
                $errMessage = $e->getMessage();
            }
        }
    }
    
    function send_email($email, $name)
    {
        //$to = "z.song@student.fontys.nl";
        $subject = "欢迎加入 Console PHP";
        $content = "您好，" . $name 
                . "：\n\n感谢您注册 Console PHP。敬请享受 Console iT 平台的便捷与 PHP 编程语言的强大。"
                . "\n\nConsole PHP 是北京市高中生模拟联合国协会技术团队开发的 Console iT 模拟联合国在线系统的 PHP 重构版。系统预计将囊括社团管理、会议筹备与管理、委员会文件管理、个人信息更新等多个功能。"
                . "\n\n这是一封由系统自动发出的邮件，请勿向此地址回复。";
        mail($email, $subject, $content);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <p>　</p>
    <h1>注册 Console PHP</h1>
    <p> </p>
    <p>注册 Console PHP 以享受 Console iT 的便捷与 PHP 的强大。</p>
    <p style="color:red"><?php echo $errMessage;?></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <p>　　邮箱：<input style="width:180px" type="text" name="email" maxlength="64" value="<?php echo $email;?>"/></p>
        <p>　　姓名：<input style="width:180px" type="text" name="name" maxlength="32" value="<?php echo $name;?>"/></p>
        <p>　　密码：<input style="width:180px" type="password" name="password" maxlength="32" value="<?php echo $pwd;?>"/></p>
        <p>确认密码：<input style="width:180px" type="password" name="password2" maxlength="32" value="<?php echo $pwd2;?>"/></p>
        <p><input  type="checkbox" name="agreement" value="yes"/>我同意 <a href="agreement.htm" target="_blank">Console PHP 用户协议</a></p>
        <input type="submit" name="register" value="注册" />
    </form>
    <p>　</p>
    <a href="login.php">使用已有账户登录</a><br /><br />
    <a href="password.php">忘了密码？</a>
</body>
</html>
<html>
<head>
    <title>登录 - Console PHP</title>
    <link href="src/css/main.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <?php
    $email = $password = "";
    $errMessage = "　";
    $previous = $_SERVER["HTTP_REFERER"];
    if (isset($_GET['redirect'])) $errMessage = "您需要先登录才能继续访问该页面！";    
    if (isset($_GET['previous'])) $previous = "http://".$_SERVER['HTTP_HOST'].$_GET['previous'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
	$validate = true;
        if (empty($_POST["password"])) 
        {
            $errMessage = "请输入密码！";
            $validate = false;
        } else {
            $password = md5($_POST["password"]);
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
                $email = "";
		$validate = false;
            }
        }
		
        if ($validate == true)
        {
            try
            {
		include("/functions/db_predential.php");
			
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dusername, $dpassword);
			
		$sqlfind = "SELECT id, password, fullName FROM users WHERE email = '$email'";
			
		$found = false;
				
		foreach ($conn->query($sqlfind) as $row)
		{
                    $found = true;
                    if ($row['password'] != $password)
                    {
                        $errMessage = "密码错误！";
                    }
                    else
                    {
                        $name = $row['fullName'];
                        $length = 0;
                        if (!empty($_POST["remember"])) $length = time()+2592000;
                        setcookie("name",$name,$length);                        
                        setcookie("user",$email,$length);                                               
                        setcookie("uid",$row['id'],$length);
                        setcookie("auth",true);
                        echo '<p>您已成功登录！如果浏览器没有自动跳转，请<a href="' . $previous . '">点击这里</a></p>'
                        . '<script Language="JavaScript">window.location.href("' . $previous . '");</script>';
                        die;
                    }
		}
				
		if (!$found)
		{
		    $errMessage = "用户不存在！";
		}					
	    }
	    catch(PDOException $e)
	    {
		$errMessage =  $e->getMessage();
	    }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <p>　</p>
    <h1>登录 Console PHP</h1>
    <p> </p>
    <p>PHP 是世界上最好的编程语言！</p>
    <p style="color:red"><?php echo $errMessage;?></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>">
        <p>邮箱：<input style="width:180px" type="text" name="email" maxlength="64" value="<?php echo $email;?>"/></p>
        <p>密码：<input style="width:180px" type="password" name="password" maxlength="32" /></p>
        <p><input  type="checkbox" name="remember" value="yes"/>记住我的登录状态（持续30天）</p>
        <input type="submit" name="login" value="登录" />
    </form>
    <p>　</p>
    <a href="register.php">注册新账户</a><br /><br />
    <a href="password.php">忘了密码？</a>
</body>
</html>
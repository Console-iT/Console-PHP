<?php
    include "../functions/sql_get.php";
    include '../functions/enums.php';
    include '../functions/input_funcs.php';
    $myprofile = get_profile();
    $fullname = $myprofile["fullName"];
    $email = $myprofile["email"];   
    
    $birthday = strtotime($myprofile["dateOfBirth"]);
    $typeId = $myprofile["typeIdCard"];
    $numberId = $myprofile["numberIdCard"];
    $phone = $myprofile["phone"];
    
    $errMessage = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $validate = true;
        if (!empty($_POST["phone"]))
        {
            $newphone = test_input($_POST["phone"]);
            if (!preg_match("/\+?\d{6,15}/",$newphone))
            {
                $errMessage = "电话格式无效！";
                $validate = false;
            }
            else
            {
                $phone = $newphone;
            }
        }
        
        if (!empty($_POST["numberId"]))
        {
            $newnumberId = test_input($_POST["numberId"]);
            $newtypeId = ($_POST["typeIdCard"]);
            $pregstring = get_idpreg($newtypeId);
            if (!preg_match($pregstring, $newnumberId))
            {
                $errMessage = "请输入合法的证件号码！";
                $validate = false;
            }
            else
            {
                $typeId = $newtypeId;
                $numberId = $newnumberId;
            }
        }
        
        if (!checkdate($_POST["month"], $_POST["day"], $_POST["year"]))
        {
            $errMessage = "无效的出生日期！";
            $validate = false;
        }
        else
        {
            $newbirthday = mktime(0, 0, 0, $_POST["month"], $_POST["day"], $_POST["year"]);
            $birthday = $newbirthday;
        }
        
        $gender = $_POST['gender'];
        
        if ($validate == true)
        {
            try
            {
                include("../functions/db_predential.php");
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dusername, $dpassword);
                $sql = "UPDATE `users` SET `gender` = '$gender', `phone` = '$phone', `typeIdCard` = '$typeId', `numberIdCard` = '$numberId', "
                        . "`dateOfBirth` = '" . date("Y-m-d", $birthday) . "' WHERE `users`.`id` = " . $_COOKIE["uid"];
            
                $count = $conn->exec($sql);
                if($count == 1)
                {
                    $errMessage = "您的资料已成功保存！";
                } else { $errMessage = "SQL 错误，注册未完成！"; }
            } catch (PDOException $ex) {
                $errMessage =  $ex->getMessage();
            }            
        }        
    }
    
    echo '<p style="color:red">' . $errMessage . '</p>';
?>

    <link href="/src/css/main.css" type="text/css" rel="stylesheet" />
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>">
	<table class="main">
            <tr>
                <td class="subjects">姓名</td>
                <td style="width: 20px"></td>
                <td class="option"><?php echo $fullname; ?></td>
            </tr><tr>
                <td class="subjects">注册邮箱</td>
                <td style="width: 20px"></td>
                <td class="option"><?php echo $email; ?></td>
            </tr>
            <tr>
                <td class="subjects">性别</td>                
                <td style="width: 20px"></td>
                <td class="option">
                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="1") echo "checked";?> value="1">男　
                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="2") echo "checked";?> value="2">女　
                        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="3") echo "checked";?> value="3">其他
		</td>
            </tr>            
            <tr>
                <td class="subjects">出生日期</td>
                <td style="width: 20px"></td>
                <td class="option">
		    <select style="width:60px" type="text" name="year" >
		    <?php
                    $maxyear = date("Y");
                    $myyear = date('Y', $birthday);
		    for ($x=$maxyear; $x>=1926; $x--)
		    {   
			echo '<option value="' . $x . '"';
			if (isset($birthday) && $x == $myyear) echo 'selected="selected"';
			echo '>' . $x . '</option>';
		    }
		    ?>
                    </select> 年&nbsp;
                    <select style="width:45px" type="text" name="month" >
		    <?php
                    $mymonth = date('m', $birthday);
		    for ($y=1; $y<=12; $y++)
		    {         
			echo '<option value="' . $y . '"';
			if (isset($birthday) && $y == $mymonth) echo 'selected="selected"';
			echo '>' . $y . '</option>';
		    }
		    ?>
                    </select> 月&nbsp;
                    <select style="width:45px" type="text" name="day" >
		    <?php
                    //$days = date('t', $birthday);                    
                    $myday = date('d', $birthday);
		    for ($z=1; $z<=31; $z++)
		    {                        
			echo '<option value="' . $z . '"';
			if (isset($birthday) && $z == $myday) echo 'selected="selected"';
			echo '>' . $z . '</option>';
		    }
		    ?>
                    </select> 日
		</td>
            </tr>
            <tr>
                <td class="subjects">证件类型</td>
                <td style="width: 20px"></td>
                <td class="option">                     
                        <select style="width:100px" type="text" name="typeIdCard" >
                            <option value="1" <?php if (isset($typeId) && $typeId=="1") echo 'selected="selected"'; ?>>居民身份证</option>
                            <option value="2" <?php if (isset($typeId) && $typeId=="2") echo 'selected="selected"'; ?>>护照</option>
                            <option value="3" <?php if (isset($typeId) && $typeId=="3") echo 'selected="selected"'; ?>>回乡证</option>
                            <option value="4" <?php if (isset($typeId) && $typeId=="4") echo 'selected="selected"'; ?>>台胞证</option>
                        </select>
                    </td>
            </tr>
            <tr>
                <td class="subjects">证件号码</td>
                <td style="width: 20px"></td>
                <td class="option"><input style="width:300px" type="text" name="numberId" maxlength="18" value="<?php echo $numberId; ?>" /></td>
            </tr>
            <tr>
                <td class="subjects">联系电话</td>
                <td style="width: 20px"></td>
                <td class="option"><input style="width:220px" type="text" name="phone" maxlength="15" value="<?php echo $phone; ?>" /></td>
            </tr>
            <tr>
                <td class="subjects"></td>
                <td style="width: 20px"></td>
                <td class="option"><input type="submit" name="saveprofile" value="保存修改" /></td>
            </tr>
	</table>
    </form>
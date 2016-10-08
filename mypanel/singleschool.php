<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($_GET['school'])) die;
$user = $_COOKIE["uid"];
$school = $_GET['school'];
//$sql = "INSERT INTO `user-schools` (`userId`, `school`, `schoolType`, `graduationYear`, `isMember`, `title`) VALUES ('1', '岐阜县立斐太高等学校', '2', '2018', '0', NULL); ";

try
{
    include("../functions/db_predential.php");
    include('../functions/enums.php');
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dusername, $dpassword);
    $sqlfind = "SELECT * FROM `user-schools` WHERE userid = $user AND school = '$school'";
    foreach ($conn->query($sqlfind) as $row)
    {
        $typeSchool = $row['schoolType'];
        $graduation = $row['graduationYear'];
        $state = $row['isMember'];
        $title = $row['title'];
    }    
} catch (PDOException $ex) {
    
}

?>
    <link href="/src/css/main.css" type="text/css" rel="stylesheet" />
    <table class="main">
        <tbody>
            <tr>
                <td class="subjects30">学校全名</td>
                <td style="width: 20px"></td>
                <td class="option"><?php echo $school; ?></td>
            </tr>
            <tr>
                <td class="subjects30">社团状态</td>
                <td style="width: 20px"></td>
                <td class="option"><?php echo getSchoolState($state); ?></td>
            </tr>
            <tr>
                <td class="subjects30">学校类型</td>
                <td style="width: 20px"></td>
                <td class="option"><?php echo getSchoolType($typeSchool); ?></td>
            </tr>
            <tr>
                <td class="subjects30">毕业年份</td>
                <td style="width: 20px"></td>
                <td class="option"><?php echo $graduation; ?></td>
            </tr>
            <tr>
                <td class="subjects30"></td>
                <td style="width: 20px"></td>
                <td class="option"><a href="editschool.php">修改学校信息</a>　　<a href="?delete">删除这个学校</a></td>
            </tr>
        </tbody>
    </table>
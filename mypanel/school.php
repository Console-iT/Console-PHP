<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
    <link href="/src/css/main.css" type="text/css" rel="stylesheet" />
    <table class="main">
        <tbody>
            <tr>
                <td class="subjects30"></td>
                <td style="width: 20px"></td>
                <td class="option" colspan="3"><b>添加一个学校</b></td>
            </tr>
        </tbody>
    </table>
    <table class="main">
        <tbody>
            <tr>
                <td class="subjects30">学校全名</td>
                <td style="width: 20px"></td>
                <td class="option"><input style="width:400px" type="text" name="schoolname" maxlength="64" /></td>
            </tr>
            <tr>
                <td class="subjects30">学校类型</td>
                <td style="width: 20px"></td>
                <td class="option">
                    <input type="radio" name="typeSchool" <?php if (isset($typeSchool) && $typeSchool=="1") echo "checked";?> value="1">初级中学
                    <input type="radio" name="typeSchool" <?php if (isset($typeSchool) && $typeSchool=="2") echo "checked";?> value="2">高级中学
                    <input type="radio" name="typeSchool" <?php if (isset($typeSchool) && $typeSchool=="3") echo "checked";?> value="3">大学
                    <input type="radio" name="typeSchool" <?php if (isset($typeSchool) && $typeSchool=="4") echo "checked";?> value="4">研究生院
                    <input type="radio" name="typeSchool" <?php if (isset($typeSchool) && $typeSchool=="5") echo "checked";?> value="5">其他
                </td>
            </tr>
            <tr>
                <td class="subjects30">毕业年份</td>
                <td style="width: 20px"></td>
                <td class="option"><input style="width:60px" type="text" name="graduationYear" maxlength="4" /></td>
            </tr>
            <tr>
                <td class="subjects30"></td>
                <td style="width: 20px"></td>
                <td class="option"><input type="submit" name="saveprofile" value="保存修改" />　　<a href="?delete">删除这个学校</a></td>
            </tr>
        </tbody>
    </table>
    <table class="main">
        <tbody>
            <tr>
                <td class="subjects30"></td>
                <td style="width: 20px"></td>
                <td class="option" colspan="3"><b>我的学校</b></td>
            </tr>
        </tbody>
    </table>
    <iframe class="school" src="singleschool.php?school=岐阜县立斐太高等学校" scrolling="no"></iframe>
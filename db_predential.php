<?php

/* 
 * 以下为连接 MySQL 数据库时所必备的凭据。
 * $servername：数据库所在服务器的地址。
 * $dbname：数据库名称。
 * $dusername：连接 MySQL 数据库的用户名。
 * $dpassword：该用户名的密码。
 * 
 * 在需要访问数据库的 PHP 页面中，添加以下代码
 * （愿意用 require 就自己改掉）：
 * include("db_predential.php");
 *  
 * 然后，使用 PDO 连接数据库：
 * $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dusername, $dpassword);
 */

    $servername = "studmysql01.fhict.local";
    $dbname = "dbi330132";
    $dusername = "dbi330132";
    $dpassword = "lovetianrun";
    